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
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/jquery.nice-number.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
   
</head>

<body>
    
<?php require_once "navbar.php";  ?>
    <section id="courses-part" class="pt-120 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="courses-top-search">
                        <div class="courses-search float-right">
                            <form action="#">
                                <input type="text" id="search-input" placeholder="Search">
                                <button type="button" id="search-button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="courses-container" class="tab-content">
                <div class="tab-pane fade show active" id="courses-grid" role="tabpanel" aria-labelledby="courses-grid-tab">
                <?php
                    // Include config file
                    require_once "./admin/config1.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM add_papers";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                           ?>
                <div class="row" id="courses-list">
                <?php  while($row = mysqli_fetch_array($result)){?>
                        <!-- Example course item, repeat as necessary -->
                        <div class="col-lg-4 col-md-6 course-item">
                        
                            <div class="singel-question-paper mt-30">
                                <div class="thum">
                                
                                    <div class="image"> 
                                        <img data-enlargable src="./admin/img/<?php echo $row['image']; ?>" alt="question-paper">
                                    </div>
                                    <div class="paper-pic">
                                        <a href="./admin/img/<?php echo $row['image']; ?>" download="">
                                            <span><i class="fa fa-download" aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                </div>
                                <div class="cont">
                                    <a href="question-papers-singel.html">
                                      <?php  echo '<table style="color: black;">';
                                            echo "<tr>";
                                               echo' <td class="papers">Course Title :</td>';
                                               echo ' <td class="course-title">'. $row['course_name'] .'</td>';
                                           echo" </tr>";
                                           echo "<tr>";
                                                echo '<td class="papers">Course Code :</td>';
                                               echo ' <td class="course-code">'. $row['course_code'] .'</td>';
                                                echo" </tr>";
                                            echo "<tr>";
                                               echo' <td style="text-align: center;" class="papers">Program :</td>';
                                                echo '<td class="course-program">'. $row['course_department'] .'</td>';
                                                echo" </tr>";
                            
                                       echo" </table>";?>
                                       
                                    </a>
                                </div>
                            </div>
                           
                        </div>
                        <?php } ?>
                    
                        <!-- End of example course item -->
                        <!--  -->
                       
                    </div>
                    <?php // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
            

            <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center" id="pagination">
                            <!-- Pagination items will be injected here by JavaScript -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

  <?php require_once "footer.html"; ?>
    <script>
        $('img[data-enlargable]').addClass('img-enlargable').click(function() {
            var src = $(this).attr('src');
            $('<div>').css({
                background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
                backgroundSize: 'contain',
                width: '100%',
                height: '100%',
                position: 'fixed',
                zIndex: '10000',
                top: '0',
                left: '0',
                cursor: 'zoom-out'
            }).click(function() {
                $(this).remove();
            }).appendTo('body');
        });
    </script>
    <script src="js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.nice-number.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/validator.min.js"></script>
    <script src="js/ajax-contact.js"></script>
    <script src="js/main.js"></script>
    <script>
        $(document).ready(function() {
            const itemsPerPage = 6; // Adjust the number of items per page
            const courses = $('#courses-list .course-item');
            const totalPages = Math.ceil(courses.length / itemsPerPage);
            const pagination = $('#pagination');

            function showPage(page) {
                courses.hide();
                courses.slice((page - 1) * itemsPerPage, page * itemsPerPage).show();
                pagination.find('a').removeClass('active');
                pagination.find(`a[data-page=${page}]`).addClass('active');
            }

            for (let i = 1; i <= totalPages; i++) {
                const pageItem = $(`<li class="page-item"><a href="#" data-page="${i}">${i}</a></li>`);
                pagination.append(pageItem);
            }

            pagination.on('click', 'a', function(event) {
                event.preventDefault();
                const page = $(this).data('page');
                showPage(page);
            });

            showPage(1);

            $('#search-button').click(function() {
                const searchTerm = $('#search-input').val().toLowerCase();
                courses.hide();
                const filteredCourses = courses.filter(function() {
                    const title = $(this).find('.course-title').text().toLowerCase();
                    const code = $(this).find('.course-code').text().toLowerCase();
                    const program = $(this).find('.course-program').text().toLowerCase();
                    return title.includes(searchTerm) || code.includes(searchTerm) || program.includes(searchTerm);
                });
                filteredCourses.show();
                updatePagination(filteredCourses);
            });

            $('#search-input').on('keyup', function(event) {
                if (event.keyCode === 13) {
                    $('#search-button').click();
                }
            });

            function updatePagination(filteredCourses) {
                pagination.empty();
                const totalPages = Math.ceil(filteredCourses.length / itemsPerPage);
                for (let i = 1; i <= totalPages; i++) {
                    const pageItem = $(`<li class="page-item"><a href="#" data-page="${i}">${i}</a></li>`);
                    pagination.append(pageItem);
                }
                pagination.on('click', 'a', function(event) {
                    event.preventDefault();
                    const page = $(this).data('page');
                    showFilteredPage(page, filteredCourses);
                });
                showFilteredPage(1, filteredCourses);
            }

            function showFilteredPage(page, filteredCourses) {
                filteredCourses.hide();
                filteredCourses.slice((page - 1) * itemsPerPage, page * itemsPerPage).show();
                pagination.find('a').removeClass('active');
                pagination.find(`a[data-page=${page}]`).addClass('active');
            }
        });
    </script>


</body>

</html>