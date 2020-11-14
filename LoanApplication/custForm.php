<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page


include 'config.php';
$email=$_REQUEST['email'];

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
$email=$row['email'];
$id =$row['id'];
}
 $_SESSION["id"] = $id;   

?> 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Application</title>
   
    <link rel="stylesheet" href="style.css"/>
     
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1> <b><?PHP echo $fname ?> <?PHP echo $lname ?>'s</b> Loan Application. </h1>
    </div>
    <hr>
     <p>
         
          <input type="reset"
                    class="btn btn-primary" style=" background-color: orange; 
                    width: 150px; cursor: pointer;" value="Back" onclick="window.location.href='adminApproval.php'">
        
    </p>
    
    <section class="bo" style="height: 450px;">
    <div class="form">
        
        <form method="post" action="process2.php" style="width: 900px; height: 450px">
            <h1 style="color: rgb(236, 12, 117);">Application Form</h1>
            <br>
       
        <input type="text" name="fname" placeholder="Enter First name" value="<?PHP echo $fname; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
  
  
  <input type="text" name="lname" placeholder="Enter Last name" value="<?PHP echo $lname; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
  <br><br>
 
  <input type="text" name="email" value="<?php echo $email ?>" disabled > 
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
 
  <input type="text" name="MonIn" placeholder="Enter Monthly Income" value="Monthly Income: INR <?PHP echo $MonIn; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
 
 &nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;
  <input type="text" name="LoanAmt" placeholder="Enter Loan Amount" value="Loan Amount: INR <?PHP echo $LoanAmt; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
  
   <br><br>
   
   <input type="text" name="purpose" placeholder="Enter Loan Amount" value="<?PHP echo $purpose; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
   

&nbsp; &nbsp; &nbsp; &nbsp;
      &nbsp; &nbsp; &nbsp; &nbsp;

 <input type="text" name="tenure" placeholder="Enter Loan Amount" value="Tenure of <?PHP echo $tenure; ?>" 
            <?PHP if($flag=="Yes"){?>disabled <?PHP }?>required> 
 <br><br><br>
      
     
   <div style="text-align: center;"> <input type="submit" class="btn btn-primary" style="background-color: red" value="Reject" 
                                       name="reject" > 
                                &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; 
                                <input type="submit" class="btn btn-primary" style="background-color: greenyellow" value="Approve"
                                       name="approve">
   </div>
     
    </form>
   </div>
</section>   
</body>
</html>