<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php  
                //get search keyword 
                //mysqli_real_escape_string() function are used to prevent from sql injection attack

              $search = mysqli_real_escape_string($conn , $_POST['search']);

            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
              
              //food based on search keyword
              //  $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'"
              $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

              //execute query
              $res = mysqli_query($conn, $sql);

              //count rows
              $count = mysqli_num_rows($res);
              //check wether food avilable or not
              if($count>0)
              {
                //food available
                while($row = mysqli_fetch_assoc($res))
                {
                  //get details
                  $id = $row['id'];
                  $title = $row['title'];
                  $price = $row['price'];
                  $description = $row['description'];
                  $image_name = $row['image_name'];
                  ?>

                     <div class="food-menu-box">
                       <div class="food-menu-img">
                        <?php
                            //check image name is avai or not

                            if($image_name=="")
                            {
                                //img not avail
                                echo "<div class='error'>Image Not Available.</div>";
                            }
                            else
                            {
                                //img available
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
                  //food not available
                  echo "<div class='error'>Food Not Found.</div>";
              }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>