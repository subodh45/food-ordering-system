<?php include('partials/menu.php'); ?>

     <!-- main section starts  --> 
         <div class="main-content">
             <div class="wrapper" > 
               <h1> manage admin</h1>

               <!-- button to add admin  --> 
                <br/><br/>  
<?php if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];  // disp;ayy
            unset($_SESSION['add']); // remove 
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];  // disp;ayy
            unset($_SESSION['delete']); // remove 
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];  // disp;ayy
            unset($_SESSION['update']); // remove 
        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];  // disp;ayy
            unset($_SESSION['user-not-found']); // remove 
        }
        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];  // disp;ayy
            unset($_SESSION['pwd-not-match']); // remove 
        }

        if(isset($_SESSION['pwd-update']))
        {
            echo $_SESSION['pwd-update'];  // disp;ayy
            unset($_SESSION['pwd-update']); // remove 
        }

        
        


?>   <br/>  <br/>
        
               <a href="add-admin.php"  class="btn-primary"> Add Admin </a>
                <br/>  <br/> <br/>       
                 <table class="tblfull" >

                    <tr>
                        <th>S.no</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                     //query  to get all admin 
                     $sql = "SELECT * FROM tbl_admin";
                     //execute the query
                     $res = mysqli_query($conn, $sql);

                    //check whether query is execeuted 
                    if ($res==TRUE) 
                    {
                        //count rows  to check data in database or nort
                         $count = mysqli_num_rows($res);

                         $sn=1; //a variable to assign serial no to admin 
                         
                         if($count>0)
                         {
                            while( $rows =mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //display in table
                                ?>
                                 <tr>
                                    <td><?php  echo $sn++; ?></td>
                                    <td><?php  echo $full_name; ?></td>
                                    <td><?php  echo $username; ?></td>
                                    <td>
                                       <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">  Update Admin </a>
                                       <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">  Delete Admin </a>
                                       <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">  Change Password </a>
                            
                                    </td>
                                </tr>
                                    

              
                               <?php

                            }
                                     
                         }
                         else
                         {
                            //do not have data in data
                         }
                        
                    }
                   
                   ?>


                

                   
   

                 </table>
            
              <div class="clearfix"></div>
             </div>
            </div>
    <!-- main section ends  --> 

    <?php include('partials/footer.php'); ?>