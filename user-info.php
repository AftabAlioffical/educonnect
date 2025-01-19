<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
// Include config file
require_once "admin/config1.php";

// Initialize variables
$image_path = $first_name = $last_name = $department_name = $semester = $category_name = $number = $address = "";
$image_error = $form_error = "";
$user_id= $_SESSION['user_id'];
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and upload image
    $output_dir = "image/";/* Path for file upload */
    $RandomNum   = time();
    $ImageName      = str_replace(' ', '-', strtolower($_FILES['image']['name'][0]));
    $ImageType      = $_FILES['image']['type'][0];

    $ImageExt = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.', '', $ImageExt);
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
    $ret[$NewImageName] = $output_dir . $NewImageName;

    /* Try to create the directory if it does not exist */
    if (!file_exists($output_dir)) {
        @mkdir($output_dir, 0777);
    }
    move_uploaded_file($_FILES["image"]["tmp_name"][0], $output_dir . "/" . $NewImageName);


    // Collect and sanitize form data
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $department_name = trim($_POST["department_name"]);
    $semester = trim($_POST["semester"]);
    $category_name = trim($_POST["category_name"]);
    $number = trim($_POST["number"]);
    $address = trim($_POST["address"]);

    // Check for errors
    if (empty($image_error)) {
        // Insert data into the database
        $sql = "INSERT INTO user_info (user_id,first_name, last_name, image, department, semester, interest, mobile_number, address) VALUES (?,?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssss",$param_user_id, $param_first_name, $param_last_name, $param_image, $param_department, $param_semester, $param_interest, $param_number, $param_address);

            // Bind parameters
            $param_user_id=$user_id;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_image = $NewImageName;
            $param_department = $department_name;
            $param_semester = $semester;
            $param_interest = $category_name;
            $param_number = $number;
            $param_address = $address;

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='alert alert-success'>Data inserted successfully!</div>";
                header("location: profile.php");
            } else {
                echo "<div class='alert alert-danger'>Error inserting data. Please try again.</div>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<div class='alert alert-danger'>Database error. Please try again.</div>";
        }
    } else {
        $form_error = "Please correct the errors and try again.";
    }

    mysqli_close($link);
}
?>






<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>User-Info</title>
    <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="admin/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="admin/assets/bootstrap/css/style.css">
    <script src="https://cdn.tiny.cloud/1/1nwl0zfcjfhhvqc7azxatwiuo5j37zmxh2w37m4y8suzwix0/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .form-group label {
            font-size: larger;
        }

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
                    <li class="nav-item"><a class="nav-link" href="askquestion.php"><i class="fas fa-plus"></i><span>Add Questions</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="user-info.php"><i class="fas fa-plus"></i><span>Add User-info</span></a></li>
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
                        <h3 class="text-dark mb-0">Add User Info</h3>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="image">Select Image</label> <br>
                                <input type="file" id="image" name="image[]">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-5 mb-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-xl-5 mb-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  mb-4">
                                <div class="form-group">
                                    <label for="department_name">Department</label>
                                    <select name="department_name" id="department_name" class="form-control">

                                        <?php

                                        // Attempt select query execution
                                        $sql = "SELECT * FROM departments";
                                        if ($result = mysqli_query($link, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $course_department = $row['department_name'];
                                                    echo "<option value='" . $row['department_name'] . "'>" . $row['department_name'] . "</option>";
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
                                    <span class="invalid-feedback"><?php echo $course_department_err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  mb-4">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="form-control">

                                        <?php
                                        // Attempt select query execution
                                        $sql = "SELECT * FROM semesters";
                                        if ($result = mysqli_query($link, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $course_semester = $row['semester'];
                                                    echo "<option value='" . $row['semester'] . "'>" . $row['semester'] . "</option>";
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
                                    <span class="invalid-feedback"><?php echo $course_semester_err; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  mb-4">
                                <div class="form-group">
                                    <label for="category_name">Interest </label>
                                    <select name="category_name" id="category_name" class="form-control">

                                        <?php

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
                                <div class="col-md-6 col-xl-5 mb-4">
                                    <div class="form-group">
                                        <label for="number">Mobile Number</label>
                                        <input type="text" id="number" name="number" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <br>
                                        <textarea name="address" id="address" rows="4" style="width: 80%;"></textarea>
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
                    
<!-- Display form error -->
<?php if (!empty($form_error)): ?>
    <div class="alert alert-danger"><?php echo $form_error; ?></div>
<?php endif; ?>
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