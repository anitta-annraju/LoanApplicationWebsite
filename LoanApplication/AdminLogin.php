<?php
// Initialize the session
session_start();
 
//checking if user is already logged in


require_once "config.php";
 
// Define variables and initialize with empty values
$email = $mypassword = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //email empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email id.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    //  password empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $mypassword = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM admin WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $password);
                    if(mysqli_stmt_fetch($stmt)){
                        if($mypassword==$password){
                            // Password is correct, so start a new session
                            session_start();
                            //remember to do the same in admin module
                            // Store data in session variables
                                                  
                            
                            // Redirect user to welcome page
                            header("location: adminApproval.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Incorrect password!";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "This Email is not valid!"
                            . ".";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style1.css">
      
   
</head>
<body>
      <section class="login">
    <div class="wrapper">
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
               
                <input type="email" name="email" class="form-control"
                       placeholder="Enter email" value="<?php echo $email; ?>">
                <span class="help-block" style="color: red"><br><?php echo $email_err; ?></span>
            </div>  <br>  
            <div class="form-group  <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
               
                <input type="password" name="password" placeholder="Enter password" class="form-control">
                <span class="help-block" style="color: red"><br><?php echo $password_err; ?></span>
            </div>
            <div class="group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            
        </form>
    </div>  
      </section>
</body>
</html>
