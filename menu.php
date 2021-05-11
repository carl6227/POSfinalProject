<?php 
require_once('navs.php');
require_once('restruant.php');
$myRestruant->addMenu();
$myRestruant->deleteMenu();
$myRestruant->updateMenu();
?>

<div class="container">

        <div class="row">
        <h2>Menu</h2>
            <div class="container-fluid">
           
            <button class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Menu</button>
            </div>
          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Menu</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
  
                <tbody>
                  <?php echo $myRestruant->dispMenu();?>
                </tbody>
            </table>
  
            
        </div>
</div>

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
                    <input type="text" class="form-control"name="category" aria-label="Large" placeholder="Enter Category">
                </div>
                <div class="form-group input-group-lg">
                    <label for="exampleInputEmail1">Menu Name</label>
                    <input type="text" class="form-control" name="menuName"aria-label="Large" placeholder="Enter Menu Name">
                </div>
                <div class="form-group input-group-lg">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="number" class="form-control" name="price"aria-label="Large">
                </div>
           </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit"  name="addMenuBtn"class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
  </div>
</div>


<script>
$('.editBtn').on('click',function(){
    console.log($(this).parent().prev().modal('show'))

})

</script>