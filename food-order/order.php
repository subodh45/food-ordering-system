<?php include('partials-front/menu.php'); ?>
  

<?php 
    
    if(isset($_SESSION['normal-user']))
        {
            $username = $_SESSION['normal-user'];  // assign session username value to the $username
            
        }

    //check whether food id is set or not
    if(isset($_GET['food_id']))
    {
         //GET the food  id and detail
         $food_id = $_GET['food_id'];

         //get detail of selected food 

         $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
         //execute query
         $res = mysqli_query($conn,$sql);

         $count = mysqli_num_rows($res);
         if($count==1)
         {
            //food available
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

         }
         else
         {
            //food not availablr
            header('location:'.SITEURL);
         }
    }
    else
    {
        //redirect to home page 
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                           if($image_name=="")
                           {
                            //image not added 
                            echo "<div class='error'>Image not added</div>";
                            

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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        <input type="hidden" name="username" value="<?php  echo $username; ?>">
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g.Virat Kohli" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. vkohli@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
               
               //check whether button is clivk or not
               if(isset($_POST['submit']))
               {
                  //get all the details from fotm
                  $food = $_POST['food'];
                  $price = $_POST['price'];
                  $qty = $_POST['qty'];
                  $total = $price * $qty;
                  $order_date = date("Y-m-d h:i:sa"); //order date
                  $status = "Ordered"; //ordered , on delivery , delivered , cancle
                  $customer_name = $_POST['full-name'];
                  $customer_contact = $_POST['contact'];
                  $customer_email = $_POST['email'];
                  $customer_address = $_POST['address'];
                  $username = $_POST['username'];

                  //save the order in database
                  //create sql

                  $sql2 = "INSERT INTO tbl_order SET
                         food = '$food',
                         price = $price,
                         qty = $qty,
                         total = $total,
                         order_date = '$order_date',
                         status = '$status',
                         customer_name = '$customer_name',
                         customer_contact = '$customer_contact',
                         customer_email = '$customer_email',
                         customer_address = '$customer_address',
                         username='$username'

                  ";

                  //execyte query

                  $res2 = mysqli_query($conn , $sql2);

                    if($res2==true)
                    {
                        //query executed and order save 
                        $_SESSION['order'] = "<div class='success text-center' >Order placed Successfully.</div>";
                        header('location:'.SITEURL);

                    }
                    else
                    {
                        //failed to save order 
                        $_SESSION['order'] = "<div class='error text-center'>Failed to placed order. </div>";
                        header('location:'.SITEURL);
                    }
               }
               else
               {

               }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>