<?php
  //1. destroy the session and redirect to login page

  include('../config/constants.php');

 // session_destroy(); //unsets $_SESSION['user']

 unset($_SESSION['user']);

  //2. rdirect to login

  header('location:'.SITEURL.'admin/login.php')

?>