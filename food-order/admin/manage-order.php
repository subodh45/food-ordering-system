<?php include('partials/menu.php'); ?>
<!-- main section starts  --> 
<div class="main-content" >
             <div class="food-manage" > 
                 <strong><h1>         manage order</h1></strong>

                  <!-- button to add admin  --> 
                
                <br/>  <br/> <br/>       
               <?php
                  if(isset($_SESSION['update']))
                  {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                  }
               ?>
               

                 <table class="tblfull"  >

                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer_name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>


                    <?php
                        //gets all order from database
                        $sql = "SELECT * FROM tbl_order ORDER BY  id DESC";

                        //execute query
                        $res = mysqli_query($conn,$sql);
                        //count the rows
                        $count = mysqli_num_rows($res);
                        $sn=1;

                        if($count>0)
                        {
                             //orders are there
                             while($row=mysqli_fetch_assoc($res))
                             {
                                //get all order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price=$row['price'];
                                $qty=$row['qty'];
                                $total=$row['total'];
                                $order_date=$row['order_date'];
                                $status=$row['status'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];
                                $customer_address=$row['customer_address'];
                                $username = $row['username'];

                                ?>
                                <tr>
                                   <td><?php echo $sn++;  ?></td>
                                   <td><?php echo $food;  ?></td>
                                   <td><?php echo $price;  ?></td>
                                   <td><?php echo $qty;  ?></td>
                                   <td><?php echo $total;  ?></td>
                                   <td><?php echo $order_date;  ?></td>

                                   <td>
                                   <?php 
                                    //Ordered , On Delivery , Delivered , Cancelled 
                                       if($status=="Ordered")
                                       {
                                        echo "<label>$status</label>";
                                       }
                                       else if($status=="On Delivery")
                                       {
                                        echo "<label style='color: orange;'>$status</label>";
                                       }
                                       else if($status=="Delivered")
                                       {
                                        echo "<label style='color: green;'>$status</label>";
                                       }
                                       else if($status=="Cancelled")
                                       {
                                        echo "<label style='color: red;'>$status</label>";
                                       }
                                   ?>
                                   </td>

                                    <td><?php echo $customer_name;  ?></td>
                                    <td><?php echo $customer_contact;  ?></td>
                                   <td><?php echo $customer_email;  ?></td>
                                   <td><?php echo $customer_address;  ?></td>
                                   <td><?php echo $username;  ?></td>
                       
                                   <td>
                                     <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">  Update Order </a>
                             
                                   </td>
                                 </tr>


                                <?php
                             }
                        }
                        else
                        {
                            //order is not available
                            echo "<tr><td colspan='12' class='error'>Orders not Available. </td></tr>";
                        }
                    ?>

                    
                    

                   
                 </table>
                
                 
                 <div class="clearfix"></div>
             </div>
            </div>
    <!-- main section ends  --> 
<?php include('partials/footer.php'); ?>