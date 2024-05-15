<?php
// Include the necessary files
include('./dbConnection.php');
include('./mainInclude/header.php');

// Function to remove a course ID from the watchlist cookie
function removeFromWatchlist($courseId) {
    if(isset($_COOKIE['watchlist'])) {
        $watchlistCourses = explode(',', $_COOKIE['watchlist']);
        $index = array_search($courseId, $watchlistCourses);
        if($index !== false) {
            unset($watchlistCourses[$index]);
            // Update the watchlist cookie
            setcookie('watchlist', implode(',', $watchlistCourses), time() + (86400 * 30), "/");
        }
    }
}

if(isset($_COOKIE['watchlist'])) {
    $watchlistCourses = explode(',', $_COOKIE['watchlist']);
} else {
    $watchlistCourses = array();
}

if(isset($_GET['delete']) && in_array($_GET['delete'], $watchlistCourses)) {
    removeFromWatchlist($_GET['delete']);
    // Redirect to prevent resubmission of form data
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>
<br>
<br>
<div class="container mt-5 mb-5">
    <h3 class="navbar-brand" style="color: #0d4155">Your Watchlist</h3>
    <div class="row">
        <?php
        foreach($watchlistCourses as $courseId) {
            $watchlistSql = "SELECT * FROM course WHERE course_id = '$courseId'";
            $watchlistResult = $conn->query($watchlistSql);
            if($watchlistResult->num_rows > 0) {
                $row = $watchlistResult->fetch_assoc();
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<img src="'.str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="'.$row['course_name'].'">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">'.$row['course_name'].'</h5>';
                echo '<p class="card-text">'.$row['course_desc'].'</p>';
                echo '<a href="coursedetails.php?course_id='.$row['course_id'].'" class="btn" style="background-color: #0d4155; color: white"><b>View Details</b></a>';
                // Add delete button
                echo '<a href="'.$_SERVER['PHP_SELF'].'?delete='.$row['course_id'].'" class="btn  ml-2" style="background-color: #1d6773; color: white"><b>Remove from Watchlist</b></a>';
                echo '</div></div></div>';
            }
        }
        ?>
    </div>
</div>

<?php 
// Include the footer section from mainInclude 
include('./mainInclude/footer.php'); 
?>