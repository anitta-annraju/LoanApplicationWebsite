<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include 'config.php';
$email=($_SESSION["email"]);

$flag="No";

$query ="SELECT * FROM loan_form where email='$email'";
$Supportquery = $link->query($query);
$cnt = mysqli_num_rows($Supportquery);
$fname="";
$lname ="";
$age ="";
$status ="";
$MonIn ="";
$LoanAmt ="";
$purpose ="";
$tenure ="";
$dob ="";

if($cnt>0){
    $flag="Yes";
}
$qryForm = $link->query($query);
while($row = mysqli_fetch_array($qryForm)){
    $fname=$row['fname'];
$lname =$row['lname'];
$age =$row['age'];
$status = $row['status'];
$MonIn =$row['MonIn'];
$LoanAmt =$row['LoanAmt'];
$purpose =$row['purpose'];
$tenure =$row['tenure'];
$dob =$row['dob'];
}



$statMsg="Please, fill the form given below.";
if($status == "Pending"){
    $statMsg ="Your Loan Application is pending.";
} else if($status == "Accepted"){ 
    $statMsg="Your Loan Application is accepted.";
} else if($status == "Rejected"){
    $statMsg ="Your Loan Application is rejected.";
} else{ 
    $statMsg="Please, fill the form given below.";
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Page</title>
   
    <link rel="stylesheet" href="style.css"/>
     
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1> <?PHP echo $statMsg; ?> </h1>
    </div>
    <hr>
     <p>
        <a href="repwd.php" class="btn btn-warning">Reset Your Password</a> &nbsp; &nbsp; &nbsp; &nbsp; 
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    
    <section class="bo" style="height: 450px;">
    <div class="form">
        
        <form method="post" action="process.php" style="width: 900px;
    height: 450px;  <?PHP if($flag=="Yes"){?>height: 400px <?PHP }?>">
            <h1 style="color: rgb(236, 12, 117);">Application Form</h1>
            <br>
       
        <input type="text" name="fname" placeholder="Enter First name" value="<?PHP echo $fname; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
  
  
  <input type="text" name="lname" placeholder="Enter Last name" value="<?PHP echo $lname; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
  <br><br>
 
  <input type="text" name="email" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>" disabled > 
 &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
  
 
      <input type="number" name="age" placeholder="Enter Age" style="width: 100px" value="<?PHP echo $age; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required>  &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;DOB:&nbsp; &nbsp;
  
 
      <input type="date" name="dob" style="width: 150px; height: 15.333px;"value="<?PHP echo $dob; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
 &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
      <br>
       <?PHP if($flag=="No"){  ?>
 
        <input type="number" name="MonIn"  placeholder="Enter Monthly Income"  
         required> 
        &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
  <input type="number" name="LoanAmt" placeholder="Enter Loan Amount" 
            required> 
       <?PHP } else { ?>
   <input type="Text" name="MonIn" value=" Monthly Income: INR <?PHP echo $MonIn; ?>" 
          disabled> 
     &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
     <input type="Text" name="LoanAmt"  value=" Loan Amount: INR <?PHP echo $LoanAmt; ?>" 
          disabled> 
       <?PHP } ?>
 
  
   <br><br>
   <div class="t" style="color: rgb(236, 12, 117);">
  <select id="purpose" name="purpose" style="width: 400px; height: 40px;" 
 <?PHP if($flag=="Yes"){?>disabled <?PHP }?> required>
      <option value="" disabled="disabled" selected="selected">Choose a purpose</option>
    <option value="Personal Loan" <?PHP if($purpose=="Personal Loan")
    {echo "selected";}?>>Personal Loan</option>
    <option value="Car Loan" <?PHP if( $purpose=="Car Loan")
    {echo "selected";}?>>Car Loan</option>
    <option value="Housing Loan" <?PHP if($purpose=="Housing Loan")
    {echo "selected";}?>>Housing Loan</option>
  </select>

&nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;

 
      Tenure:
 <input  type="radio" name="tenure" value="6 months" <?PHP if($tenure == "" || $tenure=="6 months")
    {echo "checked";}?> <?PHP if($flag=="Yes"){?>disabled <?PHP }?>  >6 months 
 
  <input  type="radio" name="tenure" value="12 months" <?PHP if($tenure=="12 months")
    {echo "checked";}?> <?PHP if($flag=="Yes"){?>disabled <?PHP }?>>12 months 

  <input  type="radio" name="tenure" value="24 months" <?PHP if($tenure=="24 months")
    {echo "checked";}?> <?PHP if($flag=="Yes"){?>disabled <?PHP }?>>24 months 

  <input  type="radio" name="tenure" value="32 months" <?PHP if($tenure=="32 months")
    {echo "checked";}?> <?PHP if($flag=="Yes"){?>disabled <?PHP }?>>32 months 
  <br> <br>
  </div>
      
     
       <div class="group">
            <?PHP if($flag=="No"){?>
      <input type="submit" style="margin-left: 400px;"
             class="btn btn-primary" name="save" value="Submit" >
       <?PHP }?>
       </div>
     
    </form>
   </div>
</section>   
</body>
</html>