<?php

session_start();


// Include config fileF
require_once "admin/config1.php";

// Define variables and initialize with empty values
$name = $email = $password = $re_password = "";
$name_err = $email_err = $password_err = $re_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["name"]))) {
        $name_err = "name can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM user WHERE name = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_name);

            // Set parameters
            $param_name = trim($_POST["name"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $name_err = "This name is already taken.";
                } else {
                    $name = trim($_POST["name"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter a email.";
    } else {
        // Prepare a select statement
        $sql = "SELECT user_id FROM user WHERE email = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already exist.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["re_password"]))) {
        $re_password_err = "Please confirm password.";
    } else {
        $re_password = trim($_POST["re_password"]);
        if (empty($password_err) && ($password != $re_password)) {
            $re_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting in database
    if (empty($email_err) && empty($password_err) && empty($re_password_err)) {
        $user_activation_code = rand();
        $email_status = "not verified";


        // Prepare an insert statement
        $sql = "INSERT INTO user (name,email, password) VALUES (?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_email, $param_password);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            //     $param_email_status=$email_status;
            //     $to = $email;
            //  $subject = "Verification code for Verify Your Email Address";

            //  $_SESSION["OTP"]=rand(100000,999999);
            //  $otp=$_SESSION["OTP"];
            //  $message = "<p>For verify your email address, enter this verification code when prompted: <b>''</b>.</p>";
            //  $message .= "<h1><p>$otp</p>
            //  <p>ListonU</p>";

            //  $header = "From:AccountVerification@listonu.com \r\n";
            //  //$header .= "Cc:listonuu@gmail.com \r\n";
            //  $header .= "MIME-Version: 1.0\r\n";
            //  $header .= "Content-type: text/html\r\n";

            //  $retval = mail ($to,$subject,$message,$header);

            if ($retval == true) {

                //  echo "Message sent successfully...";

            } else {
                echo "Message could not be sent...";
            }
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: login.php");
                // echo "Message sent...";
            } else {
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
        .form-group span{
            padding-top: 10px;
            font-weight:bolder;
            font-size: 80%; 
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

        .main-btn.register-submit {
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
                    <form method="POST" id="signup-form" class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <h2 class="form-title pb-20">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name" />
                            <span><?php echo $name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" />
                            <span style="font-size: 80%; color: #dc3545;"><?php echo $email_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="password" id="password" placeholder="Password" />
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                            <span ><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password" />
                            <span style="font-size: 80%; color: #dc3545;"><?php echo $re_password_err; ?></span>
                        </div>
                        <!-- <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div> -->
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="main-btn register-submit" value="Sign up" />
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
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