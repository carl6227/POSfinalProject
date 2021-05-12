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

	// update status of the order
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