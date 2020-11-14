<?php
include_once 'config.php';

    session_start();
    
$id= $_SESSION["id"];   

$flag="No";

$query ="SELECT * FROM loan_form where id='$id'";
$Supportquery = $link->query($query);
$cnt = mysqli_num_rows($Supportquery);
if(isset($_POST['reject']))
{
$status ="Rejected";
}

if(isset($_POST['approve']))
{
$status ="Accepted";
}

$sql ="UPDATE `loan_form` SET `status` = '$status' WHERE id = '$id'";
           
       if(mysqli_query($link, $sql)){
            header("location: adminstat.php");
        } else {
            echo "Error:" .$sql . "" . mysqli_error($link);
        }
        mysqli_close($link);
?>

