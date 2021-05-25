<?php
session_start();

require_once('navs.php');
require_once('restruant.php');
$myRestruant->addMenu();
$myRestruant->deleteMenu();
$myRestruant->updateMenu();
?>
<?php
    $myRestruant->logout(); // calling logout function
    $user = $_SESSION['username']; // assign the session into user variable
    // checking if var user session is directly set
if ($user == "") {
    echo "<script> location.replace('login.php'); </script>";   
}
?>

<div class="container mb-5">
         <button class="btn btn-info float-right addBtn" data-toggle="modal"
                    data-target="#addModal"><i class="fa fa-plus"></i> Add Order</button>
            </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="bg-info text-light text-center">
            <tr>
                <th>ID</th>
                <th>Menu</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody class="text-dark text-center">
            <?php echo $myRestruant->dispMenu(); ?>
        </tbody>
        <tfoot>
           
        </tfoot>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<!-- Add Menu Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group input-group-lg">
                        <label for="exampleInputEmail1">Category</label>
                        <input type="text" class="form-control" name="category" aria-label="Large" placeholder="Enter Category">
                    </div>
                    <div class="form-group input-group-lg">
                        <label for="exampleInputEmail1">Menu Name</label>
                        <input type="text" class="form-control" name="menuName" aria-label="Large" placeholder="Enter Menu Name">
                    </div>
                    <div class="form-group input-group-lg">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" class="form-control" name="price" aria-label="Large">
                    </div>
                    <div class="form-group input-group-lg">
                        <label for="exampleInputEmail1">Menu Image</label>
                        <input type="text" class="form-control" name="menuImg" aria-label="Large">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" name="addMenuBtn" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js
"></script> 
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js
"></script>
<script>
    $('.editBtn').on('click', function() {
        console.log($(this).parent().prev().modal('show'))

    })

    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>