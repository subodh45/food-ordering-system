<?php include('partials/menu.php'); ?>



 <div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1><br/><br/>
 
        <?php
           //check whetger the id is set or not 

           if(isset($_GET['id']))
           {
                //get id and other detail
                 $id = $_GET['id'];
                 //sql query
                 $sql= "SELECT * FROM tbl_category WHERE id=$id";

                 //execute quey
                 $res= mysqli_query($conn , $sql);

                 //count rows to check id is valid or not

                 $count = mysqli_num_rows($res);
                 //if count is more than zero

                 if($count==1)
                 {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                 }
                 else
                 {  $_SESSION['no-category'] = "<div class='error' > Category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                 }

           }
           else
           {
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
           }

        ?>

        <form method="POST" action="" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
              <td>Title: </td>
              <td><input type="text"  name="title" value="<?php echo $title ;?>" required></td>
             </tr>

             <tr>
              <td> Current image: </td>
              <td> 
                 <?php
                 if($current_image != "")
                 {
                    //display the image
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="130px">
                  <?php
                 }
                 else
                 {
                    //error
                    echo "<div class='error'>Image is not added </div>";

                 }

                 ?>

              </td>
             </tr>

             
             <tr>
              <td> New image: </td>
              <td><input type="file" name="image"></td>
             </tr>

             <tr>
              <td>Featured: </td>
              <td><input type="radio" <?php  if($featured=="Yes"){echo "checked"; } ?> name="featured"  value="Yes" > Yes
              <input type="radio" <?php  if($featured=="No"){echo "checked"; } ?>  name="featured"  value="No" > No
            </td>
             </tr>

             <tr>
              <td>Active: </td>
              <td><input type="radio" <?php  if($active=="Yes"){echo "checked"; } ?>  name="active"  value="Yes" > Yes
              <input type="radio"  <?php  if($active=="No"){echo "checked"; } ?> name="active"  value="No" > No
            </td>
             </tr>

             <tr>
              
              <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="submit"  name="submit" value="Update Category" class ="btn-secondary"></td>
             </tr>




        </table>
       </form>

<?php
    if(isset($_POST['submit']))
    {
        // get all the values from form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //1updating image
          //check image is selected or not
          if(isset($_FILES['image']['name']))
          {
            //get image detail
            $image_name = $_FILES['image']['name'];

            //check img is availabel or not
            if($image_name != "")
            {
               //A.uoload image 
                //auto rename image
               //get extension of img(jpg, png , gif, etc )

                $ext = end(explode('.', $image_name));

                //rename the img
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                 $source_path = $_FILES['image']['tmp_name'];
                  $destination_path = "../images/category/".$image_name;

                  //upload image  

                  $upload = move_uploaded_file($source_path, $destination_path);

                 //check image is uploaded or not 

                 //if image is not uploaded then we will stop process and rediret with error process 
                  if($upload==false)
                   {

                     $_SESSION['upload'] = "<div class='error'> failed to upload </div>";
                     header('location:'.SITEURL.'admin/manage-category.php');
                     //stop process 
                      die();
                     }

              //B.remove current img if available

                   if($current_image != "")
                    {
                        $remove_path = "../images/category/".$current_image;
                        $remove = unlink($remove_path);

                        //check img is remove or not

                        if($remove==false)
                       {
                         $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image </div>";
                         header('location:'.SITEURL.'admin/manage-category.php');
                         die();
 
                        }
                    }
            }
            else
            {
                $image_name = $current_image;
            }
          }
          else
          {
             $image_name = $current_image;
          }


        // update database

         $sql2 = "UPDATE tbl_category SET 
         title = '$title',
         image_name = '$image_name',
         featured='$featured',
         active='$active'
         WHERE id=$id
         ";

         //execute query
          $res2 = mysqli_query($conn,$sql2);

        //rediret to manage cat

        if($res2==true)
        {
           $_SESSION['update'] = "<div class='success'>Category Updated Successfully. </div>";
           header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['update'] = "<div class='error'>Failed to Update Category . </div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
    }

?>

    </div>
</div>    
<?php include('partials/footer.php'); ?>

