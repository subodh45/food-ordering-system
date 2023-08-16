<?php
    //include cobstant page
   include('../config/constants.php');
 
 if(isset($_GET['id']) AND isset($_GET['image_name']))
 {
     //PROCEESS TO DELETE

     $id = $_GET['id']; 
     $image_name = $_GET['image_name'];

     // remove image if available

     if($image_name!="")
    {
           //image is avai so delete it
           $path = "../images/food/".$image_name;
           //remove image
           $remove = unlink($path);

           //if failed to remove img then add an error message to stop the process
           if($remove ==false)
           {
              //set session mssage
            $_SESSION['remove'] = "<div class='error'>failed to remove Food image</div>";

              //redirect to manage category and end session
              header('location:'.SITEURL.'admin/manage-food.php');

              die();
           }
    }
    
       //Delete data from database

       $sql = "DELETE FROM tbl_food WHERE
        id=$id
       ";

       //execute query
       $res = mysqli_query($conn , $sql);

       //check data is deleted from database or not

       if($res==true)
       {//set success mesage

        $_SESSION['delete-food'] = "<div class= 'success'>Food Deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

       }
       else
       {//failed message
        $_SESSION['delete-food'] = "<div class= 'error'>Failed to  Delete Food .</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

       }


 }
 else
  {
    //REDIRECT TO MANAGE FOOD page
    $_SESSION['delete'] = "<div class='error'>Unauthorised access.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
 }

?>