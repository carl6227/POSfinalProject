<?php
session_start(); //start of a session
include_once 'restruant.php'; // including the restruant.php file
$myrestaurant = new restaurant(); // creating a restaurant object
$myrestaurant->logout(); // calling logout function
$myrestaurant->updateInfo(); // calling updateInfo function
$user = $_SESSION['username']; // assign the session into user variable

// checking if var user session is directly set
if ($user != "Admin") {
    header('location:login.php');
}
?>


<?php
require_once 'navs.php'
?>

<div class="load">
    <hr />
    <hr />
    <hr />
    <hr />
</div>
<!-- Begin Page Content -->
<div class="container-fluid" id="preload" style="display:none">



    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <?php $now = date("y-m-d");

        $connection = $myrestaurant->openConnection();
        $statement = $connection->prepare("SELECT sum(amount) as totalAmount FROM  sales where date='$now'");
        $statement->execute();
        $saleDate = $statement->fetch();
        echo '
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total sales Today
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Php ' . $saleDate['totalAmount'] . '</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        ?>

        <?php
                
                $connection = $myrestaurant->openConnection();
                $statement = $connection->prepare("SELECT count(*) as totalmenu FROM  menu");
                $statement->execute();
                $saleDate = $statement->fetch();
                echo '
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            
                                                Total Menu</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">' . $saleDate['totalmenu'] . '</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
        ?>
        <?php
          
            $connection = $myrestaurant->openConnection();
            $statement = $connection->prepare("SELECT count(status) as countPending FROM  order_table where status='pending'");
            $statement->execute();
            $pendingOrders = $statement->fetch();
            echo '
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                           Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> ' . $pendingOrders['countPending'] . '</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-coins fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                    ?>

        <div class="container my-4 ">
            <hr class="bg-info">

   <p class="font-weight-bold text-lg "> Customers Order Transactions</p>

                <div class="coontainer">
                <table class="table table-hover " >
                    <thead id="myThead">
                        <tr>
                            <th>table number</th>
                            <th>Menu </th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
          
                    $connection = $myrestaurant->openConnection();
                    $statement = $connection->prepare("SELECT * FROM  order_table ");
                    $statement->execute();
                    $items = $statement->fetchAll();
                    foreach($items as $item) {
                    echo '
                    <tr>
            
                    <td>
                      <p>  '.$item['tableNo'].'</p>
                    </td>
                    <td >
                    <b>Php</b> '.$item['menuName'].'
                    </td>
                    <td >
                    '.$item['quantity'].'
                    </td>
                    <td>
                  '.$item['price'].'
                    </td>
                    <td>
                    <b>Php</b> '.$item['subtotal'].'
                     </td>
                    <td>
                     <p class="status"> '.$item['status'].'</p>
                    </td>
                  
                    </tr>';
                    }
                   ?>
                    </tbody>
                </table>
                
                </div>
                <div class="container">
                <hr class="bg-info">
                    <p class="font-weight-bold text-lg"> Customers Favourite</p>


                    <div class="">
                        <canvas id="pieChart" style="max-width: 800px;margin-left:150px;"></canvas>
                    </div>
                </div>

            </div>


        </div>




    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure you want to logout?</div>
            <form method="post">
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" name="logout" type="submit">Logout</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- edit Profile  Modal-->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <?php
                
   
                $user = $_SESSION['username'];
                $connection = $myRestruant->openConnection();
                $statement = $connection->prepare("SELECT *  FROM  users_table  where  fullName='$user'");
                $statement->execute();
                $userInfo = $statement->fetch();
              
                echo '
                <div class="input-group input-group-lg mb-4">
                      <label for="exampleInputEmail1" class="mr-4">New Fullname:</label>
                      <input type="text" class="form-control" name="full_name" value="'.$userInfo['fullName'].'">
                </div>
                <div class="input-group input-group-lg mb-4">
                    <label for="exampleInputEmail1" class="mr-5">New Email:</label>
                    <input type="email" class="form-control" name="email"value="'.$userInfo['email'].'">
                </div>
                <div class="input-group input-group-lg mb-4">
                <label for="exampleInputEmail1" class="mr-4">New Address:</label>
                <input type="text" class="form-control" name="address"value="'.$userInfo['address'].'">
            </div>
                <div class="input-group input-group-lg">
                   <label for="exampleInputEmail1" class="mr-3">New Password:</label>
                   <input type="password" class="form-control" name="password" value="'.$userInfo['password'].'">
                   <input type="hidden" class="form-control" name="id"value="'.$userInfo['user_id'].'">
                </div><br>
                <div class="input-group input-group-lg">
                <label for="exampleInputEmail1" class="mr-3">New Profile pic:</label>
                <input type="text" class="form-control" name="userImg" value="'.$userInfo['img'].'"><br>
                <input type="hidden" class="form-control" name="userType" value="'.$userInfo['type'].'">
               
             </div>
                        ';
            ?>


            </div>
            <div class="modal-footer">

                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" name="editProfileBtn">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script>
var ctxP = document.getElementById("pieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: ["Batchoy", "Bicol Express", "Bulalo", "Pancit Lomi", "JPG especial Fried Rice"],
        datasets: [{
            data: [250, 50, 100, 40, 150],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
        }]
    },
    options: {
        responsive: true
    }
});
$(document).ready(function() {
    setTimeout(function() {
        $('.load').remove()
        $('#preload').show()
    }, 1500);
});
</script>
</body>

</html>