<?php
require_once('waiterNavs.php');
require_once('restruant.php');
$myRestruant->addOrder();
$myRestruant->deleteOrder();
?>

<div class="container">

    <div class="row">

        <div class="container-fluid">

            <button class="btn btn-primary float-right mb-4" data-toggle="modal" data-target="#addOrderModal"><i
                    class="fa fa-plus"></i> Add Order</button>
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

            </tbody>
        </table>


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
                <div class="modal-body">
                    <form action="#"method="post">
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
                                <input type="number" class="form-control" name="quantity" placeholder="quantity">

                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" class="form-control" name="tableNo" value="1">
                    <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                    <button type="submit" name="addOrder" class="btn btn-primary btn-lg">Add Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="ajax_request.js">
    
    </script>