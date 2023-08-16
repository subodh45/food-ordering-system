<?php  include('partials/menu.php') ?>
<div class="main-content">
             <div class="wrapper" > 
               <h1> Change  Password</h1>
               <br/><br/>

               <?php
                  if (isset($_GET['id']))
                  {
                    $id=$_GET['id'];
                  }  
               ?>

               <form action="" method="POST">
                  <table class="tbl-30">
                      <tr>
                          <td>Current Password:</td>
                          <td><input type="password" name="current_password" placeholder="current password" required ></td>
                      </tr>

                      <tr>
                          <td>New Password:</td>
                          <td><input type="password" name="new_password" placeholder="new password" required ></td>
                      </tr>

                      <tr>
                          <td>Confirm  Password:</td>
                          <td><input type="password" name="confirm_password" placeholder="confirm password" required ></td>
                      </tr>
                     
                      <tr>
                          <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="submit" name="submit" value="Change Password" class="btn-secondary" >
                          </td>
                      </tr>
                  
                   </table>
  
            </form>
             </div>
</div>               

<?php
//check submit button click or not
   if(isset($_POST['submit']))
   {  
     // $id=$_POST['id']

     //1 get data from form
     $id = $_POST['id'];
     $current_password =md5( $_POST['current_password'] );
     $new_password = md5($_POST['new_password'] );
     $confirm_password = md5($_POST['confirm_password']);
     
     //2 check whether withb current id or pass exist
      $sql ="SELECT * FROM tbl_admin WHERE id=$id AND  password='$current_password'";

      //execute query

      $res = mysqli_query($conn, $sql);

      if($res==TRUE)
      {
        $count = mysqli_num_rows($res);
        if($count==1)
        {
              //get detail
             //echo "user found";
             //3 check new and confirm pass are same or not

             if($new_password==$confirm_password)
             {
                //update password
                $sql2 = "UPDATE tbl_admin SET 
                password='$new_password'
                WHERE id=$id
                ";

                //execute query

                $res2 =mysqli_query($conn, $sql2)  or die(mysqli_error());

                 if($res2==TRUE)
                 {
                   //display mesage 
                   $_SESSION['pwd-update'] = "<div class='success'>password changed successfully. </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');

                 }
                 else{
                     //display error 
                     $_SESSION['pwd-update'] = "<div class='error'>password failed to change. </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');

                 }
             } 
             else
             {
                $_SESSION['pwd-not-match'] = "<div class='error'>password didn't match. </div>";
                header('location:'.SITEURL.'admin/manage-admin.php');

             }
        }
        else
        {  
           $_SESSION['user-not-found'] = "<div class='error'>User Not Found </div>";
           header('location:'.SITEURL.'admin/manage-admin.php');

        }
      }

     //3 check new and confirm pass are same or not



     //4 update chnge pass


   }
?>

<?php  include('partials/footer.php') ?>