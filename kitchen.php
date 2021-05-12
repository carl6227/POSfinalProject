<?php
 require_once('navForKitchen.php');
     
 
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kitchen</h1>
        <a href="index.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row ordersWrapper">
      
        
    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
 $(document).ready(function() {

           displayOrders();//calling the displayOrders function.


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
 });

</script>

</body>

</html>