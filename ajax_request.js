$(document).ready(function() {
  
    
    $('.tableWrapper').hide();
    //hide the table when  click and show the orders
    $('.menuBtn').on('click',function(){
        $('.tableWrapper').hide();
        $('.orderWrapper').show();
        
    });

    var tableNumber=0;
    var tableNumberForDeliveredItem=0;
    $('.storeTable').on('click', function() {
         tableNumber = parseInt($(this).attr('name'));
         tableNumberForDeliveredItem=parseInt($(this).attr('name'));
        $('.tableIndicator').text('Table Number: '+tableNumber.toString());
        $('.tableNo').val(tableNumber);
        $('.tableWrapper').show();
        $('.orderWrapper').hide();
    })
   
    function displaySpecificOrders() { //defining a function that display a specific base on the number of its table
            $.ajax({
                type: "post",
                data: {
                    table_number: tableNumber,
                },
                url: "ajax_request.php",
                success: function(returnData) {
                    $("tbody").html(returnData);
                  
                },
            });
    }


    function displayTotalBill() { //defining a function that display the total bill of specific table 
        $.ajax({
            type: "post",
            data: {
                table_number_for_delivered_item: tableNumberForDeliveredItem,
            },
            url: "ajax_request.php",
            success: function(returnData) {
                $(".billWrapper").html(returnData);
              
            },
        });
}


    //delete order when cancelBtn is clicked
    $(document).on("click", ".cancelBtn", function() {
        var getmenuID = $(this).prev().val();
        $.ajax({
            type: "post",
            data: {
                item_id:getmenuID
            },
            url: "ajax_request.php",
            success: function(returnData) {
                if (returnData == "YES") {
                } else {
                    alert("can't delete the row");
                }
            },
        });
    });
   
    // update status when the deliverBtn is click
    $(document).on("click", ".deliverBtn", function() {
        var getmenuID = $(this).next().val();
        var statusRow = $(this).parent().prev().children().text();
        console.log((statusRow));
        if(statusRow==" pending") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Order is still pending!',
                timer: 2000
              })
     
        } else {

            $.ajax({
                type: "post",
                data: {
                    update_item_id: getmenuID,
                },
                url: "ajax_request.php",
                success: function(returnData) {
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
    $(".dropdownBtn").on("click", function() {
        $(this).parent().parent().prev().val($(this).text());
        var getcategoryName = $(this).parent().parent().prev().val();
        if (getcategoryName != "") {
            $.ajax({
                type: "post",
                data: {
                    category_name: getcategoryName,
                },
                url: "ajax_request.php",
                success: function(returnData) {
                    $(".itemData").html(returnData);
                    $(".dropdownItemBtn").on("click", function() {
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
            success: function(returnData) {
                $(".ordersWrapper").html(returnData);
            },
        });

    }

    // ajax for updating the order status to confirmed
    $(document).on("click", ".confirmBtn", function() {
        var getOrderID = $(this).prev().val();
        $.ajax({
            type: "post",
            data: {
                confirm_item_id: getOrderID,
            },
            url: "ajax_request.php",
            success: function(returnData) {
                if (returnData == "YES") {
                    displayOrders();
                   
                } else {
                    alert("can't update the row");
                }
            },
        });
    });

    // ajax for updating the order status to rejected
    $(document).on("click", ".rejectBtn", function() {
        var getOrderID = $(this).prev().prev().val();
        $.ajax({
            type: "post",
            data: {
                reject_item_id: getOrderID,
            },
            url: "ajax_request.php",
            success: function(returnData) {
                if (returnData == "YES") {
                    displayOrders();
                } else {
                    alert("can't update the row");
                }
            },
        });
    });

    setInterval(function() {
        displaySpecificOrders();
        displayTotalBill()
        displayOrders();
       
    }, 3000);

});