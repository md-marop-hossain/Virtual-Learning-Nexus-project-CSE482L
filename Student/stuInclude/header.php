<?php 
// Including the database connection file
include_once('../dbConnection.php');

// Starting a session if not already started
if(!isset($_SESSION)){ 
   session_start(); 
} 

// Checking if the user is logged in
if(isset($_SESSION['is_login'])){
    // Retrieving the logged-in student's email from session
    $stuLogEmail = $_SESSION['stuLogEmail'];
} 

// Retrieving the student's image if logged in
if(isset($stuLogEmail)){
    // Querying the database to fetch the student's image
    $sql = "SELECT stu_img FROM student WHERE stu_email = '$stuLogEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $stu_img = $row['stu_img'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo TITLE ?>
        <!-- Displaying the title -->
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/stustyle.css">

</head>

<body style="background-color: #03264838">
    <!-- Top Navbar -->
    <!-- Navigation bar with the application name -->
    <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" style="background-color: #225470;">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="studentProfile.php">E-Learning</a>
    </nav>

    <!-- Side Bar -->
    <!-- Sidebar with various navigation links -->
    <div class="container-fluid mb-5 " style="margin-top:40px;">
        <div class="row">
            <!-- Sidebar navigation -->
            <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <!-- Displaying student image -->
                        <li class="nav-item mb-3">
                            <img src="<?php echo $stu_img ?>" alt="studentimage" class="img-thumbnail rounded-circle">
                        </li>
                        <!-- Navigation link for student profile -->
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'profile') {echo 'active';} ?>"
                                href="studentProfile.php">
                                <i class="fas fa-user"></i>
                                Profile <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <!-- Navigation link for student's courses -->
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'mycourse') {echo 'active';} ?>" href="myCourse.php">
                                <i class="fab fa-accessible-icon"></i>
                                My Courses
                            </a>
                        </li>
                        <!-- Navigation link for providing feedback -->
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'feedback') {echo 'active';} ?>" href="stufeedback.php">
                                <i class="fab fa-accessible-icon"></i>
                                Feedback
                            </a>
                        </li>
                        <!-- Navigation link for changing password -->
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'studentChangePass') {echo 'active';} ?>"
                                href="studentChangePass.php">
                                <i class="fas fa-key"></i>
                                Change Password
                            </a>
                        </li>
                        <!-- Navigation link for logging out -->
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                        <!-- Navigation link for returning to the homepage -->
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                <i class="fa fa-backward" aria-hidden="true"></i>
                                <span class=""> Back To Homepage</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>