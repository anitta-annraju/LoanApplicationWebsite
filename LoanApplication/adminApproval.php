

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
   
    <link rel="stylesheet" href="style.css"/>
     
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>

<?PHP 

 include('config.php');
 session_start();
 
$query ="SELECT * FROM loan_form where status='Pending'";
 $qryForm = $link->query($query);

    



$Supportquery = $link->query($query);
$cnt = mysqli_num_rows($Supportquery);
 ?> 
<body>
    
    <h1>Hello, Admin!</h1><hr><p> <input type="reset"
                    class="btn btn-primary" style=" background-color: orange; 
                    width: 150px" value="Logout" onclick="window.location.href='AdminLogin.php'"></p>
    
    <?PHP 
    if($cnt>0){
        ?>
            <table id="customers" style="width:100%;">
                <tr style="background-color: #32e080; height: 30px">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Loan Amount</th>
                    <th>Purpose</th>
                    
                </tr>
                <?PHP 
                    $qryForm = $link->query($query);
                    while($row = mysqli_fetch_array($qryForm)){
                               
                             $id=$row['id'];
                             $email=$row['email'];
                             
                        ?>  
                
                <tr onclick="window.location.href='custForm.php?id=<?PHP echo $row['id']; ?>&email=<?PHP echo $row['email']?>'"
                 
                    style="cursor:
                    pointer; background-color:#c7d1d1; text-align: center; height: 60px;">
                         
                          <td><?PHP echo $row['fname']; ?> <?PHP echo $row['lname']; ?></td>
                           <td><?PHP echo $row['email']; ?></td>
                           <td>INR <?PHP echo $row['LoanAmt']; ?></td>
                            <td><?PHP echo $row['purpose']; ?></td>
                           
                            
                     </tr>
                       
                    <?PHP } ?>
            </table>
    <?PHP }else { ?>
    
    <table style="width:100%;" >
        <tr>
            <th align="center">
                <br><br><br><br><hr><br>
                <b>NO RECORDS TO SHOW</b><br><br><hr></th>
                                          
        </tr>
    </table>
    <?PHP } ?>
</body>
</html>