<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "admin/config1.php";


// Define variables and initialize with empty values
$user_id = $name = $category_name = $asked_on = $question = "";
$user_id_err = $name_err = $category_name_err = $asked_on_err = $question_err =   "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Attempt select query execution
    $user_id=$_SESSION["user_id"];
    $sql = "SELECT user_id,name  FROM user where user_id=$user_id";
    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $name=$row['name'];
            }
            // Free result set
            mysqli_free_result($result);
        } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    // Validate category_name
    $input_category_name = trim($_POST["category_name"]);
    if (empty($input_category_name)) {
        $category_name_err = "Category name is not selected.";
    } else {
        $category_name = $input_category_name;
    }

    $input_question = trim($_POST["question"]);
    if (empty($input_question)) {
        $question_err = "Please enter a question.";
    } else {
        $question = $input_question;
    }
    // Check input errors before inserting in database
    // echo $semester_id_err;
    if (empty($category_name_err) && empty($question_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO user_questions(user_id,user_name,question_category,asked_on,question) VALUES ('$user_id','$name' ,'$category_name' , CURRENT_DATE, '$question')";

        if (mysqli_query($link, $sql)) {

            $id = mysqli_insert_id($link);


            // Records created successfully. Redirect to landing page
            header("location: profile.php");
            exit();
        }
    }

    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ask Question-User</title>
    <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="admin/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="admin/assets/bootstrap/css/style.css">
    <script src="https://cdn.tiny.cloud/1/1nwl0zfcjfhhvqc7azxatwiuo5j37zmxh2w37m4y8suzwix0/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<style>
    .main-btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid #ffc600 !important;
            padding: 0 35px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            line-height: 50px;
            border-radius: 5px;
            color: #07294d !important;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            z-index: 5;
            -webkit-transition: 0.4s ease-in-out;
            transition: 0.4s ease-in-out;
            background-color: #ffc600 !important;
        }
</style>
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>User</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="askquestion.php"><i class="fas fa-plus"></i><span>Add Questions</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="user-info.php"><i class="fas fa-plus"></i><span>Add User-info</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group"><a href="index.php"><button class="main-btn btn btn-primary py-0" type="button">Home</button></a></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Admin</span><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Ask New Question</h3>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6 col-xl-3 mb-4">
                                <div class="form-group">
                                    <label for="category_name">question_category	</label>
                                    <select name="category_name" id="category_name" class="form-control">

                                        <?php
                                        // Include config file
                                        require_once "admin/config1.php";

                                        // Attempt select query execution
                                        $sql = "SELECT * FROM questions_category";
                                        if ($result = mysqli_query($link, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $category_name = $row['category_name'];
                                                    echo "<option value='" . $row['category_name'] . "'>" . $row['category_name'] . "</option>";
                                                }
                                                // Free result set
                                                mysqli_free_result($result);
                                            } else {
                                                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                            }
                                        } else {
                                            echo "Oops! Something went wrong. Please try again later.";
                                        }

                                        ?>
                                    </select>
                                    <span class="invalid-feedback"><?php echo $category_name_err; ?></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="question">question</label>
                                        <br>
                                        <textarea name="question" id="question" rows="6" style="width:100%;"></textarea>
                                        <span class="invalid-feedback"><?php echo $question_err; ?></span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <input type="submit" value="Add Data" name="user_question" class="main-btn btn btn-success">
                                <input type="reset" value="Reset" class="main-btn btn btn-danger mx-3">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © 2024-&nbsp; EduConnect</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
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
    <script src="admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/theme.js"></script>

</body>

</html>