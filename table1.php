<?php
require_once('waiterNavs.php');
require_once('restruant.php');

?>

<div class="container">

        <div class="row">
       
            <div class="container-fluid">
           
            <button class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Order</button>
            </div>
          
            <table class="table table-hover">
                <thead>
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
                  <?php echo $myRestruant->dispOrderT1();?>
                </tbody>
            </table>
  
            
        </div>