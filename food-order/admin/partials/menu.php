<?php include('../config/constants.php');
      include('login-check.php');
 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="../css/admin.css" >
</head>
<body>
   <!-- Menu section starts  --> 
        <div class="menu text-center">
            <div class="wrapper" >
            <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="manage-admin.php">Admin</a>
                    </li>
                    <li>
                        <a href="manage-category.php">Categories</a>
                    </li>
                    <li>
                        <a href="manage-food.php">Foods</a>
                    </li>
                    <li>
                        <a href="manage-order.php">Order</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    <!-- Menu section ends  --> 