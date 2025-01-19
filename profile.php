<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}
require_once "admin/config1.php";
$user_id = $_SESSION["user_id"];
$u_id="";
$sql = "SELECT *  FROM user where user_id=$user_id";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $name=$row['name'];
            $email = $row['email'];
        }
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}
$sql = "SELECT *  FROM user_info where user_id=$user_id";
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $u_id=$row['user_id'];
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $image = $row['image'];
            $number=$row['mobile_number'];
            $address=$row['address'];
        }
        // Free result set
        mysqli_free_result($result);
    } else {
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - User</title>
    <link rel="stylesheet" href="admin/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="admin/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="admin/assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="admin/assets/bootstrap/css/style.css">
    <!-- CSS for styling -->
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

        .profile-container {
            display: flex;
            align-items: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ddd;
        }

        .profile-info-container {
            margin-left: 20px;
        }

        .profile-info-container h2 {
            margin-bottom: 10px;
        }

        .edit-profile-btn {
            margin-top: 10px;
        }

        .modal-body img {
            display: block;
            margin: 0 auto 10px auto;
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
                    <li class="nav-item"><a class="nav-link active" href="profile.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="askquestion.php"><i class="fas fa-plus"></i><span>Ask question</span></a></li>
                    <?php if($u_id!=$user_id){
                    echo '<li class="nav-item"><a class="nav-link " href="user-info.php"><i class="fas fa-plus"></i><span>Add User-info</span></a></li>';
                    }
                    else{
                        echo '<li class="nav-item"><a class="nav-link " href="#"><i class="fas fa-plus"></i><span>Update User-info</span></a></li>';
                    }
                    ?>
                    </ul>
                <div class="text-center d-none d-md-inline"><button class=" btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><a href="index.php"><button class="btn btn-primary main-btn py-0" type="button">Home</button></a></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $name ?></span><i class="fa fa-user-circle" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Dashboard</h3>
                    <div class="profile-container">
                    <?php if($u_id!=$user_id){
                     ?>
                     <img src="images/all-icon/man-user-circle-icon.png " alt="Profile Picture" class="profile-pic" id="profilePic">
                     <div class="profile-info-container">
                         <h2><?php echo $name?> </h2>
                         <!-- Hardcoded User Name -->
                         <p><?php echo $email  ?></p>
                         <!-- Hardcoded Email -->
                         <p><?php echo "*please Enter your details";?> </p>
                         <!-- Hardcoded Phone -->
                         <p><?php echo "*please Enter your details" ;?> </p>
                         <!-- Hardcoded Address -->
                         <a href="user-info.php"><button class="btn btn-info edit-profile-btn main-btn " data-toggle="modal" >Edit Profile</button></a>
                     </div>';
                <?php
                    }else{
?><img src="image/<?php echo $image;?> " alt="Profile Picture" class="profile-pic" id="profilePic">
                        <div class="profile-info-container">
                            <h2><?php echo $fname ; echo $lname;?> </h2>
                            <!-- Hardcoded User Name -->
                            <p><?php echo $email  ?></p>
                            <!-- Hardcoded Email -->
                            <p><?php echo $number?> </p>
                            <!-- Hardcoded Phone -->
                            <p><?php echo $address?> </p>
                            <!-- Hardcoded Address -->
                            <a href="user-info.php"><button class="btn btn-info edit-profile-btn main-btn " data-toggle="modal" >Update Profile</button></a>
                        </div>';
                   <?php }
                         ?>
                    </div>
                    <a href="askquestion.php" class="btn btn-info mb-4 main-btn"> <i class="fa fa-plus" aria-hidden="true"></i> Ask Question</a>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Question</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                                <option value="10" selected="">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select>&nbsp;</label></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Question ID</th>
                                            <!-- <th>User ID</th> -->
                                            <!-- <th>User Name</th> -->
                                            <th>Question Category</th>
                                            <th>Asked ON</th>
                                            <th>Question</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Include config file

                                        // Attempt select query execution
                                        $sql = "SELECT * FROM user_questions where user_id=$user_id ";
                                        if ($result = mysqli_query($link, $sql)) {
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo "<tr>";
                                                    echo "<td>" . $row['question_id'] . "</td>";
                                                    // echo "<td>" . $row['user_id'] . "</td>";
                                                    // echo "<td>" . $row['user_name'] . "</td>";
                                                    echo "<td>" . $row['question_category'] . "</td>";
                                                    echo "<td>" . $row['asked_on'] . "</td>";
                                                    echo "<td>" . $row['question'] . "</td>";
                                                    echo "<td style='text-align: center;'>";
                                                    echo '<a href="update.php?id=' . $row['question_id'] . '"  title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                    echo '<a href="delete.php?id=' . $row['question_id'] . '" class="mx-4" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }

                                                // Free result set
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

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © 2024-&nbsp; EduConnect</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/theme.js"></script>
</body>

</html>