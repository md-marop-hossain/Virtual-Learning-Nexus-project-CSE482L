<?php
  include('./dbConnection.php'); // Including the database connection file
  // Header Include from mainInclude 
  include('./mainInclude/header.php'); // Including the header section of the webpage
?>
<!-- Start Video Background-->
<div class="container-fluid remove-vid-marg">
    <div class="vid-parent">
        <video playsinline autoplay muted loop>
            <source src="video/videoo.mp4" /> <!-- Video source for the background -->
        </video>
        <div class="vid-overlay"></div> <!-- Overlay for the video -->
    </div>
    <div class="vid-content">
        <h1 class="my-content">Welcome to Virtual Learning Nexus</h1> <!-- Heading for the webpage -->
        <small class="my-content">Learn and Implement</small><br /> <!-- Subheading for the webpage -->
        <?php    
    if(!isset($_SESSION['is_login'])){
        echo '<a class="btn mt-3" style="background-color: #092737; color: white;" href="#" data-toggle="modal" data-target="#stuRegModalCenter">Get Started</a>'; // Button for registration if the user is not logged in
    } else {
        echo '<a class="btn mt-3" style="background-color: #092737; color: white;" href="student/studentProfile.php">My Profile</a>'; // Button for user profile if logged in
    }
     ?>


    </div>
</div> <!-- End Video Background -->

<div class="container-fluid  txt-banner" style="background-color: #092737;">
    <!-- Your content here -->
    <!-- Start Text Banner -->
    <div class="row bottom-banner">
        <div class="col-sm">
            <h5> <i class="fas fa-book-open mr-3"></i> 100+ Online Courses</h5>
            <!-- Displaying the number of online courses -->
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-users mr-3"></i> Expert Instructors</h5> <!-- Displaying expert instructors -->
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-keyboard mr-3"></i> Lifetime Access</h5> <!-- Displaying lifetime access -->
        </div>
        <div class="col-sm">
            <h5><i class="fas fa-rupee-sign mr-3"></i> Money Back Guarantee*</h5>
            <!-- Displaying money-back guarantee -->
        </div>
    </div>
</div> <!-- End Text Banner -->

<div class="container mt-5">
    <!-- Start All Course -->
    <h1 class="text-center">All Courses</h1> <!-- Heading for all courses section -->
    <div class="row mt-4">
        <!-- Start All Course Row -->
        <?php
        $sql = "SELECT * FROM course"; // SQL query to fetch all courses from the database
        $result = $conn->query($sql); // Executing the query
        $counter = 0; // Counter variable to track the number of displayed cards
        if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){
                if ($counter < 6) { // Limiting to 6 cards
                    $course_id = $row['course_id']; // Fetching course ID
                    echo ' 
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4"> <!-- Specify columns for different screen sizes -->
                            <a href="coursedetails.php?course_id='.$course_id.'" class="btn" style="text-align: left; padding:0px;">
                                <div class="card">
                                    <img src="'.str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="Guitar" /> <!-- Displaying course image -->
                                    <div class="card-body">
                                        <h5 class="card-title">'.$row['course_name'].'</h5> <!-- Displaying course name -->
                                        <p class="card-text">'.$row['course_desc'].'</p> <!-- Displaying course description -->
                                    </div>
                                    <div class="card-footer">
                                        <p class="card-text d-inline">Price: <small><del>&#65284; '.$row['course_original_price'].'</del></small> <span class="font-weight-bolder">&#65284; '.$row['course_price'].'<span></p> <!-- Displaying course price -->
                                        <a class="btn font-weight-bolder float-right" style="background-color: #092737; color: white" href="coursedetails.php?course_id='.$course_id.'">Enroll</a> <!-- Button to enroll in the course -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    ';
                    $counter++; // Increment the counter after displaying a card
                } else {
                    break; // Exit the loop once 6 cards have been displayed
                }
            }
        }
    ?>
    </div><!-- End All Course Row -->
    <div class="text-center m-2">
        <a class="btn  btn-sm" style="background-color: #092737; color: white" href="courses.php">View All Course</a>
        <!-- Button to view all courses -->
    </div>
</div><!-- End All Course -->

<?php 
    // Contact Us
    include('./contact.php'); // Including the contact section 
    ?>

<!-- Start Students Testimonial -->
<div class="container-fluid mt-5" style="background-color: #4B7289" id="Feedback">
    <h1 class="text-center testyheading p-4"> Student's Feedback </h1> <!-- Heading for student feedback section -->
    <div class="row">
        <div class="col-md-12">
            <div id="testimonial-slider" class="owl-carousel">
                <?php 
              $sql = "SELECT s.stu_name, s.stu_occ, s.stu_img, f.f_content FROM student AS s JOIN feedback AS f ON s.stu_id = f.stu_id"; // SQL query to fetch student feedback
              $result = $conn->query($sql); // Executing the query
              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                  $s_img = $row['stu_img'];
                  $n_img = str_replace('../','',$s_img)
            ?>
                <div class="testimonial">
                    <p class="description">
                        <?php echo $row['f_content'];?>
                        <!-- Displaying student feedback content -->
                    </p>
                    <div class="pic">
                        <img src="<?php echo $n_img; ?>" alt="" /> <!-- Displaying student image -->
                    </div>
                    <div class="testimonial-prof">
                        <h4><?php echo $row['stu_name']; ?></h4> <!-- Displaying student name -->
                        <small><?php echo $row['stu_occ']; ?></small> <!-- Displaying student occupation -->
                    </div>
                </div>
                <?php }} ?>
            </div>
        </div>
    </div>
</div> <!-- End Students Testimonial -->

<div class="container-fluid" style="background-color: #092737; color: white;">
    <!-- Start Social Follow -->
    <div class="row text-white text-center p-1">
        <div class="col-sm">
            <a class="text-white social-hover" href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
        </div>
        <div class="col-sm">
            <a class="text-white social-hover" href="#"><i class="fab fa-twitter"></i> Twitter</a>
        </div>
        <div class="col-sm">
            <a class="text-white social-hover" href="#"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        </div>
        <div class="col-sm">
            <a class="text-white social-hover" href="#"><i class="fab fa-instagram"></i> Instagram</a>
        </div>
    </div>
</div> <!-- End Social Follow -->

<!-- Start About Section -->
<div class="container-fluid p-4" style="background-color:#4a5f74">
    <div class="container" style="background-color:#4a5f74; color: white">
        <div class="row text-center">
            <div class="col-sm">
                <h5>About Us</h5>
                <p>Virtual Learning Nexus is dedicated to delivering high-quality education globally, collaborating with
                    renowned universities and organizations to provide comprehensive online courses.</p>

            </div>
            <div class="col-sm">
                <h5>Category</h5>
                <a class="text-white" href="#">Web Development</a><br />
                <a class="text-white" href="#">Web Designing</a><br />
                <a class="text-white" href="#">Android App Dev</a><br />
                <a class="text-white" href="#">iOS Development</a><br />
                <a class="text-white" href="#">Data Analysis</a><br />
            </div>
            <div class="col-sm">
                <h5>Contact Us</h5>
                <p>Virtual Learning Nexus Pvt Ltd <br> 1234 ABC Street <br> Dhaka, Bangladesh <br> Ph. 1234567890
                </p>

            </div>
        </div>
    </div>
</div> <!-- End About Section -->

<?php 
    // Footer Include from mainInclude 
    include('./mainInclude/footer.php'); // Including the footer section
    
  ?>