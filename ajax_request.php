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
                    '.$item['menuName'].'
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
                <button class="btn btn-success">deliver</button>
                <button type="button" class="btn btn-danger cancelBtn">Cancel</button>
                </td>
                </tr>';
			}
			
		}
		
    }//end for display orders

    if(isset($_POST['category_name']) && $_POST['category_name'] !='')
	{
		$categoryName = $_POST['category_name'];
		$sql = "select menuName from menu where category= '".$categoryName."' order by menuName ASC";
		$rs = mysqli_query($conn,$sql);
        $numRows = mysqli_num_rows($rs);
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