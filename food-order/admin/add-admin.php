<?php include('partials/menu.php'); ?>
 
<!-- main section starts  --> 
 <div class="main-content">
             <div class="wrapper" > 
               <h1> Add Admin</h1>
                <br/><br/>
<?php  
    if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];  // disp;ayy
            unset($_SESSION['add']); // remove 
        }
?> 

               <form action="" method="POST">
                   <table class="tbl-30">
                      <tr>
                          <td>Full Name:</td>
                          <td><input type="text" name="full_name" placeholder="Enter  Name" required></td>
                      </tr>

                      <tr>
                          <td>Username:</td>
                          <td><input type="text" name="username" placeholder="Enter  Username" required></td>
                      </tr>

                      <tr>
                          <td>Password:</td>
                          <td><input type="password" name="password" placeholder="Enter Password" required ></td>
                      </tr>
                     
                      <tr>
                          <td colspan="2">
                          <input type="submit" name="submit" value="Add Admin" class="btn-secondary" ></td>
                      </tr>

                    </table>



               </form>

            </div>
  </div>   

<?php include('partials/footer.php'); ?>


<?php
 //process value from form and save it in database 

 //check where the button is placed or not 

 if(isset($_POST['submit']))
 {
    //echo "button click";

    //get data from form
     $full_name = $_POST['full_name'] ;
     $username = $_POST['username'] ;
     $password = md5($_POST['password']) ;   //pass is encrepted with md5 it is one way 

//sql query to save data in database 

    $sql = "INSERT INTO tbl_admin SET 
    full_name='$full_name', 
    username='$username',
    password='$password'
    ";
 
 //USING CONSTANT TO CONNECT WITH DATABASE from menu partial

  //executing query and saving data into database 

  $res =mysqli_query($conn, $sql)  or die(mysqli_error());

  //4.check whether the data is inserted or not and display  message 
  if($res==TRUE)
  { //create session variable to disolay mesage
    $_SESSION['add']="<div class='success'>Admin  Added Successfully.</div>" ;
      header("location:".SITEURL.'admin/manage-admin.php');
     
  }
  else
  {
    $_SESSION['add']="<div class='error'> Failed to Add Admin.</div>" ;
    header("location:".SITEURL.'admin/add-admin.php');

  }

 }

?>