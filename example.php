
<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<?php
session_start();

$user=$_SESSION['username'];

if($user!=""){
   echo "
   <script>
      location.replace('waiterlanding.php'); 
   </script>
  
   ";  

}
?>
