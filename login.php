<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 
// Include config file
require_once "admin/config1.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id,name, email, password FROM user WHERE email = ?";
        
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
                    mysqli_stmt_bind_result($stmt, $user_id,$user_name, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["name"] = $user_name;
                            $_SESSION["user_id"] = $user_id;
                            $_SESSION["email"] = $email;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid email or password.";
                        }
                    }
                } else{
                    // email doesn't exist, display a generic error message
                    $login_err = "Invalid email or password.";
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





<!doctype html>
<html lang="en">


<!-- Mirrored from thepixelcurve.com/html/edubin/register.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 08 Oct 2021 17:05:00 GMT -->

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <!-- Slick css -->
    <link rel="stylesheet" href="css/slick.css">

    <!-- Animate css -->
    <link rel="stylesheet" href="css/animate.css">

    <!-- Nice Select css -->
    <link rel="stylesheet" href="css/nice-select.css">

    <!-- Nice Number css -->
    <link rel="stylesheet" href="css/jquery.nice-number.min.css">

    <!-- Magnific Popup css -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Fontawesome css -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Default css -->
    <link rel="stylesheet" href="css/default.css">

    <!-- Style css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    <style>
        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        
        .signup-content {
            background: #fff;
            border-radius: 10px;
            padding: 50px 55px;
            margin: 0 50px;
        }
        
        .form-group {
            overflow: hidden;
            margin-bottom: 10px;
        }
        .form-group span {
            padding-top: 10px;
            font-weight:bolder;
            font-size: 100%; 
            color: #dc3545;
        }
        .form-input {
            width: 100%;
            border: 1px solid #ebebeb;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            -o-border-radius: 5px;
            -ms-border-radius: 5px;
            padding: 15px 20px;
            box-sizing: border-box;
            font-size: 14px;
            font-weight: 500;
            color: #07294d;
        }
        
        .main-btn.register-login {
            width: 170px;
        }
        
        .label-agree-term {
            font-size: 15px;
            color: #555;
        }
        
        .term-service {
            color: #07294d;
            transition: .3s;
        }
        
        a.term-service:hover {
            color: #ffc600;
            transition: .3s;
        }
        
        .loginhere {
            color: #555;
            font-weight: 500;
            margin-top: 10px;
            margin-bottom: 5px;
        }
        
        .loginhere-link {
            font-weight: 700;
            color: #07294d;
            transition: .3s;
        }
        
        a.loginhere-link:hover {
            color: #ffc600;
            transition: .3s;
        }
        
        .field-icon {
            float: right;
            margin-right: 17px;
            margin-top: -32px;
            position: relative;
            z-index: 2;
            color: #555;
        }
        
        @media screen and (max-width: 768px) {
            .pt-105 {
                padding-top: 40px;
            }
            .signup-content {
                padding: 20px;
                margin: 1px;
            }
        }
        
        @media screen and (max-width: 480px) {
            .pt-105 {
                padding-top: 40px;
            }
            .signup-content {
                padding: 20px;
                margin: 1px;
            }
        }
    </style>
    

</head>

<body>
<?php require_once "navbar.php";  ?>
    <section class="signup pt-105 pb-120 gray-bg">
        <div class="container">
            <div class="col-md-8 offset-md-2">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h2 class="form-title pb-20">Login</h2>

                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" />
                            <span><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            <span><?php echo $password_err; ?></span>
                            <span><?php echo $login_err; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="login" id="login" class="main-btn register-login" value="Login" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Don't Have an account ? <a href="signup.php" class="loginhere-link">Create Accoont</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php require_once "footer.html";  ?>
    <!-- jquery js -->
    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>

    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Slick js -->
    <script src="js/slick.min.js"></script>

    <!-- Magnific Popup js -->
    <script src="js/jquery.magnific-popup.min.js"></script>

    <!-- Counter Up js -->
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>

    <!-- Nice Select js -->
    <script src="js/jquery.nice-select.min.js"></script>

    <!-- Nice Number js -->
    <script src="js/jquery.nice-number.min.js"></script>

    <!-- Count Down js -->
    <script src="js/jquery.countdown.min.js"></script>

    <!-- Validator js -->
    <script src="js/validator.min.js"></script>

    <!-- Ajax Contact js -->
    <script src="js/ajax-contact.js"></script>

    <!-- Main js -->
    <script src="js/main.js"></script>
</body>

</html>