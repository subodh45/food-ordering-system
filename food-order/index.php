<?php include('partials-front/menu.php'); 


if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];  // disp;ayy
            unset($_SESSION['add']); // remove 
        }

        if(isset($_SESSION['user-login']))
        {
            echo $_SESSION['user-login'];  // disp;ayy
            unset($_SESSION['user-login']); // remove 
        }
?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
            if(isset($_SESSION['order']))
            {
              echo $_SESSION['order'];
              unset($_SESSION['order']);
            }
          
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
              //create sql query to display cat from db

              $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3 ";

              //execute query

              $res = mysqli_query($conn, $sql);
             // count rows to check cat is available or not
              $count = mysqli_num_rows($res);

              if($count>0)
              {
                //cate vailable
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values 
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    ?>
                      <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                      <div class="box-3 float-container">
                        <?php
                        //check img is avil  or not 
                           if($image_name=="")
                           {
                            echo "<div class='error'>Image not Available. </div>";
                           }
                           else
                           {
                            //image availbel
                            ?>
                              <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                            <?php
                           }
                        ?>
                      

                      <h3 class="float-text text-white"><?php echo $title ; ?></h3>
                       </div>
                        </a>

                    <?php
                }
              }
              else
              {
                //cat not avilabel
                echo "<div class='error'>Category NOt Available.</div>";
              }
 
                ?>

           

            <div class="clearfix"></div>
            <p class="text-center">
            <a href="<?php echo SITEURL; ?>categories.php">See All Categories</a>
        </p>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
               //create sql query to display food that are active and featured 
               
                $sql2 ="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 4 ";

                //execute query

                $res2 = mysqli_query($conn, $sql2);
                //count rows
                $count2 = mysqli_num_rows($res2);

                //check food is availa or not
                if ($count2>0)
                {
                    //food avial
                    while($row2 = mysqli_fetch_assoc($res2))
                    {
                        //get all the values 
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
 
                         <div class="food-menu-box">
                             <div class="food-menu-img">
                                <?php
                                   //check img is vail or bot
                                   if($image_name=="")
                                   { 
                                     echo "<div class='error'>image not avalable.</div>";

                                   }
                                   else
                                   {
                                      //img availebl
                                      ?>
                                      <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                      <?php
                                   }
                                ?>
                                 
                             </div>

                            <div class="food-menu-desc">
                              <h4><?php echo $title; ?></h4>
                              <p class="food-price">₹<?php echo $price; ?></p>
                              <p class="food-detail">
                              <?php echo $description; ?>
                              </p>
                              <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                           </div>
                        </div>

                        <?php

                    }

                }
                else
                {
                    //not availabel
                    echo "<div class='error'>Food NOt Available.</div>";
                }
                 
                  ?>
         
            <div class="clearfix"></div>

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>