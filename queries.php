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
<style>
    #question{
        font-weight: 600;
    font-size: 24px;
    color: #000;
    padding-top: 3px;
    padding-bottom: 4px;
    }
</style>
</head>

<body>
    <?php require_once "navbar.php";  ?>


    <!--====== COURSES PART START ======-->

    <section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">

                        <!-- nav -->

                        <div class="courses-search float-right">
                            <form action="#">
                                <input type="text" placeholder="Search">
                                <button type="button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!-- courses search -->
                    </div>
                    <!-- courses top search -->
                </div>
            </div>
            <!-- row -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                    <div class="row">
                        <?php
                        // Include config file
                        require_once "./admin/config1.php";

                        // Attempt select query execution
                        $sql = "SELECT question_id,user_name,question FROM user_questions";
                        if ($result = mysqli_query($link, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                        ?>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="single-query mt-30">
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
                                               <?php  echo '<a href="query.php?id='. $row['question_id'] .'">';
                                                   echo '<h4 id="question">' . $row['question'] . '</h4>';
                                                   echo '</a>' ?>
                                            </div>
                                            <?php $question_id = $row['question_id']; // Ensure it's an integer
                                    $id_sql = "SELECT COUNT(*) AS count FROM user_answers WHERE question_id = $question_id";
                                    if ($id_result = mysqli_query($link, $id_sql)) {
                                        if ($id_row = mysqli_fetch_array($id_result)) {
                                            $count = $id_row['count']; // Store the count in the variable
                                        }
                                    } else {
                                        echo "Error: " . mysqli_error($link);
                                    }?>
                                            <div class="ans"><span>(<?php echo $count; echo "Answers";?>)</span></div>
                                        </div>
                                        <!-- singel course -->
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
            <!-- row -->
                </div>

            </div>
            <!-- tab content -->
            <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="active" href="#">1</a></li>
                            <li class="page-item"><a href="#">2</a></li>
                            <li class="page-item"><a href="#">3</a></li>
                            <li class="page-item">
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- courses pagination -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>

    <!--====== COURSES PART ENDS ======-->

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

</body>

</html>