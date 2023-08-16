<?php 
//include constant file here

include('../config/constants.php');

//1get id of admin to be deleted
  $id = $_GET['id'];

//2create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute query

$res = mysqli_query($conn,  $sql);

if($res==TRUE)
{
    //crate session to display message 
    $_SESSION['delete'] = "<div class='success'> Admin Deleted Succcessfully.</div>";
    //redirect to add admin page

    header("location:".SITEURL.'admin/manage-admin.php');

}
else
{
    $_SESSION['delete'] = "<div class='error'>failed to Delete Admin. </div> ";
    header('location:'.SITEURL.'admin/manage-admin.php');
}


//3redirect to manage admin page with messagw 



?>