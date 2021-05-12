





   
        //scripts for displaying the specific  orders for the table
        displaySpecificOrders();

        function displaySpecificOrders() {
            var tableNumber = 1;
            $.ajax({
                type: 'post',
                data: {
                    table_number: tableNumber
                },
                url: 'ajax_request.php',
                success: function(returnData) {
                    $("tbody").empty();
                    $("tbody").html(returnData);


                }
            });
        }

     
 //delete order when cancelBtn is clicked
 $(document).on('click', '.cancelBtn', function() {
     var getmenuID = $(this).prev().val();
     var element = $(this).parent().parent();
     $.ajax({
         type: 'post',
         data: {
             item_id: getmenuID
         },
         url: 'ajax_request.php',
         success: function(returnData) {
             if (returnData == "YES") {
                 element.fadeOut().remove();
             } else {
                 alert("can't delete the row")
             }
         }
     });
 })

 // update status when the deliverBtn is click
 $(document).on('click', '.deliverBtn', function() {
             var getmenuID = $(this).next().val();
             $.ajax({
                 type: 'post',
                 data: {
                     update_item_id: getmenuID
                 },
                 url: 'ajax_request.php',
                 success: function(returnData) {
                     if (returnData == "YES") {
                         displaySpecificOrders();
                        $(this).next().next().attr('disabled','disabled')
                     } else {
                         alert("can't update the row")
                     }
                 }
             });
         })







 //script for the dropdown on categories and its corresponding items
        $('.dropdownBtn').on("click", function() {
            $(this).parent().parent().prev().val($(this).text());
            var getcategoryName = $(this).parent().parent().prev().val();
            if (getcategoryName != '') {
                $.ajax({
                    type: 'post',
                    data: {
                        category_name: getcategoryName
                    },
                    url: 'ajax_request.php',
                    success: function(returnData) {
                        $(".itemData").html(returnData);
                        $('.dropdownItemBtn').on("click", function() {

                            $(this).parent().parent().prev().val($(this).text());

                        })
                    }
                });
            }
        })




















    //displayOrders();//calling the displayOrders function.


     function displayOrders(){//defining  the displayOrders function.
     $.ajax({
         type: 'post',
         data: {
             display:""
         },
         url: 'ajax_request.php',
         success: function(returnData) {
             $(".ordersWrapper").html(returnData);
         }
     });
 }




$(document).on('click', '.confirmBtn', function() {
 
             var getOrderID = $(this).prev().val();
             $.ajax({
                 type: 'post',
                 data: {
                     confirm_item_id: getOrderID
                 },
                 url: 'ajax_request.php',
                 success: function(returnData) {
                     if (returnData == "YES") {
                         displayOrders();
                         alert('confirmed successfully')
                     } else {
                         alert("can't update the row")
                     }
                 }
             });
         })

