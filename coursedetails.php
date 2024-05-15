<?php
// Include necessary files
include('./dbConnection.php');
include('./mainInclude/header.php'); 
$stu_email = '';
?>

<div class="container-fluid bg-dark">
    <!-- Start Course Page Banner -->
    <div class="row">
        <!-- Displaying the course banner image -->
        <img src="./image/lv.png" alt="courses" style="height:400px; width:100%; object-fit:cover; box-shadow:10px;" />
    </div>
</div> <!-- End Course Page Banner -->

<div class="container mt-5">
    <!-- Start All Course -->
    <?php
    // Checking if a course_id is set in the URL
    if(isset($_GET['course_id'])){
        $course_id = $_GET['course_id'];
        // Fetching course details based on course_id
        $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
        $result = $conn->query($sql);
        // Checking if there are any results
        if($result->num_rows > 0){ 
            // Displaying course details
            while($row = $result->fetch_assoc()){
                // Check if stuLogEmail is set in the session
                if(isset($_SESSION['stuLogEmail'])) {
                    $stu_email = $_SESSION['stuLogEmail'];
                }
                // Initial course price
                $course_price = $row['course_price'];
                $course_price_original =  $course_price;
                // Check if coupon code is submitted
                if(isset($_POST['apply_coupon'])) {
                    $coupon_code = $_POST['coupon_code'];
                    // Fetch coupon details from database
                    $coupon_sql = "SELECT * FROM coursecoupon WHERE coupon_code = '$coupon_code'";
                    $coupon_result = $conn->query($coupon_sql);
                    if($coupon_result->num_rows > 0) {
                        // Coupon exists, calculate discount
                        $coupon_row = $coupon_result->fetch_assoc();
                        $discount_percentage = $coupon_row['couponpercentage'];
                        $discount_amount = ($course_price * $discount_percentage) / 100;
                        // Update course price after discount
                        $course_price -= $discount_amount;
                        // Show success message
                        echo '<div class="alert" style="background-color: #01791d; color: white" role="alert">Coupon applied successfully! You got '.$discount_percentage.'% discount. Original Price was &#36;'.$course_price_original.', Discounted price: &#36;'.$course_price.'</div>';
                    } else {
                        // Coupon does not exist
                        echo '<div class="alert" style="background-color: #051d21; color: white" role="alert">Coupon does not exist!</div>';
                    }
                }

                echo ' 
                <div class="row">
                    <div class="col-md-4">
                        <!-- Displaying course image -->
                        <img src="'.str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="Guitar" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Course Name: '.$row['course_name'].'</h5>
                            <p class="card-text"> Description: '.$row['course_desc'].'</p>
                            <p class="card-text"> Duration: '.$row['course_duration'].'</p>
                            <p class="card-text">Price: &#36;'.$course_price.'</p>';
                            
                            // Check if the user has already bought the course
                            $check_order_sql = "SELECT course_id, email FROM courseordernew WHERE course_id = '$course_id' AND email = '$stu_email'";
                            $check_order_result = $conn->query($check_order_sql);
                            if($check_order_result->num_rows > 0) {
                                // If the user has bought the course, show "Go to courses you have already purchased button
                                echo '<a href="student/myCourse.php" class="btn text-white mb-3 font-weight-bolder float-right" style="background-color: #092737; color: white">Go to courses you have already purchased</a>';
                            } else {
                                // If the user has not bought the course, show coupon form and "Buy Now" button
                                echo '
                                <!-- Coupon code form -->
                                <form action="" method="post" class="form-inline ">
                                <div class="form-group  mb-2">
                                    <input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Coupon Code">
                                </div>
                                <button type="submit" class="btn btn-info mb-2 ml-1" name="apply_coupon">Apply Coupon</button>
                            </form>
                            <br>
                                <form action="paymentcheckout.php" method="post">
                                    <input type="hidden" name="id" value="'. $course_price .'"> 
                                    <input type="hidden" name="cid" value="'. $row["course_id"] .'"> 
                                    <input type="hidden" name="cname" value="'. $row["course_name"] .'"> 

                                    <!-- Add to Watchlist button -->
                                    <button class="btn btn-info mb-2 ml-1 add-to-watchlist" data-courseid="'.$row['course_id'].'">Add to Watchlist</button>


                                    <button type="submit" class="btn text-white font-weight-bolder float-right mb-2" style="background-color: #092737; color: white" name="buy">Buy Now</button>
                                </form>';
                            }
                            
                            echo '
                        </div>
                    </div>
                </div>';
            }
        }
    }
    ?>
</div><!-- End All Course -->

<div class="container">
    <div class="row">
        <?php 
        // Fetching all lessons from the database
        $sql = "SELECT * FROM lesson";
        $result = $conn->query($sql);
        // Checking if there are any lessons available
        if($result->num_rows > 0){
            echo '
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Lesson No.</th>
                        <th scope="col">Lesson Name</th>
                    </tr>
                </thead>
                <tbody>';
                $num = 0;
                // Displaying lesson details
                while($row = $result->fetch_assoc()){
                    if($row['course_id'] == $course_id) {
                        $num++;
                        echo ' <tr>
                        <th scope="row">'.$num.'</th>
                        <td>'. $row["lesson_name"].'</td></tr>';
                    }
                }
                echo '</tbody>
            </table>';
        } 
        ?>
    </div>
</div>


<!-- JavaScript code to handle adding course to watchlist -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    var addToWatchlistButtons = document.querySelectorAll('.add-to-watchlist');
    addToWatchlistButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            // Prevent default behavior of anchor tag
            event.preventDefault();

            var courseId = this.getAttribute('data-courseid');
            var existingWatchlist = getCookie("watchlist");
            // Check if watchlist cookie already exists
            if (existingWatchlist) {
                // Append new courseId to existing watchlist
                var updatedWatchlist = existingWatchlist + ',' + courseId;
                document.cookie = "watchlist=" + updatedWatchlist + "; path=/";
            } else {
                // Create new watchlist cookie
                document.cookie = "watchlist=" + courseId + "; path=/";
            }
            alert("Course added to watchlist!");
        });
    });
});

// Function to get cookie value by name
function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
}
</script>



<?php 
// Including the footer section from mainInclude 
include('./mainInclude/footer.php'); 
?>