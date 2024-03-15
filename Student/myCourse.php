<?php
// Starting session if not already started
if(!isset($_SESSION)){ 
  session_start(); 
}

// Defining constants for title and page
define('TITLE', 'My Course');
define('PAGE', 'mycourse');

// Including header file
include('./stuInclude/header.php'); 

// Including database connection file
include_once('../dbConnection.php');

// Checking if user is logged in, if yes, fetching user's email
if(isset($_SESSION['is_login'])){
  $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
  // Redirecting to index.php if user is not logged in
  echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="container mt-5 ml-4">
    <div class="row">
        <div class="jumbotron">
            <h4 class="text-center">All Course</h4>
            <?php 
            // Checking if user's email is set
            if(isset($stuLogEmail)){
                // Querying database to fetch user's enrolled courses
                $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, c.course_desc, c.course_img, c.course_author, c.course_original_price, c.course_price FROM courseorder AS co JOIN course AS c ON c.course_id = co.course_id WHERE co.stu_email = '$stuLogEmail'";
                $result = $conn->query($sql);
                
                // Checking if there are any courses enrolled by the user
                if($result->num_rows > 0) {
                    // Looping through each enrolled course
                    while($row = $result->fetch_assoc()){ ?>
            <div class="bg-light mb-3">
                <h5 class="card-header"><?php echo $row['course_name']; ?></h5>
                <div class="row">

                    <div class="col-sm-3">
                        <img src="<?php echo $row['course_img']; ?>" class="card-img-top
                mt-4" alt="pic">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <div class="card-body">
                            <p class="card-title"><?php echo $row['course_desc']; ?></p>
                            <small class="card-text">Duration: <?php echo $row['course_duration']; ?></small><br />
                            <small class="card-text">Instructor: <?php echo $row['course_author']; ?></small><br />
                            <p class="card-text d-inline">Price: <small><del>&#65284
                                        <?php echo $row['course_original_price'] ?> </del></small> <span
                                    class="font-weight-bolder">&#65284 <?php echo $row['course_price']?> <span></p>
                            <a href="watchcourse.php?course_id=<?php echo $row['course_id'] ?>"
                                class="btn mt-5 float-right" style="background-color: #092737; color: white">Watch
                                Course</a>
                        </div>
                    </div>

                </div>

            </div>
            <?php
                    }
                }
            }
  
            ?>
            <hr />
        </div>
    </div>
</div>

</div> <!-- Close Row Div from header file -->
<?php
// Including footer file
include('./stuInclude/footer.php'); 
?>