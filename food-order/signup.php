<?php include('config/constants.php'); ?>

<html>
   <head>
   <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>food-order-Signup </title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<!-- main section starts  --> 

             <div class="signup" > 
               <h1 class="text-center"> Signup page </h1>
               <br/> <br/>
                  <?php  
                    if(isset($_SESSION['add']))
                    {
                      echo $_SESSION['add'];  // disp;ayy
                      unset($_SESSION['add']); // remove 
                    }
                    ?> 

               <form action="" method="POST">
                   
                          Full Name:
                          <input type="text" name="full_name" placeholder="Enter  Name" required> <br/>  <br/>
                      
                          Username:
                          <input type="text" name="username" placeholder="Enter  Username" required>  <br/> <br/>
                    
                           Password:
                          <input type="password" name="password" placeholder="Enter Password" required >  <br/> <br/>
                        
                          <input type="submit" name="submit" value="  Signup  " class="btn-secondary" > <br/> <br/>

                          <a href="<?php echo SITEURL; ?>login.php" class='success' >click here for login.</a>
                      
               </form>

            </div>
  




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

    $sql = "INSERT INTO tbl_user SET 
    user_full_name='$full_name', 
    username='$username',
    password='$password'
    ";
 
 //USING CONSTANT TO CONNECT WITH DATABASE from menu partial

  //executing query and saving data into database 

  $res =mysqli_query($conn, $sql)  or die(mysqli_error());

  //4.check whether the data is inserted or not and display  message 
  if($res==TRUE)
  { //create session variable to disolay mesage
    $_SESSION['add']="<div class='success'>User  Added Successfully.</div>" ;
      header("location:".SITEURL.'index.php');
     
  }
  else
  {
    $_SESSION['add']="<div class='error'> Failed to Add User.</div>" ;
    header("location:".SITEURL.'signup.php');

  }

 }

?>

</body>
</html>