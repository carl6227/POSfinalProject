<?php
session_start(); //start of a session
include_once 'restruant.php'; // including the restruant.php file
$myrestaurant = new restaurant(); // creating a restaurant object
$myrestaurant->logout(); // calling logout function
$myrestaurant->updateInfo(); // calling updateInfo function
$user = $_SESSION['username']; // assign the session into user variable

// checking if var user session is directly set
if ($user == "") {
    header('location:login.php');
}
?>


<?php
require_once 'navs.php'
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <?php $now = date("y-m-d");

        $connection = $myrestaurant->openConnection();
        $statement = $connection->prepare("SELECT sum(amount) as totalAmount FROM  sales where date='$now'");
        $statement->execute();
        $saleDate = $statement->fetch();
        echo '
                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Earnings (Today)</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Php ' . $saleDate['totalAmount'] . '</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        ?>

        <?php
$yesterday = date('Y-m-d', strtotime("-1 days"));
$connection = $myrestaurant->openConnection();
$statement = $connection->prepare("SELECT sum(amount) as totalAmount FROM  sales where date='$yesterday'");
$statement->execute();
$saleDate = $statement->fetch();
echo '
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Earnings (YesterDay)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Php ' . $saleDate['totalAmount'] . '</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
?>
     
        <div class="container my-4 ">
        <hr class="bg-dark">

        <p class="font-weight-bold"> Customers Favourite</p>


            <div>
                <canvas id="pieChart" style="max-width: 800px;"></canvas>
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
</script>
</body>

</html>