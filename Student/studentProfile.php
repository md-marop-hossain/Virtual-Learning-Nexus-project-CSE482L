<?php
// Start session if not already started
if(!isset($_SESSION)){ 
  session_start(); 
}

// Define page title and current page for navigation
define('TITLE', 'Student Profile');
define('PAGE', 'profile');

// Include header file
include('./stuInclude/header.php'); 
include_once('../dbConnection.php');

// Check if user is logged in, if not, redirect to login page
if(isset($_SESSION['is_login'])){
  $stuEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}

// Fetch student details from database
$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if($result->num_rows == 1){
  $row = $result->fetch_assoc();
  $stuId = $row["stu_id"];
  $stuName = $row["stu_name"]; 
  $stuOcc = $row["stu_occ"];
  $stuImg = $row["stu_img"];
}

// Check if update button is clicked
if(isset($_REQUEST['updateStuNameBtn'])){
  // Validate form fields
  if(($_REQUEST['stuName'] == "")){
    // Display warning message if required field is missing
    $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fields </div>';
  } else {
    // Update student details
    $stuName = $_REQUEST["stuName"];
    $stuOcc = $_REQUEST["stuOcc"];
    $stu_image = $_FILES['stuImg']['name']; 
    $stu_image_temp = $_FILES['stuImg']['tmp_name'];
    $img_folder = '../image/stu/'. $stu_image; 
    // Move uploaded image to destination folder
    move_uploaded_file($stu_image_temp, $img_folder);
    // Update database with new details
    $sql = "UPDATE student SET stu_name = '$stuName', stu_occ = '$stuOcc', stu_img = '$img_folder' WHERE stu_email = '$stuEmail'";
    if($conn->query($sql) == TRUE){
      // Display success message on successful update
      $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
    } else {
      // Display error message on update failure
      $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
    }
  }
}
?>

<!-- HTML form for updating student profile -->
<div class="col-sm-6 mt-5">
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="stuId">Student ID</label>
            <!-- Display student ID -->
            <input type="text" class="form-control" id="stuId" name="stuId"
                value=" <?php if(isset($stuId)) {echo $stuId;} ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stuEmail">Email</label>
            <!-- Display student email -->
            <input type="email" class="form-control" id="stuEmail" value=" <?php echo $stuEmail ?>" readonly>
        </div>
        <div class="form-group">
            <label for="stuName">Name</label>
            <!-- Input field for student name -->
            <input type="text" class="form-control" id="stuName" name="stuName"
                value=" <?php if(isset($stuName)) {echo $stuName;} ?>">
        </div>
        <div class="form-group">
            <!-- Input field for student occupation -->
            <label for="stuOcc">Occupation</label>
            <input type="text" class="form-control" id="stuOcc" name="stuOcc"
                value=" <?php if(isset($stuOcc)) {echo $stuOcc;} ?>">
        </div>
        <div class="form-group">
            <!-- Input field for uploading image -->
            <label for="stuImg">Upload Image</label>
            <input type="file" class="form-control-file" id="stuImg" name="stuImg">
        </div>
        <!-- Button to submit form -->
        <button type="submit" class="btn btn-primary" name="updateStuNameBtn">Update</button>
        <?php if(isset($passmsg)) {echo $passmsg; } ?>
    </form>
</div>

</div> <!-- Close Row Div from header file -->

<?php
// Include footer file
include('./stuInclude/footer.php'); 
?>