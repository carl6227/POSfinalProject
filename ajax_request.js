$(document).ready(function() {


    $('table').hide();
    $('.addBtn').hide();

    //scripts for displaying the orders
    displaySpecificOrders();

    function displaySpecificOrders() { //defining a function that display a specific base on the number of its table
        $('.table').on('click', function() {
            $('table').show();
            $('.addBtn').show();
            var tableNumber = parseInt($(this).attr('name'));
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
        })
    }


    $('.table').on('click', function() {
        var tableNumber = parseInt($(this).attr('name'));
        console.log($(this).parent().parent().parent().parent().nextUntil('div.fade'));
        $.ajax({
            type: "post",
            data: {
                table_number: tableNumber,
            },
            url: "restruant.php",
            success: function(returnData) {
                $("tbody").html(returnData);
            },
        });
    })

    //checking the value of the status of the ordered item


    //delete order when cancelBtn is clicked
    $('.table').on('click', function() {
        var tableNumber = parseInt($(this).attr('name'));
        $(document).on("click", ".cancelBtn", function() {
            var getmenuID = $(this).prev().val();
            var element = $(this).parent().parent();
            $.ajax({
                type: "post",
                data: {
                    item_id: getmenuID,
                    table_number_cancel: tableNumber
                },
                url: "ajax_request.php",
                success: function(returnData) {
                    if (returnData == "YES") {
                        alert('cancel success')
                    } else {
                        alert("can't delete the row");
                    }
                },
            });
        });
    });

    // update status when the deliverBtn is click
    $(document).on("click", ".deliverBtn", function() {
        var getmenuID = $(this).next().val();
        var statusRow = $(this).parent().prev().children().text();
        if (statusRow == "pending") {
            alert("Can't deliver, Order is still PENDING");
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
        displayOrders();
    }, 3000);
});