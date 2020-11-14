<?php
include_once 'config.php';
if(isset($_POST['save']))
{
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $age=$_POST['age'];
        $email=$_POST['email'];
        $dob=$_POST['dob'];
        $MonIn=$_POST['MonIn'];
        $LoanAmt=$_POST['LoanAmt'];
        $purpose=$_POST['purpose'];
        $tenure=$_POST['tenure'];
        $status="Pending";
        $sql ="INSERT INTO loan_form (fname,lname,age,email,dob,MonIn,LoanAmt,purpose,tenure,status)
            VALUES ('$fname','$lname','$age','$email','$dob','$MonIn','$LoanAmt','$purpose','$tenure','$status')";
        if(mysqli_query($link, $sql)){
            header("location: formapplied.php");
        } else {
            echo "Error:" .$sql . "" . mysqli_error($link);
        }
        mysqli_close($link);
}
?>
