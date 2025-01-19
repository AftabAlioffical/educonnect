<?php
session_start();
// Include database connection
require_once "admin/config1.php";
// $_SESSION['user_id'];

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $question_id = intval($_GET['id']); // Sanitize input to prevent SQL injection

    // Fetch question details
    $sql = "SELECT * FROM user_questions WHERE question_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $question_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $name = $row['user_name'];
            $question = $row['question'];
            $questioncategory = $row['question_category'];
            $_SESSION['question_id'] = $question_id;
        } else {
            echo "<p>Question not found.</p>";
        }
    } else {
        echo "Error: Could not execute query.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
} else {
    echo "<p>Invalid question ID.</p>";
}

?>
<!doctype html>
<html lang="en">

<head>

    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Edubin - LMS Education HTML Template</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="images/favicon.png" type="image/png">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="css/slick.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="css/animate.css">

    <!--====== Nice Select css ======-->
    <link rel="stylesheet" href="css/nice-select.css">

    <!--====== Nice Number css ======-->
    <link rel="stylesheet" href="css/jquery.nice-number.min.css">

    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="css/style.css">

    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="css/responsive.css">
    <script src="https://cdn.tiny.cloud/1/1nwl0zfcjfhhvqc7azxatwiuo5j37zmxh2w37m4y8suzwix0/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .user_img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }
    </style>
    <!-- NAVBAR SCRIPT -->


</head>

<body>
    <?php require_once "navbar.php";  ?>

    <!--====== Query PART START ======-->

    <section id="query-singel" class="pt-90 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-10">
                    <div class="query-singel mt-30">
                        <div class="title">
                            <h3><?php echo $question; ?></h3>
                        </div>
                        <!-- title -->
                        <div class="query-terms">
                            <ul>
                                <li>
                                    <div class="student-name">
                                        <div class="thum">
                                            <img class="user_img" src="images/all-icon/man-user-circle-icon.png" alt="User">
                                        </div>
                                        <div class="name">
                                            <span>User</span>
                                            <h6><?php echo $name; ?></h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="course-category">
                                        <span>Category</span>
                                        <h6><?php echo $questioncategory; ?> </h6>
                                    </div>
                                </li>
                                <li>
                               <?php $question_id = intval($_GET['id']); // Ensure it's an integer
                                    $sql = "SELECT COUNT(*) AS count FROM user_answers WHERE question_id = $question_id";
                                    if ($result = mysqli_query($link, $sql)) {
                                        if ($row = mysqli_fetch_array($result)) {
                                            $count = $row['count']; // Store the count in the variable
                                        }
                                    } else {
                                        echo "Error: " . mysqli_error($link);
                                    }?>
                                    <div class="review">
                                        <span>Answers</span>
                                        <ul>
                                            <li class="rating">(<?php echo $count;?>)</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- course terms -->
                        <div class="query-tab mt-30">
                            <ul class="nav nav-justified" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a id="reviews-tab" data-toggle="tab" href="#" role="tab" aria-controls="reviews" aria-selected="false">Answers</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="reviews-cont">
                                    <div class="title">
                                        <h6>Students Answer</h6>
                                    </div>
                                    <?php


                                    // Check if question_id is provided in the URL
                                    if (!isset($_GET['id'])) {
                                        echo "Invalid question ID.";
                                        exit;
                                    }

                                    
                                    // Fetch answers from the database
                                    $sql = "SELECT user_name, asked_on, answer FROM user_answers WHERE question_id = ?";
                                    if ($stmt = mysqli_prepare($link, $sql)) {
                                        // Bind the question_id to the query
                                        mysqli_stmt_bind_param($stmt, "i", $question_id);

                                        // Execute the query
                                        mysqli_stmt_execute($stmt);

                                        // Bind the result variables
                                        mysqli_stmt_bind_result($stmt, $user_name, $asked_on, $answer);

                                        // Fetch results and display them in the list
                                        echo '<ul>';
                                        while (mysqli_stmt_fetch($stmt)) {
                                    ?>
                                            <li>
                                                <div class="singel-reviews">
                                                    <div class="reviews-author">
                                                        <div class="author-thum">
                                                            <img class="user_img" src="images/all-icon/man-user-circle-icon.png" alt="Reviews">
                                                        </div>
                                                        <div class="author-name">
                                                            <h6><?php echo htmlspecialchars($user_name); ?></h6>
                                                            <span><?php echo htmlspecialchars($asked_on); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="reviews-description pt-20">
                                                        <p><?php echo htmlspecialchars($answer); ?></p>
                                                    </div>
                                                </div>
                                                <!-- singel reviews -->
                                            </li>
                                    <?php
                                        }
                                        echo '</ul>';

                                        // Close the statement
                                        mysqli_stmt_close($stmt);
                                    } else {
                                        echo "Error: Could not prepare the query.";
                                    }

                                    // Close the database connection
                                    mysqli_close($link);
                                    ?>
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <div class="title pt-15">
                                            <h6>Leave Answer</h6>

                                        </div>
                                        <div class="reviews-form">
                                            <form action="insertanswer.php" method="post">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <textarea name="answer" placeholder="Write your answer here..." required></textarea>


                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <button type="submit" class="main-btn">Post Answer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <p>You need to <a href="login.php">log in</a> to leave an answer.</p>
                                    <?php endif; ?>
                                </div>
                                <!-- reviews cont -->

                            </div>
                            <!-- tab content -->
                        </div>
                    </div>
                    <!-- corses singel left -->

                </div>

            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="releted-courses pt-95">
                        <div class="title">
                            <h3>Releted Queries</h3>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="single-query">
                                    <div class="user-query">
                                        <div class="thum">
                                            <a href="#"><img src="images/all-icon/man-user-circle-icon.png" alt="teacher"></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h6>Haroon</h6>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="cont">
                                        <a href="query.html">
                                            <h4>What career opportunities are available after completing a CS degree?</h4>
                                        </a>
                                    </div>
                                    <div class="ans"><span>(2 Answers)</span></div>

                                </div>
                                <!-- singel course -->
                            </div>
                            <div class="col-md-6">
                                <div class="single-query">
                                    <div class="user-query">
                                        <div class="thum">
                                            <a href="#"><img src="images/all-icon/man-user-circle-icon.png" alt="teacher"></a>
                                        </div>
                                        <div class="name">
                                            <a href="#">
                                                <h6>Haroon</h6>
                                            </a>
                                        </div>

                                    </div>
                                    <div class="cont">
                                        <a href="query.html">
                                            <h4>Does the CS degree program offer internship opportunities?</h4>
                                        </a>
                                    </div>
                                    <div class="ans"><span>(2 Answers)</span></div>
                                </div>
                                <!-- singel course -->
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                    <!-- releted courses -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>

    <!--====== COURSES SINGEl PART ENDS ======-->
    <?php require_once "footer.html";  ?>
    <!--====== BACK TO TP PART START ======-->

    <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

    <!--====== BACK TO TP PART ENDS ======-->


    <script>
        tinymce.init({
            selector: '',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Dec 25, 2024:
                'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
        });
    </script>





    <!--====== jquery js ======-->
    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="js/bootstrap.min.js"></script>

    <!--====== Slick js ======-->
    <script src="js/slick.min.js"></script>

    <!--====== Magnific Popup js ======-->
    <script src="js/jquery.magnific-popup.min.js"></script>

    <!--====== Counter Up js ======-->
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>

    <!--====== Nice Select js ======-->
    <script src="js/jquery.nice-select.min.js"></script>

    <!--====== Nice Number js ======-->
    <script src="js/jquery.nice-number.min.js"></script>

    <!--====== Count Down js ======-->
    <script src="js/jquery.countdown.min.js"></script>

    <!--====== Validator js ======-->
    <script src="js/validator.min.js"></script>

    <!--====== Ajax Contact js ======-->
    <script src="js/ajax-contact.js"></script>

    <!--====== Main js ======-->
    <script src="js/main.js"></script>

</body>

</html>