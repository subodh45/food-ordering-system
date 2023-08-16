<?php include('partials/menu.php'); ?>
<!-- main section starts  --> 
<div class="main-content">
             <div class="wrapper" > 
                 <strong><h1> manage food</h1></strong>

                  <!-- button to add food  --> 
                <br/><br/>  
               <a href="<?php echo SITEURL; ?>admin/add-food.php"  class="btn-primary"> Add Food </a>
                <br/>  <br/> <br/>
                  <?php
                    if(isset($_SESSION['add']))
                    {
                      echo $_SESSION['add'];  // disp;ayy
                      unset($_SESSION['add']); // remove 
                     }

                     if(isset($_SESSION['delete']))
                    {
                      echo $_SESSION['delete'];  // disp;ayy
                      unset($_SESSION['delete']); // remove 
                     }

                     if(isset($_SESSION['remove']))
                    {
                      echo $_SESSION['remove'];  // disp;ayy
                      unset($_SESSION['remove']); // remove 
                     }

                     if(isset($_SESSION['delete-food']))
                     {
                       echo $_SESSION['delete-food'];  // disp;ayy
                       unset($_SESSION['delete-food']); // remove 
                      }

                      if(isset($_SESSION['no-food']))
                     {
                       echo $_SESSION['no-food'];  // disp;ayy
                       unset($_SESSION['no-food']); // remove 
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
      
                       if(isset($_SESSION['update']))
                       {
                        echo $_SESSION['update'];  // disp;ayy
                        unset($_SESSION['update']); // remove 
                       }

                    ?>
                
                 <table class="tblfull" >

                    <tr>
                        <th>S.no</th>
                        <th>Title </th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                       //create sql query
                       $sql = "SELECT * FROM tbl_food"; 
                
                       //execute Query

                     $res = mysqli_query($conn,$sql);

                     $count = mysqli_num_rows($res);
                     $sn = 1;

                      if($count>0)
                      {
                        //we have food in db
                        //GET FOOD FROM DB AND DISPLAY

                        while($row=mysqli_fetch_assoc($res))
                        {
                          //get value from indvidual
                          $id=$row['id'];
                          $title = $row['title'];
                          $price = $row['price'];
                          $image_name = $row['image_name'];
                          $featured = $row['featured'];
                          $active = $row['active'];
                           ?>

                          <tr>
                              <td><?php echo $sn++ ; ?> </td>
                              <td><?php echo $title ; ?> </td>
                              <td><?php echo $price ; ?> </td>
                              <td>
                              <?php 
                                 //check whether we have img or not
                                 if($image_name=="")
                                 {
                                  //display error message 
                                  echo "<div class='error'>Image not added.</div>";
                                 }
                                 else
                                 {
                                  //disolay image 
                                  ?>
                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width='100px'>
                                  <?php
                                 }
                              
                              ?> 
                              </td>
                              <td><?php echo $featured ; ?> </td>
                              <td><?php echo $active ; ?> </td>
                        
                    
                              <td>
                               <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">  Update Food </a>
                               <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">  Delete Food </a>
                            
                              </td>
                          </tr>

                         <?php


                        }
                      }
                      else
                      {
                        //food not added in db

                        echo "<tr><td colspan='7' class='error'>FOOD NOT ADDED YET.</td></tr>";
                      }


                          ?>

                 </table>
                
                 
                 <div class="clearfix"></div>
             </div>
            </div>
    <!-- main section ends  --> 
<?php include('partials/footer.php'); ?>