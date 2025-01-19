<?php
session_start();
require_once "admin/config1.php";

$msg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $phone = $_POST['phone'];
    $message = $_POST['messege'];

    // Get the current datetime for contact_time
    $contact_time = date("Y-m-d H:i:s");

    // SQL query to insert data into the messages table
    $sql = "INSERT INTO messages (user_name, email, subject, phone, message, contact_time) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $subject, $phone, $message, $contact_time);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            $msg = 'Your message has been sent successfully!';
            header("Location: " . $_SERVER['PHP_SELF']); // Redirect to refresh and show message
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare the query.";
    }

    // Close the connection
    mysqli_close($link);
}

// Check if a message exists in the session and set it to display
// if (isset($_SESSION['msg'])) {
//     $msg = $_SESSION['msg'];// Clear the session message after displaying
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduConnect</title>

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
    
</head>

<body>
<?php require_once "navbar.php";  ?>
    <!--====== CONTACT PART START ======-->

    <section id="contact-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-from">
                        <div class="section-title">
                            <h5>Contact Us</h5>
                            <h2>Keep in touch</h2>
                        </div>
                        <!-- section title -->
                        <div class="main-form pt-45">
                            <form id="contact-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" data-toggle="validator">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="name" type="text" placeholder="Your name" data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="email" type="email" placeholder="Email" data-error="Valid email is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="subject" type="text" placeholder="Subject" data-error="Subject is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <!-- singel form -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="singel-form form-group">
                                            <input name="phone" type="text" placeholder="Phone" data-error="Phone is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <!-- singel form -->
                                    </div>
                                    <div class="col-md-12">
                                        <div class="singel-form form-group">
                                            <textarea name="messege" placeholder="Messege" data-error="Please,leave us a message." required="required"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <!-- singel form -->
                                         
                                         <h3><?php echo $msg; ?></h3>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="singel-form">
                                            <button type="submit" class="main-btn">Send</button>
                                        </div>
                                        <!-- singel form -->
                                    </div>
                                </div>
                                <!-- row -->
                            </form>
                        </div>
                        <!-- main form -->
                    </div>
                    <!--  contact from -->
                </div>
                <div class="col-lg-4">
                    <div class="contact-address">
                        <div class="contact-heading">
                            <h5>Address</h5>
                            <p>If you have any further questions, please don’t hesitate to contact me.</p>
                        </div>
                        <ul>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="cont">
                                        <p>Rawalpindi,Punjab ,Pakistan</p>
                                    </div>
                                </div>
                                <!-- singel address -->
                            </li>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="cont">
                                        <p>+923190929222</p>
                                        <p>+923237643278</p>
                                    </div>
                                </div>
                                <!-- singel address -->
                            </li>
                            <li>
                                <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="cont">
                                        <p>info@educonnect.com</p>

                                    </div>
                                </div>
                                <!-- singel address -->
                            </li>
                            <li>
                                <!-- <div class="singel-address">
                                    <div class="icon">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="cont">
                                        <p>www.yoursite.com</p>
                                        <p>www.example.com</p>
                                    </div>
                                </div> -->
                                <!-- singel address -->
                            </li>
                        </ul>
                    </div>
                    <!-- contact address -->

                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->

    </section>
    <!--====== CONTACT PART ENDS ======-->
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