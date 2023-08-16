<?php include('partials/menu.php');?>
  
<div class="main-content">
             <div class="wrapper" > 
                 <h1> Add category</h1>

                  <br/> <br/>
                  <?php 

                          if(isset($_SESSION['add']))
                           {
                             echo $_SESSION['add'];  // disp;ayy
                             unset($_SESSION['add']); // remove 
                            }
                     
                            if(isset($_SESSION['upload']))
                            {
                              echo $_SESSION['upload'];  // disp;ayy
                              unset($_SESSION['upload']); // remove 
                             }
                  
                  ?>

                 <form action="" method="POST" enctype="multipart/form-data">
                 <table class="tbl-30">
                      <tr>
                          <td>Title :</td>
                          <td><input type="text" name="title" placeholder="Enter category  Title" required></td>
                      </tr>
 
                      <tr>
                          <td>Select image : </td>
                          <td><input type="file" name="image" ></td>
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

                       <tr></tr>
                     
                      <tr>
                          <td colspan="2">
                          <input type="submit" name="submit" value="Add Category" class="btn-secondary" ></td>

                      </tr>

                    </table>

                 </form>
                 

            </div>
    </div>


<?php include('partials/footer.php');?>

<?php
//check button is clicked or not

    if(isset($_POST['submit']))
    {
        //get the value from form

        $title = $_POST['title'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];


        //check image is selected or not and set name of image 
        //print_r($_FILES['image']); using this we can see name and tmp_name of file 
        //die(); break the code

        if(isset($_FILES['image']['name']))
        {
           //upload imagw 
           // to uploaf imagwe we need img name , source and dest path
           $image_name = $_FILES['image']['name'];

           //upload the img only  if image is selected
           
          if($image_name != "")
          {  

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

            $_SESSION['upload'] = "<div class='error'> failed to upload image. </div>";
            header('location:'.SITEURL.'admin/add-category.php');
            //stop process 
            die();
           }

         }
        }
        else 
        {
         //dont upload image 
          $image_name="";
        }

        //sql query

        $sql = "INSERT INTO tbl_category SET 
         title ='$title',
         image_name = '$image_name',
         featured ='$featured',
         active='$active' 
        ";

        //execute query and save in database

        $res = mysqli_query($conn, $sql);
        
        //chgeck qyery is executed or not
        if($res==true)
        {
          //qyery executed 
          $_SESSION['add'] = "<div class ='success'> Category Added successfully.  </div>";
          header('location:'.SITEURL.'admin/manage-category.php');

        }
        else
        {
           //failed to executed query
           $_SESSION['add'] = "<div class ='error'>Failed to Add Category.  </div>";
           header('location:'.SITEURL.'admin/add-category.php');

        }

    }
    else{
        
    }

?>