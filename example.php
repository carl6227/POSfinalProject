
<?php
session_start();

$user=$_SESSION['username'];
if($user!=""){
   echo "
   <script>
   alert('Order added sucessfully!')
   location.replace('waiterlanding.php'); 
   </script>
  
   ";  

}
?>
