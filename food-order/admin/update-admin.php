<?php include('partials/menu.php');?>

<div class="main-content">
             <div class="wrapper" > 
                <h1>Update Admin</h1>
            <br/><br/>

            <?php
                  //1. get id of select id
 
                  $id=$_GET['id'];

                  //2. get info of selected id

                  $sql="SELECT * FROM tbl_admin WHERE id=$id";

                  //Execute quey
                  $res=mysqli_query($conn,$sql);

                  //check quey is executed or not

                  if($res==TRUE)
                  {
                    $count = mysqli_num_rows($res);
                    if($count==1)
                    {
                          //get detail
                          $row=mysqli_fetch_assoc($res);

                          $full_name=$row['full_name'];
                          $username=$row['username'];
                    }
                    else
                    {
                       header('location:'.SITEURL.'admin/manage-admin.php');

                    }
                  }
                  
            ?>

                <form action="" method="POST" >
                   <table class="tbl-30">
                   <tr>
                          <td>Full Name:</td>
                          <td><input type="text" name="full_name" value="<?php echo $full_name; ?>" required></td>
                      </tr>

                      <tr>
                          <td>Username:</td>
                          <td><input type="text" name="username" value="<?php echo $username; ?>" required></td>
                      </tr>

                      <tr>
                          <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="submit" name="submit" value="Update Admin" class="btn-secondary" >
                          </td>
                      </tr>
                       
                    </table>

                </form>

            </div>
            </div>

            <?php

               //process value from form and save it in database 

 //check where the button is placed or not 

 if(isset($_POST['submit']))
 {
    //echo "button click";

    //get data from form
    $id = $_POST['id'];
     $full_name = $_POST['full_name'] ;
     $username = $_POST['username'] ;
    
//sql query to update data in database 

    $sql = "UPDATE  tbl_admin SET 
    full_name='$full_name', 
    username='$username'
    WHERE id='$id'
   ";
 
 //USING CONSTANT TO CONNECT WITH DATABASE from menu partial

  //executing query and saving data into database 

  $res =mysqli_query($conn, $sql)  or die(mysqli_error());

  //4.check whether the data is inserted or not and display  message 
  if($res==TRUE)
  { //create session variable to disolay mesage
    $_SESSION['update']="<div class='success'>Admin  Updated Successfully.</div>" ;
      header("location:".SITEURL.'admin/manage-admin.php');
     
  }
  else
  {
    $_SESSION['update']="<div class='error'> Failed to update Admin.</div>" ;
    header("location:".SITEURL.'admin/add-admin.php');

  }

 }


            ?>


<?php include('partials/footer.php');?>