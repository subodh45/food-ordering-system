<?php

   //autheticsation or access control
   //check user is login or n

   if(!isset($_SESSION['normal-user']))
   {

    //user is not login redirect to login page 

    $_SESSION['no-login-message'] = "<div class='error'>Please login to access website. </div>";
    header('location:'.SITEURL.'login.php');

   }
   else
   {

   } 




?>