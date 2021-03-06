<?php 
 require_once('restruant.php');
 $myRestruant->addSales();
	$host 		= "remotemysql.com";
	$user		= "Ca4Rze9t7d";
	$password	= "3Lzjt7JmOu";
	$database	= "Ca4Rze9t7d";
	
	$conn = mysqli_connect($host,$user,$password,$database);
	
	if(!$conn)
	{
		die(mysqli_error());
	}
	

    //display order for on specific  table
    if(isset($_POST['table_number']) && $_POST['table_number'] !=0)
	{
		$table_number = intVal($_POST['table_number']);
		$sql = "SELECT * FROM order_table where tableNo=$table_number";
	
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No order found';
		}
		else
		{
			while($item = mysqli_fetch_assoc($rs))
			{
				echo'  <tr>
            
                <td>
                  <p>  '.$item['menuName'].'</p>
                </td>
                <td class="price">
				<b>Php</b> '.$item['price'].'
                </td>
                <td class="quantity">
                '.$item['quantity'].'
                </td>
                <td>
               <b>Php</b> '.$item['subtotal'].'
                </td>
                <td>
                 <p class="status"> '.$item['status'].'</p>
                </td>
                <td>
					<button class="btn btn-outline-success deliverBtn" >deliver</button>
					<input type="hidden" value="'.$item['order_id'].'">
					<button type="button" class="btn btn-outline-danger cancelBtn" >Cancel</button>
                </td>
				</tr>';
				
			}

		}
		
		
			
		
	}//end for display orders
	
    if(isset($_POST['table_number_for_delivered_item']) && $_POST['table_number_for_delivered_item'] !=0)
	{
		$table_number = intVal($_POST['table_number_for_delivered_item']);
		$sql = "SELECT sum(subtotal) as totalBill FROM order_table where  tableNo=$table_number and status='delivered'";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No order found';
		}
		else
		{
			while($bill = mysqli_fetch_assoc($rs))
			{
				echo'    <div class="card border-left-info shadow h-70 py-2 float-right">
								<div class="card-body">
										<div class="container-fluid">
											<center>  <h4>Total Bill</h4></center>
											<form method="post">
											<div class="input-group input-group-lg mb-2 mt-2">
											 <div class="row">
                                              <div class="col-sm-3"><strong class="float-right">Php</strong></div>
											  <div class="col-sm-7"> <input type="text"readonly name="amount"  id="categoriesDropDown" value=" '.intVal($bill['totalBill']).'" name="category" class="form-control bg-secondary text-light"
											  aria-label="Text input with dropdown button"></div>
												
												</div>
												<input type="hidden"  name="tableNumber" value="'.$table_number.'">
											</div>
												<button  type="submit"class="btn btn-info text-center"style="margin-left:28%;" name="settlePayment"> Settle Payment</button>
											</div>
											</form>
									</div>
								</div> 
		              </div>
            ';
			}
		}
	}//end for display orders
	
    // for diplaying all orders to kitchen page
	   if(isset($_POST['display'])){
		$sql = "SELECT * FROM order_table WHERE status !='delivered'";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No order found';
		}
		else
		{
			while($order = mysqli_fetch_assoc($rs))
			{
				echo' 
					<div class="col-xl-3 col-md-6 mb-4">
						<div class="card border-left-info shadow h-100 py-2">
							<div class="card-body">

								<div style="margin-top:-15px;">
									<small> '. '<i class="fa fa-thumb-tack text-danger" style="font-size:15px;"></i>'.' ' .$order['status'].'</small>
								</div>
								<div class="container-fluid">
							 <img src="'.$order['img'].'" style="width:100%">
								</div>
								<div class="text-lg font-weight-bold text-dark text-uppercase text-center mb-1 mt-1">
										'.$order['menuName'].'
									 </div>
								<div class="row no-gutters align-items-center">
									 
								<div class="col mr-2">
									<div class="row">
										<div class="col-sm-6 text-md font-weight-bold text-primary">
										<i class="fa fa-table text-primary" style="font-size:15px;"></i> Table no.'.$order['tableNo'].'
										</div>
										<div class=" col-sm-6 text-md font-weight-bold text-info">
										<i class="fas fa-sort-amount-up" aria-hidden="true"></i>
										 Quantity: '.$order['quantity'].'
										</div>
									    </div>
										
										<hr class="border-primary">
										<span>
											<div class="text-center mt-3">
												<input type="hidden" value="'.$order['order_id'].'">
												<button type="button" class="btn btn-outline-success confirmBtn"><i class="fa fa-check"style="font-size:20px"></i>Confirm</button>
												<button type="button" class="btn btn-outline-danger rejectBtn"><i class="fa fa-ban"style="font-size:20px"></i> Reject</button>
											</div>
										</span>
									 </div>
								 </div>
							 </div>
					     </div>
				    </div>';
			}
			
		}
	}
	




	// delete order 
	if( isset($_POST['item_id']))
	{
		$table_number=isset($_POST['item_id']);
		$menuID = $_POST['item_id'];
		$sql = "delete from  order_table where order_id = '".$menuID."'" ;
		if ($rs = mysqli_query($conn,$sql)){
			echo "YES";
		}else{

			
		}
		
    }

	// update status of the order to delivered
	if(isset($_POST['update_item_id']))
	{
		$menuID = $_POST['update_item_id'];
		$sql = "update   order_table set status='delivered' where order_id = '".$menuID."'";
		if ($rs = mysqli_query($conn,$sql)){
			echo "YES";
		}else{	
			echo "NO";
		}
		
	}
	
	// update status of the order to confirmed
	if(isset($_POST['confirm_item_id']))
	{
		$menuID = $_POST['confirm_item_id'];
		$sql = "update   order_table set status='confirmed' where order_id = '".$menuID."'";
		if ($rs = mysqli_query($conn,$sql)){
			echo "YES";

		}else{	
			echo "NO";
		}

	}
	
	// update status of the order to reject
	if(isset($_POST['reject_item_id']))
	{
		$menuID = $_POST['reject_item_id'];
		$sql = "update   order_table set status='rejected' where order_id = '".$menuID."'";
		if ($rs = mysqli_query($conn,$sql)){
			echo "YES";
		}else{	
			echo "NO";
		}
    }




// for the dropdown for adding an order 
	if(isset($_POST['category_name']))
	{
		$categoryName = $_POST['category_name'];
		$sql = "select menuName from menu where category= '".$categoryName."' order by menuName ASC";
		$rs = mysqli_query($conn,$sql);
		$numRows = mysqli_num_rows($rs);
		
		if($numRows == 0)
		{
			echo 'No menu found';
		}
		else
		{
			while($categories = mysqli_fetch_assoc($rs))
			{
				echo '<a class="dropdown-item dropdownItemBtn" href="#" >'.$categories['menuName'].'</a>';
			}
			
		}
		
    }
    

?>