<?php 

	$host 		= "remotemysql.com";
	$user		= "Ca4Rze9t7d";
	$password	= "3Lzjt7JmOu";
	$database	= "Ca4Rze9t7d";
	
	$conn = mysqli_connect($host,$user,$password,$database);
	
	if(!$conn)
	{
		die(mysqli_error());
	}
 
	
    //display order for all table
    if(isset($_POST['table_number']) && $_POST['table_number'] !='')
	{
		$table_number = $_POST['table_number'];
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
                    '.$item['price'].'
                </td>
                <td class="quantity">
                '.$item['quantity'].'
                </td>
                <td>
                '.$item['subtotal'].'
                </td>
                <td>
                '.$item['status'].'
                </td>
                <td>
				<button class="btn btn-success deliverBtn " disabled>deliver</button>
				<input type="hidden" value="'.$item['order_id'].'">
                <button type="button" class="btn btn-danger cancelBtn" >Cancel</button>
                </td>
                </tr>';
			}
			
		}
		
	}//end for display orders
	
    if(isset($_POST['table_number']) && $_POST['table_number'] !='')
	{
		$table_number = $_POST['table_number'];
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
                    '.$item['price'].'
                </td>
                <td class="quantity">
                '.$item['quantity'].'
                </td>
                <td>
                '.$item['subtotal'].'
                </td>
                <td>
                '.$item['status'].'
                </td>
                <td>
				<button class="btn btn-success deliverBtn " disabled>deliver</button>
				<input type="hidden" value="'.$item['order_id'].'">
                <button type="button" class="btn btn-danger cancelBtn" >Cancel</button>
                </td>
                </tr>';
			}
			
		}
		
	}//end for display orders




    // for diplaying all orders to kitchen page
	   if(isset($_POST['display'])){
		$sql = "SELECT * FROM order_table ";
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
						<div class="card border-left-primary shadow h-100 py-2">
							<div class="card-body">
								<div class="row no-gutters align-items-center">
									<div class="col mr-2">
										<div class="row">
											<div class="col-sm-6 text-md font-weight-bold text-primary">
												Table no.'.$order['tableNo'].'
											</div>
											<div class=" col-sm-6 text-md font-weight-bold text-info">
											Quantity: '.$order['quantity'].'
											</div>
										</div>
										<div class="text-md font-weight-bold text-dark text-uppercase text-center mb-1 mt-1">
										'.$order['menuName'].'
										</div>
										<hr class="border-primary">
										<span>
											<div class="text-center mt-3">
												<input type="hidden" value="'.$order['order_id'].'">
												<button type="button" class="btn btn-success confirmBtn"><i class="fa fa-check"style="font-size:20px"></i>Confirm</button>
												<button type="button" class="btn btn-danger rejectBtn"><i class="fa fa-ban"style="font-size:20px"></i> Reject</button>
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
	if(isset($_POST['item_id']))
	{
		$menuID = $_POST['item_id'];
		$sql = "delete from  order_table where order_id = '".$menuID."'";
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




// for the dropdown for adding an order 
	if(isset($_POST['category_name']) && $_POST['category_name'] !='')
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