<?php 

session_start();
   require_once('restruant.php');
   
    $myRestruant->logout();
    
    $user=$_SESSION['username'];
   

    if($user==""){
        header('location:login.php');
    }
    
    require_once('waiterNavs.php');
   
    $myRestruant->addOrder();
    $myRestruant->deleteOrder();
    $myRestruant->addSales();
    $myRestruant->updateInfo();
    

?>
<div class="load">
    <hr />
    <hr />
    <hr />
    <hr />
</div>
<!-- Begin Page Content -->
<div class="container-fluid" id="preload" style="display:none;">

    <div class="container">
        <h2 class="tableIndicator">Menu</h2>
        <div class="row">
            <div class="container-fluid orderWrapper" >
            <div class="row">
                <?php $myRestruant->dispMenuForWaiter();?>
            </div>
               
            </div>
            

            <div class="container-fluid tableWrapper" style="display:none">

                <button class="btn btn-info float-right mb-4 addBtn" data-toggle="modal"
                    data-target="#addOrderModal"> Add Order</button>
            </div>
            <div class="container-fluid mb-5" style="overflow-y:auto;height: 300px;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">
                <table class="table table-hover tableWrapper" >
                    <thead id="myThead">
                        <tr>
                            <th>Menu Name</th>
                            <th>price</th>
                            <th>quantity</th>
                            <th>subtotal</th>
                            <th>status</th>
                            <th>action</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>

            </div>
            <div>
            <hr class="bg-dark">
            </div>
            
         <!-- totalbill container -->
        <div class="container billWrapper mb-5 ">
       
    </div>
   
        <!-- Add order Modal -->
        <div class="modal fade" id="addOrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="#" method="post">
                        <div class="modal-body">
                            <div class="input-group input-group-lg mb-4">
                                <input type="text" id="categoriesDropDown" name="category" class="form-control"
                                    aria-label="Text input with dropdown button">
                                <div class="input-group-append ">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">Categories</button>
                                    <div class="dropdown-menu">
                                        <?php echo  $myRestruant->getCategories()?>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group input-group-lg mb-4">
                                <input type="text" class="form-control" name="menuName"
                                    aria-label="Text input with dropdown button">
                                <div class="input-group-append ">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Items</button>
                                    <div class="dropdown-menu itemData">

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group input-group-lg">
                                    <input type="number" min="1" value="1"class="form-control" name="quantity"
                                        placeholder="quantity">

                                </div>
                            </div>


                            <input type="hidden" min="1" max="5" class="form-control tableNo" name="tablenum"
                                placeholder="Table No.">



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                            <button type="submit" name="addOrder" class="btn btn-primary btn-lg">Add Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

           
    <!-- /.container-fluid 
        -->

</div>

<!-- End of Main Content -->

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
            <div class="modal-footer">
                <form method="post">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>

            </div>
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
                <div class="input-group input-group-lg mb-4">
                   <label for="exampleInputEmail1" class="mr-3">New Password:</label>
                   <input type="password" class="form-control" name="password" value="'.$userInfo['password'].'">
                   <input type="hidden" class="form-control" name="id"value="'.$userInfo['user_id'].'">
                </div>
                <div class="input-group input-group-lg">
                <label for="exampleInputEmail1" class="mr-3">New Image URL:</label>
                <input type="text" class="form-control" name="userImg" value="'.$userInfo['img'].'">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="ajax_request.js">


</script>
<script>
     $(document).ready(function() {
            setTimeout(function() {
                $('.load').remove()
                $('#preload').show()
            }, 1500);
        });
</script>
</body>

</html>