$(document).ready(function () {
 

  $(".orderWrapper").show();
  $(".tableWrapper").hide();
  //hide the table when  click and show the orders
  $(".menuBtn").on("click", function () {
    $(".tableWrapper").hide();
    $(".billWrapper").hide();
    $(".orderWrapper").show();
  });

  var tableNumber = 0;
  var tableNumberForDeliveredItem = 0;
  $(".storeTable").on("click", function () {
    tableNumber = parseInt($(this).attr("name"));
    tableNumberForDeliveredItem = parseInt($(this).attr("name"));
    $(".tableIndicator").text("Table Number: " + tableNumber.toString());
    $(".tableNo").val(tableNumber);
    $(".tableWrapper").show();
    $(".orderWrapper").hide();
   
  });

  function displaySpecificOrders() {
    //defining a function that display a specific base on the number of its table
    $.ajax({
      type: "post",
      data: {
        table_number: tableNumber,
      },
      url: "ajax_request.php",
      success: function (returnData) {
        $("tbody").html(returnData);
      },
    });
  }

  function displayTotalBill() {
    //defining a function that display the total bill of specific table
    $.ajax({
      type: "post",
      data: {
        table_number_for_delivered_item: tableNumberForDeliveredItem,
      },
      url: "ajax_request.php",
      success: function (returnData) {
        $(".billWrapper").html(returnData);
      },
    });
  }

  //delete order when cancelBtn is clicked
  $(document).on("click", ".cancelBtn", function () {
    var getmenuID = $(this).prev().val();
    var getStatus = $(this).parent().prev().children().text();
    console.log(getStatus)
    if(getStatus==" delivered"){
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Order is already delivered!",
            timer: 3000,
          });
    }else if(getStatus==" confirmed"){
        Swal.fire({
            icon: "error",
            title: "Cannot Cancel",
            text: "Order is on process!",
            timer: 3000,
          });
    }else{
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: "btn btn-info ml-3",
              cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
          });
      
          swalWithBootstrapButtons
            .fire({
              title: "Are you sure?",
              text: "You won't be able to revert this!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonText: "Yes, delete it! ",
              cancelButtonText: " No, cancel!",
              reverseButtons: true,
            })
            .then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: "post",
                  data: {
                    item_id: getmenuID,
                  },
                  url: "ajax_request.php",
                  success: function (returnData) {
                    if (returnData == "YES") {
                      swalWithBootstrapButtons.fire(
                        "Deleted!",
                        "Your order has been cancelled!.",
                        "success"
                      );
                    } else {
                      alert("can't delete the row");
                    }
                  },
                });
              } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
              ) {
                swalWithBootstrapButtons.fire(
                  "Cancelled",
                  "Your order has been preserve :)",
                  "error"
                );
              }
            });
    }
    
  });

  // update status when the deliverBtn is click
  $(document).on("click", ".deliverBtn", function () {
    var getmenuID = $(this).next().val();
    var statusRow = $(this).parent().prev().children().text();
    console.log(statusRow);
    if (statusRow == " pending") {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Order is still pending!",
        timer: 2000,
      });
    } else if (statusRow == " rejected") {
      Swal.fire({
        icon: "info",
        title: "Oops...",
        text: "Order was rejected!!",
        timer: 2000,
      });
    } else {
      $.ajax({
        type: "post",
        data: {
          update_item_id: getmenuID,
        },
        url: "ajax_request.php",
        success: function (returnData) {
          if (returnData == "YES") {
            displaySpecificOrders();
          } else {
            alert("Can't update status");
          }
        },
      });
    }
  });

  //script for the dropdown on categories and its corresponding items
  $(".dropdownBtn").on("click", function () {
    $(this).parent().parent().prev().val($(this).text());
    var getcategoryName = $(this).parent().parent().prev().val();
    if (getcategoryName != "") {
      $.ajax({
        type: "post",
        data: {
          category_name: getcategoryName,
        },
        url: "ajax_request.php",
        success: function (returnData) {
          $(".itemData").html(returnData);
          $(".dropdownItemBtn").on("click", function () {
            $(this).parent().parent().prev().val($(this).text());
          });
        },
      });
    }
  });

  //for kitchen

  displayOrders(); //calling the displayOrders function.

  function displayOrders() {
    //defining  the displayOrders function.

    $.ajax({
      type: "post",
      data: {
        display: "",
      },
      url: "ajax_request.php",
      success: function (returnData) {
        $(".ordersWrapper").html(returnData);
      },
    });
  }

  // ajax for updating the order status to confirmed
  $(document).on("click", ".confirmBtn", function () {
    var getOrderID = $(this).prev().val();
    $.ajax({
      type: "post",
      data: {
        confirm_item_id: getOrderID,
      },
      url: "ajax_request.php",
      success: function (returnData) {
        if (returnData == "YES") {
          Swal.fire({
            icon: "success",
            title: "Order confirmed!",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          alert("can't update the row");
        }
      },
    });
  });

  // ajax for updating the order status to rejected
  $(document).on("click", ".rejectBtn", function () {
    var getOrderID = $(this).prev().prev().val();
    $.ajax({
      type: "post",
      data: {
        reject_item_id: getOrderID,
      },
      url: "ajax_request.php",
      success: function (returnData) {
        if (returnData == "YES") {
          Swal.fire({
            icon: "info",
            title: "Order rejected!!",
            showConfirmButton: false,
            timer: 1500,
          });
        } else {
          alert("can't update the row");
        }
      },
    });
  });

  setInterval(function () {
    displaySpecificOrders();
    displayTotalBill();
    displayOrders();
  }, 3000);
});
