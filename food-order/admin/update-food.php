<?php include('partials/menu.php'); ?>



 <div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1><br/><br/>
 
        <?php
             
           //check whetger the id is set or not 

           if(isset($_GET['id']))
           {
                //get id and other detail
                 $id = $_GET['id'];
                 //sql query
                 $sql= "SELECT * FROM tbl_food WHERE id=$id";

                 //execute quey
                 $res= mysqli_query($conn , $sql);

                 //count rows to check id is valid or not

                 //$count = mysqli_num_rows($res);
                 //if count is more than zero

                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $current_image = $row['image_name'];
                    $current_category = $row['category_id'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                 
           }
           else
           {
            //redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
           }

        ?>

        <form method="POST" action="" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
              <td>Title: </td>
              <td><input type="text"  name="title" value="<?php echo $title ;?>"  required></td>
             </tr>

             <tr>
              <td>Description: </td>
              <td>
              <textarea name="description"  rows="5" cols="30" required> <?php echo $description ;?> </textarea> 
            </td>
             </tr>

             <tr>
              <td>Price: </td>
              <td><input type="number"  name="price" value="<?php echo $price ;?>"  required></td>
             </tr>

             <tr>
              <td> Current image: </td>
              <td> 
                 <?php
                 if($current_image!="")
                 {
                    //display the image
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="130px">
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
              <td> Category: </td>
              <td>
                <select name="category">
                   <?php
                       $sql3 = "SELECT * FROM tbl_category WHERE  active='Yes'";
                       //execute query
                       $res3 = mysqli_query($conn, $sql3);
                       //count row
                       $count3 = mysqli_num_rows($res3);

                       //check whethr category avilable or not
                       if ($count3 >0) 
                       {
                        //cat available
                        while($row3=mysqli_fetch_assoc($res3))
                        {
                          //get detail of category
                           $category_id = $row3['id'];
                           $category_title = $row3['title'];
                            //2. display on dropdown 
                           ?>
                           <option <?php if($current_category==$category_id){echo "selected";} ?>  value="<?php echo $category_id; ?>" ><?php  echo $category_title ?> </option>
                          
                           <?php

                        }


                       }
                       else
                       {
                        //not avilable
                        echo "<option value='0'>Category Not Available.</option>";
                       }
                   ?>
                </select>
              </td>
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
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                
               <input type="submit"  name="submit" value="Update Food" class ="btn-secondary">
              </td>
             </tr>

        </table>
       </form>

<?php

    if(isset($_POST['submit']))
    {
        // get all the values from form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $current_image = $_POST['current_image'];
        $category = $_POST['category'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //1updating image
          //check image is selected or not
          if(isset($_FILES['image']['name']))
          {
            //get image detail
            $image_name = $_FILES['image']['name'];

            //check img is availabel or not
            if($image_name!="")
            {
               //A.uoload image 
                //auto rename image
               //get extension of img(jpg, png , gif, etc )

                $ext = end(explode('.', $image_name));

                //rename the img
                $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;

                 $source_path = $_FILES['image']['tmp_name'];
                 $destination_path = "../images/food/".$image_name;

                  //upload image  

                  $upload = move_uploaded_file($source_path, $destination_path);

                 //check image is uploaded or not 

                 //if image is not uploaded then we will stop process and rediret with error process 
                  if($upload==false)
                   {

                     $_SESSION['upload'] = "<div class='error'> failed to upload new image </div>";
                     header('location:'.SITEURL.'admin/manage-food.php');
                     //stop process 
                     die();
                     }

              //B.remove current img if available

                   if($current_image!="")
                    {
                        $remove_path = "../images/food/".$current_image;
                        $remove = unlink($remove_path);

                        //check img is remove or not

                        if($remove==false)
                       {
                         $_SESSION['failed-remove'] = "<div class='error'> Failed to remove current image </div>";
                         header('location:'.SITEURL.'admin/manage-food.php');
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
             $image_name = $current_image; //image is selected o not
          }


        // update database

         $sql2 = "UPDATE tbl_food SET 
         title = '$title',
         description ='$description',
         price = $price,
         image_name = '$image_name',
         category_id ='$category',
         featured='$featured',
         active='$active'
         WHERE id=$id
         ";

         //execute query
          $res2 = mysqli_query($conn , $sql2);

        //rediret to manage cat

         if($res2==true)
          {
             $_SESSION['update'] = "<div class='success'> Updated Successfully. </div>";
             header('location:'.SITEURL.'admin/manage-food.php');
                
          }
          else
          {
              $_SESSION['update'] = "<div class='error'>Failed to Update Food. </div>";
              header('location:'.SITEURL.'admin/manage-food.php');
              
          } 
          
    }
   
?>

    </div>
</div>    
<?php include('partials/footer.php'); ?>

