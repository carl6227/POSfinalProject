<?php


    class restaurant
    {
        private $server = "mysql:host=remotemysql.com;dbname=Ca4Rze9t7d";
        private $user = "Ca4Rze9t7d";
        private $password = "3Lzjt7JmOu";
        private $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        protected $connection;

        //connections
        public function openConnection()
        {
            try {
               
                $this->connection= new PDO(
                    $this->server,
                    $this->user,
                    $this->password,
                    $this->options
                );
               
                return $this->connection;
            } catch (PDOException $error) {
                echo "Erro connection:" . $error->getMessage();
            }
        }
        public function closeConnection()
        {
            $this->$connection= null;
        }

        public function getUsers()
        {
            $connection = $this->openConnection();
            $statement = $connection->prepare("SELECT * FROM users");
            $statement->execute();
            $users = $statement->fetchAll();
            $usersCount = $statement->rowCount();

            if ($usersCount > 0) {
                return $users;
            } else {
                return 0;
            }
        }//end of get users
       
       
       
        public function login(){
        
           if(isset($_POST['login'])){
                //condition added
                $email=$_POST['email'];
                $password=$_POST['password'];
                $connection =$this->openConnection();
                $statement=$connection->prepare("SELECT * FROM users_table WHERE email=? AND password=?");
                $statement->execute([$email,$password]);
                $user= $statement->fetch();
                $total= $statement->rowCount();
                if($total>0 ){
                $_SESSION['username']=$user['fullName'];
                unset($_SESSION['errorMsg']);
                if($user['type']==1){
                    header('location:index.php');
                }else if($user['type']==0){
                    header('location:waiterlanding.php');
                }
               
              
                }else{
                    echo "login failed";
                    $_SESSION['errorMsg']="* username or password is invalid";
                }
                //print_r($user[0]);
           }
          
        }//end of log in
        public function signup(){
            if(isset($_POST['signup'])){
                 $username=$_POST['fullname'];
                 $password=$_POST['password'];
                 $email=$_POST['email'];
                 $type=0;
                 $connection =$this->openConnection();
                 $statement=$connection->prepare("INSERT INTO  users(username,email,password,type) VALUES (?,?,?,?)");
                 $statement->execute([$username,$email,$password,$type]);
            }
         }


        
        
   //for admin functionalities
   //display all menu details
        public function dispMenu(){
                $connection =$this->openConnection(); 
                $statement=$connection->prepare("SELECT * FROM menu  WHERE deleteAt is  NULL");
                $statement->execute();
                $items = $statement->fetchAll();
                foreach($items as $item) 
             {  
             echo'  <tr>
             <td>
                '.$item['menuID'].'
             </td>
             <td>
                '.$item['menuName'].'
             </td>
             <td>
                '.$item['category'].'
             </td>
             <td>
             
             <!-- Edit Menu Modal -->
            <div class="modal fade editModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                <input type="hidden" name="ID"value="'.$item['menuID'].'">
                                <div class="form-group input-group-lg">
                                    <label for="exampleInputEmail1">Category</label>
                                    <input type="text" class="form-control"name="newCategory" aria-label="Large" placeholder="'.$item['category'].'">
                                </div>
                                <div class="form-group input-group-lg">
                                    <label for="exampleInputEmail1">Menu Name</label>
                                    <input type="text" class="form-control" name="newMenuName"aria-label="Large" placeholder="'.$item['menuName'].'">
                                </div>
                                <div class="form-group input-group-lg">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="number" class="form-control" name="newPrice"aria-label="Large" placeholder="'.$item['price'].'" >
                                </div>
                           </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit"  name="editMenuBtn"class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
            <form method="post">
            <button  type="button"class="btn btn-info editBtn">Edit</button>
            <input type="hidden" name="id"value="'.$item['menuID'].'">
             <button type="submit"class="btn btn-danger" name="deleteBtn">Delete</button>
            </form>
             </td>
             </tr>';
             }
        }
        

        public function addMenu(){
            if(isset($_POST['addMenuBtn'])){
                $dateAdded = date('Y-m-d H:i:s');
                $category=$_POST['category'];
                $menuName=$_POST['menuName'];  
                $price=$_POST['price'];    
                $connection =$this->openConnection(); 
                $statement=$connection->prepare("INSERT INTO  menu(category,menuName,price,createdAt) VALUES(?,?,?,?)");
                $statement->execute([$category,$menuName,$price,$dateAdded]);
            }
        }
        
        public function deleteMenu(){
            if(isset($_POST['deleteBtn'])){
                $deletedAt = date('Y-m-d H:i:s');
                $id=$_POST['id'];    
                $connection =$this->openConnection(); 
                $statement=$connection->prepare("UPDATE menu  SET deleteAt=? WHERE menuID=$id");
                $statement->execute([$deletedAt]);
            }
        }

        public function updateMenu(){
            if(isset($_POST['editMenuBtn'])){
                $updatedAt = date('Y-m-d H:i:s');
                $id=$_POST['ID']; 
                $newCategory=$_POST['newCategory']; 
                $newMenuName=$_POST['newMenuName'];   
                $newPrice= intVal($_POST['newPrice']); 
                $connection =$this->openConnection(); 
                $statement=$connection->prepare("UPDATE menu  SET  category=?, menuName=?,price=?,updatedAt=?  WHERE menuID=$id");
                $statement->execute([$newCategory,$newMenuName,$newPrice,$updatedAt]);
               
            }
        }
       

        
        public function addOrder(){
            if(isset($_POST['addOrder'])&& $_POST['menuName']!=""){
                 unset($_POST['addOrder']);
                 $category=$_POST['category'];
                 $menuName=$_POST['menuName'];
                 $quantity=$_POST['quantity'];
                 $status="pending";
                 $tableNo=intVal($_POST['tableNo']);
                 $connection =$this->openConnection();
                 $getPriceStatement=$connection->prepare("SELECT price FROM menu  WHERE menuName='$menuName'");
                 $getPriceStatement->execute();
                 $result=$getPriceStatement->fetch();
                 $price= $result['price'];
                 $subtotal=intVal($quantity)*intVal($price);
                 $statement=$connection->prepare("INSERT INTO  order_table(category,menuName,quantity,status,price,tableNo,subtotal) VALUES (?,?,?,?,?,?,?)");
                 $statement->execute([$category, $menuName,$quantity, $status, $price,$tableNo,$subtotal]);
               
            }
         }
        
          
        public function deleteOrder(){
            if(isset($_POST['cancelBtn'])){
                $menuName=$_POST['menuName'];    
                $connection =$this->openConnection(); 
                $statement=$connection->prepare("DELETE FROM  order_table  WHERE menuName=$menuName");
                $statement->execute();
            }
        }

           
        public function getCategories(){
            $connection =$this->openConnection(); 
            $statement=$connection->prepare("SELECT category FROM menu WHERE deleteAt is NULL GROUP BY category ");
            $statement->execute();
            $categories = $statement->fetchAll();
            foreach($categories as $category) 
                {  
                echo' <a class="dropdown-item dropdownBtn" href="#" >'.$category['category'].'</a>';
            }
        }
    
    

         public function logout(){
            if(isset($_POST['logout'])){
                session_start();
                session_destroy();
                header('location:login.php');
            }
         }
    }
    $myRestruant = new restaurant();

?>