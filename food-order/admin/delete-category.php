<?php  
   
   include('../config/constants.php');
   //check id and image_name are set or not

   if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
      // get value and delete
       $id = $_GET['id'];
       $_image_name = $_GET['image_name'];

       //remove physical img file
          
       if($_image_name!="")
       {
           //image is avai so delete it
           $path = "../images/category/".$_image_name;
           //remove image
           $remove = unlink($path);

           //if failed to remove img then add an error message to stop the process
           if($remove ==false)
           {
              //set session mssage
            $_SESSION['remove'] = "<div class='error'>failed to remove category image</div>";

              //redirect to manage category and end session
              header('location:'.SITEURL.'admin/manage-category.php');

              die();
           }
       }

       //Delete data from database

       $sql = "DELETE FROM tbl_category WHERE
        id=$id
       ";

       //execute query
       $res = mysqli_query($conn , $sql);

    // data is deleted from database or not
       if($res==true)
       {//set success mesage

        $_SESSION['delete'] = "<div class= 'success'>Category Deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

       }
       else
       {//failed message
        $_SESSION['delete'] = "<div class= 'error'>Failed to  Delete category .</div>";
        header('location:'.SITEURL.'admin/manage-category.php');

       }

       

    }
    else
    {
        //rediect to manage category
         header('location:'.SITEURL.'admin/manage-category.php');

    }

?>