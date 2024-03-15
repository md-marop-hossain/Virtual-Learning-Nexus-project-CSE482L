<?php
  // Including the database connection file
  include('./dbConnection.php');

  // Including the header section of the main content
  include('./mainInclude/header.php'); 
?>
<div class="container-fluid bg-dark">
    <!-- Start Course Page Banner -->
    <div class="row">
        <!-- Displaying an image for the course page banner -->
        <img src="./image/virtuallearning.jpg" alt="courses"
            style="height:500px; width:100%; object-fit:cover; box-shadow:10px;" />
    </div>
</div> <!-- End Course Page Banner -->

<div class="container mt-5">
    <!-- Start All Course -->
    <h1 class="text-center">All Courses</h1>
    <div class="row mt-4">
        <!-- Start All Course Row -->
        <?php
        // Retrieving all courses from the database
        $sql = "SELECT * FROM course";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Storing course details in variables for easier access
                $course_id = $row['course_id'];
                // Displaying each course in a card format
                echo ' 
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                        <a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px;">
                            <div class="card">
                                <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="Guitar" />
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['course_name'] . '</h5>
                                    <p class="card-text">' . $row['course_desc'] . '</p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text d-inline">Price: <small><del>&#65284; ' . $row['course_original_price'] . '</del></small> <span class="font-weight-bolder">&#65284; ' . $row['course_price'] . '<span></p> 
                                    <a class="btn text-white font-weight-bolder float-right" style="background-color: #092737; color: white" href="coursedetails.php?course_id=' . $course_id . '">Enroll</a>
                                </div>
                            </div> 
                        </a>
                    </div>
                ';
            }
        }
    ?>
    </div><!-- End All Course Row -->
</div><!-- End All Course -->


<?php 
  // Including the contact section
  include('./contact.php'); 
?>

<?php 
  // Including the footer section from mainInclude 
  include('./mainInclude/footer.php'); 
?>