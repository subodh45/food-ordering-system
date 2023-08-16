<?php

   //autheticsation or access control
   //check user is login or n

   if(!isset($_SESSION['user']))
   {

    //user is not login redirect to login page 

    $_SESSION['no-login-message'] = "<div class='error'>Please login to access admin panel </div>";
    header('location:'.SITEURL.'admin/login.php');

   }
   else
   {

   } 




?>