<?php
// Start session if not already started
if(!isset($_SESSION)){ 
  session_start(); 
}

// Define constants
define('TITLE', 'Change Password');
define('PAGE', 'studentChangePass');

// Include header file
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

// Check if user is logged in, if not redirect to index page
if(isset($_SESSION['is_login'])){
  $stuEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}

// Check if password update button is clicked
if(isset($_REQUEST['stuPassUpdateBtn'])){
  // Check if new password field is empty
  if(($_REQUEST['stuNewPass'] == "")){
    // Display warning message if required field is missing
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Fetch student data from database
    $sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
      // Get new password from form input
      $stuPass = $_REQUEST['stuNewPass'];
      // Update password in database
      $sql = "UPDATE student SET stu_pass = '$stuPass' WHERE stu_email = '$stuEmail'";
      if($conn->query($sql) == TRUE){
        // Display success message if password update is successful
        $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
      } else {
        // Display error message if password update fails
        $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
      }
    }
  }
}

?>

<!-- HTML content starts here -->
<div class="col-sm-9 col-md-10">
    <div class="row">
        <div class="col-sm-6">
            <form class="mt-5 mx-5" method="POST">
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <!-- Display student email (readonly) -->
                    <input type="email" class="form-control" id="inputEmail" value=" <?php echo $stuEmail ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="inputnewpassword">New Password</label>
                    <!-- Input field for new password -->
                    <input type="password" class="form-control" id="inputnewpassword" placeholder="New Password"
                        name="stuNewPass">
                </div>
                <!-- Submit and reset buttons -->
                <button type="submit" class="btn btn-primary mr-4 mt-4" name="stuPassUpdateBtn">Update</button>
                <button type="reset" class="btn btn-secondary mt-4">Reset</button>
                <!-- Display password update status message, if any -->
                <?php if(isset($passmsg)) {echo $passmsg; } ?>
            </form>
        </div>
    </div>
</div>
<!-- Close Row Div from header file -->
</div>

<?php
// Include footer file
include('./stuInclude/footer.php'); 
?>