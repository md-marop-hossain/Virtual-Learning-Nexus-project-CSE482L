<?php
// Include necessary files
include('./dbConnection.php');
include('./mainInclude/header.php'); 


if(isset($_COOKIE['watchlist'])) {
    $watchlistCourses = explode(',', $_COOKIE['watchlist']);
} else {
    $watchlistCourses = array();
}
?>
<br>
<br>
<!-- <h1 class="mt-5">watchlist</h1> -->
<!-- Display watchlist courses -->
<div class="container mt-5 mb-5">
    <h3 class="navbar-brand" style="color: #0d4155">Your Watchlist</h3>
    <div class="row">
        <?php
        // Fetch course details for each course ID in the watchlist
        foreach($watchlistCourses as $courseId) {
            // Fetch course details from the database
            $watchlistSql = "SELECT * FROM course WHERE course_id = '$courseId'";
            $watchlistResult = $conn->query($watchlistSql);
            if($watchlistResult->num_rows > 0) {
                $row = $watchlistResult->fetch_assoc();
                // Display course details
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<img src="'.str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="'.$row['course_name'].'">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['course_name'].'</h5>';
                echo '<p class="card-text">'.$row['course_desc'].'</p>';
                echo '<a href="coursedetails.php?course_id='.$row['course_id'].'" class="btn" style="background-color: #0d4155; color: white">View Details</a>';
                echo '</div></div></div>';
            }
        }
        ?>

    </div>
</div>


<?php 
// Including the footer section from mainInclude 
include('./mainInclude/footer.php'); 
?>