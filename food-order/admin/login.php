<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>food-order-admin-login </title>
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
  
     <div class="login">
      <h1 class="text-center">Admin Login</h1><br/><br/>

      <?php
           if(isset($_SESSION['login']))
           {
               echo $_SESSION['login'];  // disp;ayy
               unset($_SESSION['login']); // remove 
           }
 
           if(isset($_SESSION['no-login-message']))
           {
               echo $_SESSION['no-login-message'];  // disp;ayy
               unset($_SESSION['no-login-message']); // remove 
           }

      ?>
     <br/><br/>
        <form action="" method="POST">
           Username: <br/>
            <input type="text" name="username" placeholder="enter username here" required><br/><br/>
            Password:<br/>
            <input type="password"  name="password" placeholder="enter password" required >
            <br/><br/>

            <input type="submit" name="submit" value="  login  " class="btn-primary" ><br/><br/>
 
        </form>
             <p class="text-center">created by us.</p>

       
     </div>
   
    
</body>
</html>

<?php
//check button is pressed 

  if(isset($_POST['submit']))
  {
    //process to login

    //1 get the DATA from login

    $username= mysqli_real_escape_string($conn, $_POST['username']);
    $password= mysqli_real_escape_string($conn, md5($_POST['password']));
 
    //2. sql to check user and pass is exist

    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";

    //3.execute query 

    $res = mysqli_query($conn,$sql);

    //count rows to check user exist or no

    $count = mysqli_num_rows($res);

    if($count==1)
    {
      //user exist
      $_SESSION['login'] = "<div class='success'> Login successful. </div>";
      $_SESSION['user'] = $username; //TO get user is login or not 
    
      //rediret
      header('location:'.SITEURL.'admin/');
    }
    else
    {
     //user not exist 
     $_SESSION['login'] = "<div class='error text-center'> usrname and password didn't match.   </div>";
     //rediret
     header('location:'.SITEURL.'admin/login.php');

    }


  }
  else
  {
     //back to login page 
  }
?>