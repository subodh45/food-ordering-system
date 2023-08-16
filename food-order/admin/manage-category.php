<?php include('partials/menu.php'); ?>
<!-- main section starts  --> 
<div class="main-content">
             <div class="wrapper" > 
                 <strong><h1> manage category</h1></strong>

                  <!-- button to add category  --> 
                <br/><br/>  
               <a href="<?php echo SITEURL; ?>admin/add-category.php"  class="btn-primary"> Add Category </a>
                <br/>  <br/> <br/>       
                     <?php 

                          if(isset($_SESSION['add']))
                           {
                             echo $_SESSION['add'];  // disp;ayy
                             unset($_SESSION['add']); // remove 
                            }

                            if(isset($_SESSION['remove']))
                           {
                             echo $_SESSION['remove'];  // disp;ayy
                             unset($_SESSION['remove']); // remove 
                            }

                            if(isset($_SESSION['delete']))
                            {
                              echo $_SESSION['delete'];  // disp;ayy
                              unset($_SESSION['delete']); // remove 
                             }

                             if(isset($_SESSION['no-category']))
                             {
                               echo $_SESSION['no-category'];  // disp;ayy
                               unset($_SESSION['no-category']); // remove 
                              }
                  
                              if(isset($_SESSION['update']))
                              {
                                echo $_SESSION['update'];  // disp;ayy
                                unset($_SESSION['update']); // remove 
                               }

                               if(isset($_SESSION['upload']))
                              {
                                echo $_SESSION['upload'];  // disp;ayy
                                unset($_SESSION['upload']); // remove 
                               }

                               if(isset($_SESSION['failed-remove']))
                               {
                                 echo $_SESSION['failed-remove'];  // disp;ayy
                                 unset($_SESSION['failed-remove']); // remove 
                                }
                  
                  ?>


                 <table class="tblfull" >

                    <tr>
                        <th>S.no</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>active</th>
                        <th>Action </th>
                    </tr>

                    <?php 
                    
                     $sql ="SELECT *  FROM tbl_category";

                     //execute Query

                     $res = mysqli_query($conn,$sql);

                     $count = mysqli_num_rows($res);
                     $sn =1;
                     if($count>0)
                     {
                       //we have data 
                       while($row=mysqli_fetch_assoc($res))
                       {
                           $id = $row['id'];
                           $title = $row['title'];
                           $image_name = $row['image_name'];
                           $featured = $row['featured'];
                           $active = $row['active'];

                           ?>
                              <tr>
                        <td><?php  echo $sn++; ?></td>
                        <td><?php  echo $title; ?></td>

                        <td>
                            <?php  
                             //check whether image name is avilael or not

                             if($image_name!="")
                             {
                                //display image 
                                ?>
                                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                <?php

                             }
                             else
                             {
                                //diaplay message 
                                echo "<div class='error'>Image not Added </div>";
                             }
                            ?>
                        </td>

                        <td><?php  echo $featured; ?></td>
                        <td><?php  echo $active; ?></td>
                        <td>
                           <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">  Update Category </a>
                           <a href="<?PHP echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn-danger">  Delete Category </a>
                            
                        </td>
                    </tr>
 

                        <?php

                       }
        
                     }
                     else
                     {
                       //we dont jave data in db
                       //we'll display mesage in table
                       ?>
                           <tr> <td colspan ='6'><div class="error"> No category added  </div></td>
                     </tr>
                       <?php
                     }



                    ?>



                 </table>
                
                 
                 <div class="clearfix"></div>
             </div>
            </div>
    <!-- main section ends  --> 
<?php include('partials/footer.php'); ?>