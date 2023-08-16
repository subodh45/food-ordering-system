<?php include('partials-front/menu.php'); ?>

<?php  
   //check whether id is passed or not
   if(isset($_GET['category_id']))
   {
     //category id isset and get id
     $category_id = $_GET['category_id'];

     //get category title based on id

     $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
     //execute query
     $res = mysqli_query($conn, $sql);

     //get value from database
     $row = mysqli_fetch_assoc($res);

     $category_title = $row['title'];

   }
   else
   {
    //category not pass then redirect to home
    header('location:'.SITEURL);
   }  
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
               //create sql quey to get food based on category 
               $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

               $res2 = mysqli_query($conn , $sql2);

               //count rows 
               $count2 = mysqli_num_rows($res2);
               if ($count2 > 0) 
               {
                //food is avail
                while($row2 = mysqli_fetch_assoc($res2))
                {   $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];

                    ?>
                      <div class="food-menu-box">
                          <div class="food-menu-img">
                            <?php
                                //CHECK IMG IF AVAIL
                                if($image_name=="")
                                {
                                    //img not auil
                                  echo "<div class='error'> Image not Added. </div>";

                                }
                                else
                                {
                                    //display img
                                    ?>
                                     <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                    <?php
                                }

                            ?>
                           
                          </div>

                          <div class="food-menu-desc">
                             <h4><?php echo $title; ?></h4>
                              <p class="food-price">₹<?php echo $price ?></p>
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
                //food not avai
                echo "<div class='error'>Food Not available.</div>";
               }
            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>