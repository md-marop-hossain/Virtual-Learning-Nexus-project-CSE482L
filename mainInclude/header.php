<?php
// Start the session at the very beginning of the PHP script
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for character set, viewport, and compatibility -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Student Testimonial Owl Slider CSS -->
    <link rel="stylesheet" type="text/css" href="css/owl.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.min.css">
    <link rel="stylesheet" type="text/css" href="css/testyslider.css">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <!-- Page title -->
    <title>Virtual Learning Nexus</title>

    <!-- Inline style -->
    <style>
    /* Custom styles for navigation */
    .custom-nav-item:hover {
        background-color: #02273b !important;
        border: solid #0b1514 1px !important;
        border-radius: 10px;
    }

    /* Video overlay style */
    .vid-overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: #0b1514;
        z-index: 1;
        opacity: 0.8;
    }
    </style>

    <script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var subject = document.getElementsByName("subject")[0].value;
        var message = document.getElementsByName("message")[0].value;

        if (name == "" || email == "" || subject == "" || message == "") {
            alert("All fields are required!");
            return false;
        }

        return true;
    }
    </script>
</head>

<body style="background-color: #001a352e">
    <!-- Setting background color of body -->
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-sm navbar-dark pl-5 fixed-top">
        <!-- Brand logo and text -->
        <a href="index.php" class="navbar-brand">Virtual Learning Nexus</a>
        <span class="navbar-text">Learn and Implement</span>
        <!-- Navbar toggler button for responsive design -->
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar menu items -->
        <div class="collapse navbar-collapse" id="myMenu">
            <ul class="navbar-nav pl-5 custom-nav">
                <!-- Home link -->
                <li class="nav-item custom-nav-item"><a href="index.php" class="nav-link">Home</a></li>
                <!-- Courses link -->
                <li class="nav-item custom-nav-item"><a href="courses.php" class="nav-link">Courses</a></li>
                <!-- Profile and logout links (dynamic based on session) -->
                <?php 
                    if (isset($_SESSION['is_login'])){
                        echo '<li class="nav-item custom-nav-item"><a href="student/studentProfile.php" class="nav-link">My Profile</a></li> <li class="nav-item custom-nav-item"><a href="logout.php" class="nav-link">Logout</a></li>';
                    } else {
                        echo '<li class="nav-item custom-nav-item"><a href="#login" class="nav-link" data-toggle="modal" data-target="#stuLoginModalCenter">Login</a></li> <li class="nav-item custom-nav-item"><a href="#signup" class="nav-link" data-toggle="modal" data-target="#stuRegModalCenter">Signup</a></li>';
                    }
                ?>
                <!-- Feedback and Contact links -->
                <li class="nav-item custom-nav-item"><a href="#Feedback" class="nav-link">Feedback</a></li>
                <li class="nav-item custom-nav-item"><a href="#Contact" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav> <!-- End Navigation -->
</body>

</html>