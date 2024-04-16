<?php
// Start session if not already started
if(!isset($_SESSION)){ 
  session_start(); 
}

// Define constants for title and page
define('TITLE', 'Feedback');
define('PAGE', 'feedback');

// Include header file
include('./stuInclude/header.php'); 
// Include database connection file
include_once('../dbConnection.php');

// Check if user is logged in
if(isset($_SESSION['is_login'])){
  // Get student email from session
  $stuEmail = $_SESSION['stuLogEmail'];
} else {
  // Redirect to index if not logged in
  echo "<script> location.href='../index.php'; </script>";
}

// Retrieve student information from database
$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1){
  $row = $result->fetch_assoc();
  $stuId = $row["stu_id"];
}

// Handle form submission for feedback
if(isset($_REQUEST['submitFeedbackBtn'])){
  // Check if feedback content is provided
  if(($_REQUEST['f_content'] == "")){
    // Display warning message if required field is missing
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Get feedback content from form
    $fcontent = $_REQUEST["f_content"];
    // Insert feedback into database
    $sql = "INSERT INTO feedback (f_content, stu_id) VALUES ('$fcontent', '$stuId')";
    if($conn->query($sql) == TRUE){
      // Display success message on successful submission
      $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Submitted Successfully </div>';
    } else {
      // Display error message on submission failure
      $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Submit </div>';
    }
  }
}
?>
<div class="col-sm-6 mt-5">
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="stuId">Student ID</label>
            <!-- Display student ID (read-only) -->
            <input type="text" class="form-control" id="stuId" name="stuId"
                value="<?php if(isset($stuId)) {echo $stuId;} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="f_content">Write Feedback:</label>
            <!-- Textarea for writing feedback -->
            <textarea class="form-control" id="f_content" name="f_content" row=2></textarea>
        </div>
        <!-- Submit button for feedback form -->
        <button type="submit" class="btn btn-primary" name="submitFeedbackBtn">Submit</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
    </form>
</div>

</div> <!-- Close Row Div from header file -->

<?php
// Include footer file
include('./stuInclude/footer.php'); 
?>