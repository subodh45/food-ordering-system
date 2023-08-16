<?php include('partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food </h1>
        <br/><br/>

        <?php
                if(isset($_SESSION['upload']))
                {
                  echo $_SESSION['upload'];  // disp;ayy
                  unset($_SESSION['upload']); // remove 
                 }

                 if(isset($_SESSION['add']))
                 {
                   echo $_SESSION['add'];  // disp;ayy
                   unset($_SESSION['add']); // remove 
                  }
        ?>

      <form action="" method="POST" enctype="multipart/form-data">

      <table class="tbl-30">

         <tr>
           <td>Title:</td>
           <td><input type="text" name="title" placeholder="Enter title of food" required> </td>
         </tr>
 
         <tr>
           <td>Description:</td>
           <td><textarea name="description" placeholder="Enter description of food" rows="5" cols="30" required></textarea> </td>
         </tr>

         <tr>
           <td>Price:</td>
           <td><input type="number" name="price" required > </td>
         </tr>

         <tr>
           <td>Image:</td>
           <td><input type="file" name="image" > </td>
         </tr>

         
         <tr>
           <td>Categoty:</td>
           <td>
              <select name="category">


                  <?php
                     //php to display category from database

                      //1.create SQL to get active category from datbase 
                      $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                      //excuy=te query
                      $res = mysqli_query($conn , $sql);

                      //check no of rows whwther we have categories or not

                      $count = mysqli_num_rows($res);

                      // if count is greater than sero we have categoris else we dont hav categories 

                      if($count>0)
                      {
                          //we have categories 

                          while($row=mysqli_fetch_assoc($res))
                          {
                            //get detail of category
                             $id = $row['id'];
                             $title = $row['title'];
                              //2. display on dropdown 
                             ?>
                             <option value="<?php echo $id; ?>" ><?php  echo $title ?> </option>
                            
                             <?php

                          }

                      }
                      else
                      {
                        //dont have cate
                        ?>
                          <option value="0" > No Category found </option>
                        <?php

                      }



                    ?>

              </select>

           </td>
         </tr>
         
         <tr>
             <td>Featured:</td>
            <td><input type="radio" name="featured" value="Yes" checked="checked" >Yes
                <input type="radio" name="featured" value="No"  >No
           </td>
         </tr>
            
         <tr>
             <td>Active:</td>
            <td><input type="radio" name="active" value="Yes" checked="checked" >  Yes
                <input type="radio" name="active" value="No" >No
           </td>
         </tr>

         <tr>
            <td>
             <input type="submit" name="submit" value="Add Food " class="btn-secondary">
            </td>

        </tr>


      </table>
       
      </form>

      <?php
        if(isset($_POST['submit']))
        {
           //add data into databas

           //1. get data from  form
             $title = $_POST['title'];
             $description = $_POST['description'];
             $price = $_POST['price'];
             $category = $_POST['category'];
             $featured = $_POST['featured'];
             $active = $_POST['active'];


           //2. upload img if selected

              //check image is selected or not and set name of image  and upload if image is selected
              if(isset($_FILES['image']['name']))
              {
               //get detail of img
               $image_name = $_FILES['image']['name'];

               //check img is selected or not upload if image is selected
                 if($image_name!="")
                 {
                  //img is selected 
                  //rename the image
                  $ext = end(explode('.', $image_name));

                   //rename the img
                   $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;  //new image name
                   //souce path is current path of img and dest path is path where img is uploaded

                   $source_path = $_FILES['image']['tmp_name'];
                   $destination_path = "../images/food/".$image_name;

                   //upload img
                   $upload = move_uploaded_file($source_path, $destination_path);

                  //check image is uploaded or not

                   //if image is not uploaded then we will stop process and rediret with error process 
                    if($upload==false)
                      {
                        $_SESSION['upload'] = "<div class='error'> failed to upload image. </div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        //stop process 
                          die();
                       }
                 }
                 

              }
              else
              {
                $image_name = ""; //default value
              }


           //3. insert into databas

           //sql query

           $sql2 = "INSERT INTO tbl_food SET 
                      title ='$title',
                      description ='$description',
                      price = $price,
                      image_name = '$image_name',
                      category_id =$category,
                      featured = '$featured',
                      active = '$active'
                      ";

           //execute query and save in database

           $res2 = mysqli_query($conn, $sql2);

           //4. redirect to manage-food
           if($res2==true)
           {
             //qyery executed 
             $_SESSION['add'] = "<div class ='success'> Food Added successfully.  </div>";
             header('location:'.SITEURL.'admin/manage-food.php');
   
           }
           else
           {
              //failed to executed query
              $_SESSION['add'] = "<div class ='error'>Failed to Add food.  </div>";
              header('location:'.SITEURL.'admin/add-food.php');
   
           }
   
        }
        



        ?>

    </div>  
</div>

<?php include('partials/footer.php') ?>


