<?php
session_start();
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
    <!-- SEARCH BOX PART START -->

    <div class="search-box">
        <div class="serach-form">
            <div class="closebtn">
                <span></span>
                <span></span>
            </div>
            <form action="#">
                <input type="text" placeholder="Search by keyword">
                <button><i class="fa fa-search"></i></button>
            </form>
        </div>
        <!-- serach form -->
    </div>

    <!-- SEARCH BOX PART ENDS -->

    <!-- SLIDER PART START -->

    <section id="slider-part" class="slider-active">
        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s1.jpg)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">Revolutionize Your Learning Experience</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s">Join EduConnect to enhance your academic journey with collaborative tools, access to study materials, and real-time communication with peers.</p>
                            <ul>
                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="signup.php">Join Now</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- single slider -->

        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s2.jpg)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">Join a Community of Learners and Achievers</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s">EduConnect brings together students from all backgrounds to collaborate, share resources, and excel academically. Experience the future of learning today!</p>
                            <ul>

                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="#">Get Started</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- single slider -->

        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s3.jpg)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">Meet Your Ideal Study Partners</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s">Discover peers who match your study interests and collaborate in real-time to achieve your academic goals. Together, we are stronger.</p>
                            <ul>
                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="#">Find Partners</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- single slider -->
    </section>

    <!-- SLIDER PART ENDS -->

    <!-- CATEGORY PART START -->

    <section id="category-part">
        <div class="container">
            <div class="category pt-40 pb-80">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="category-text pt-40">
                            <h2>Best platform to learn everything</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1 col-md-8 offset-md-2 col-sm-8 offset-sm-2 col-8 offset-2">
                        <div class="row category-slied mt-40">
                            <div class="col-lg-4">
                                <a href="#">
                                    <span class="singel-category text-center color-1">
                                        <span class="icon">
                                            <img src="images/all-icon/ctg-1.png" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>Language</span>
                                        </span>
                                    </span>
                                    <!-- singel category -->
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#">
                                    <span class="singel-category text-center color-2">
                                        <span class="icon">
                                            <img src="images/all-icon/ctg-2.png" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>Business</span>
                                        </span>
                                    </span>
                                    <!-- singel category -->
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#">
                                    <span class="singel-category text-center color-3">
                                        <span class="icon">
                                            <img src="images/all-icon/ctg-3.png" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>Literature</span>
                                        </span>
                                    </span>
                                    <!-- singel category -->
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#">
                                    <span class="singel-category text-center color-1">
                                        <span class="icon">
                                            <img src="images/all-icon/ctg-1.png" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>Language</span>
                                        </span>
                                    </span>
                                    <!-- singel category -->
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#">
                                    <span class="singel-category text-center color-2">
                                        <span class="icon">
                                            <img src="images/all-icon/ctg-2.png" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>Business</span>
                                        </span>
                                    </span>
                                    <!-- singel category -->
                                </a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#">
                                    <span class="singel-category text-center color-3">
                                        <span class="icon">
                                            <img src="images/all-icon/ctg-3.png" alt="Icon">
                                        </span>
                                        <span class="cont">
                                            <span>Literature</span>
                                        </span>
                                    </span>
                                    <!-- singel category -->
                                </a>
                            </div>
                        </div>
                        <!-- category slied -->
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- category -->
        </div>
        <!-- container -->
    </section>

    <!-- CATEGORY PART ENDS -->
    <!-- ABOUT PART START -->

    <section id="about-part" class="pt-65">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>About us</h5>
                        <h2>Welcome to EduConnect </h2>
                    </div>
                    <!-- section title -->
                    <div class="about-cont">
                        <p>At EduConnect, our mission is to empower students by providing a collaborative platform that enhances their learning experience. We believe that by connecting students with the right resources and study partners, we can help them
                            achieve their academic goals and succeed in their educational journey. <br> <br> We envision a world where students have seamless access to the resources they need and the ability to collaborate effectively with peers, regardless
                            of their location. EduConnect aims to revolutionize the way students learn by fostering a community of shared knowledge and mutual support.</p>
                        <a href="#" class="main-btn mt-55">Learn More</a>
                    </div>
                </div>
                <!-- about cont -->
                <div class="col-lg-6 offset-lg-1">
                    <div class="about-event mt-50">
                        <div class="event-title">
                            <h3>Upcoming events</h3>
                        </div>
                        <!-- event title -->
                        <ul>
                            <li>
                                <div class="singel-event">
                                    <span><i class="fa fa-calendar"></i> 2 December 2024</span>
                                    <a href="events-singel.html">
                                        <h4>JavaScript Workshop</h4>
                                    </a>
                                    <span><i class="fa fa-clock-o"></i> 10:00 Am - 3:00 Pm</span>
                                    <span><i class="fa fa-map-marker"></i> Rc Auditorim</span>
                                </div>
                            </li>
                            <li>
                                <div class="singel-event">
                                    <span><i class="fa fa-calendar"></i> 2 December 2024</span>
                                    <a href="events-singel.html">
                                        <h4>Tech Summit</h4>
                                    </a>
                                    <span><i class="fa fa-clock-o"></i> 10:00 Am - 3:00 Pm</span>
                                    <span><i class="fa fa-map-marker"></i> Rc Auditorim</span>
                                </div>
                            </li>
                            <li>
                                <div class="singel-event">
                                    <span><i class="fa fa-calendar"></i> 2 December 2024</span>
                                    <a href="events-singel.html">
                                        <h4>Enviroement conference</h4>
                                    </a>
                                    <span><i class="fa fa-clock-o"></i> 10:00 Am - 3:00 Pm</span>
                                    <span><i class="fa fa-map-marker"></i> Auditorim</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- about event -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
        <div class="about-bg">
            <!-- <img src="images/about/bg-1.png" alt="About"> -->
        </div>
    </section>

    <!-- ABOUT PART ENDS -->
    <!--====== COURSE PART START ======-->

    <section id="course-part" class="pt-115 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-45">
                        <a href="queries.php">
                            <h5>Queries</h5>
                        </a>
                        <h2>Featured Queries </h2>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->
            <div class="row course-slied mt-30">
                <?php
                // Include config file
                require_once "./admin/config1.php";

                // Attempt select query execution
                $sql = "SELECT question_id,user_name,question FROM user_questions LIMIT 5";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                ?>
                            <div class="col-lg-4">
                                <div class="single-query">
                                    <div class="user-query">
                                        <div class="thum">
                                            <a href="#"><img src="images/all-icon/man-user-circle-icon.png" alt="teacher"></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <?php echo "<h6>" . $row['user_name'] . "</h6>"; ?>
                                            </a>
                                        </div>
 
                                    </div>
                                    <div class="cont">
                                        <?php echo '<a href="query.php?id='. $row['question_id'] .'">';
                                           echo '<h4 id="question">' . $row['question'] . '</h4>';
                                        echo '</a>' ?>
                                    </div>
                                    <div class="ans"><span>(2 Answers)</span></div>

                                </div>
                                <!-- singel course -->
                            </div>
                <?php  }?>
                <!-- course slied -->
            </div>
            <?php
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                ?>
        </div>
            <!-- container -->
    </section>

    <!--====== COURSE PART ENDS ======-->
    <!--====== Question paper PART START ======-->

    <section id="course-part" class=" pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-45">
                        <a href="questionpapers.php">
                            <h5>Question Papers</h5>
                        </a>
                        <h3>Featured Question Paper </h3>
                    </div>
                    <!-- section title -->
                </div>
            </div>
            <!-- row -->
            <div class="row course-slied mt-30">
                <?php
                // Attempt select query execution
                $sql = "SELECT * FROM add_papers LIMIT 5";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                ?>
                            <div class="col-lg-4">

                                <div class="singel-question-paper">
                                    <div class="thum">
                                        <div class="image">
                                            <img src="./admin/img/<?php echo $row['image']; ?>" alt="question-paper">
                                        </div>
                                        <div class="paper-pic">
                                            <a href="./admin/img/<?php echo $row['image']; ?>" download="">
                                                <span><i class="fa fa-download" aria-hidden="true"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="cont">
                                        <a href="question-papers-singel.html">
                                            <?php echo '<table style="color: black;">';
                                            echo "<tr>";
                                            echo ' <td class="papers">Course Title :</td>';
                                            echo ' <td class="course-title">' . $row['course_name'] . '</td>';
                                            echo " </tr>";
                                            echo "<tr>";
                                            echo '<td class="papers">Course Code :</td>';
                                            echo ' <td class="course-code">' . $row['course_code'] . '</td>';
                                            echo " </tr>";
                                            echo "<tr>";
                                            echo ' <td style="text-align: center;" class="papers">Program :</td>';
                                            echo '<td class="course-program">' . $row['course_department'] . '</td>';
                                            echo " </tr>";

                                            echo " </table>"; ?>
                                        </a>

                                    </div>
                                </div>
                                <!-- singel question-paper -->
                            </div>
                        <?php } ?>
            </div>
    <?php // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
    ?>
    <!-- question-paper slied -->
        </div>
        <!-- container -->
    </section>

    <!--====== Question Paper PART ENDS ======-->
    <!--====== FOOTER START ======-->
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
    <script src="https://widget.cxgenie.ai/widget.js" data-aid="aab15a9b-75df-42cd-9d4e-50dbed4ccf37"
		
		 data-lang="ur"></script>

</body>

</html>