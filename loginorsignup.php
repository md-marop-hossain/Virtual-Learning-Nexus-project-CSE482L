<?php 
  // Including the database connection file
  include('./dbConnection.php');

  // Including the header section from mainInclude
  include('./mainInclude/header.php'); 
?>
<!-- Start Course Page Banner -->
<div class="container-fluid bg-dark">
    <div class="row">
        <!-- Course banner image -->
        <img src="./image/coursebanner.jpg" alt="courses"
            style="height:300px; width:100%; object-fit:cover; box-shadow:10px;" />
    </div>
</div> <!-- End Course Page Banner -->

<!-- Container for login and registration forms -->
<div class="container jumbotron mb-5">
    <div class="row">
        <div class="col-md-4">
            <!-- Login form -->
            <h5 class="mb-3">If Already Registered !! Login</h5>
            <form role="form" id="stuLoginForm">
                <div class="form-group">
                    <!-- Email input -->
                    <i class="fas fa-envelope"></i><label for="stuLogEmail"
                        class="pl-2 font-weight-bold">Email</label><small id="statusLogMsg1"></small><input type="email"
                        class="form-control" placeholder="Email" name="stuLogEmail" id="stuLogEmail">
                </div>
                <div class="form-group">
                    <!-- Password input -->
                    <i class="fas fa-key"></i><label for="stuLogPass"
                        class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control"
                        placeholder="Password" name="stuLogPass" id="stuLogPass">
                </div>
                <!-- Login button -->
                <button type="button" class="btn btn-primary" id="stuLoginBtn" onclick="checkStuLogin()">Login</button>
            </form><br />
            <small id="statusLogMsg"></small>
        </div>
        <div class="col-md-6 offset-md-1">
            <!-- Registration form -->
            <h5 class="mb-3">New User !! Sign Up</h5>
            <form role="form" id="stuRegForm">
                <div class="form-group">
                    <!-- Name input -->
                    <i class="fas fa-user"></i><label for="stuname" class="pl-2 font-weight-bold">Name</label><small
                        id="statusMsg1"></small><input type="text" class="form-control" placeholder="Name"
                        name="stuname" id="stuname">
                </div>
                <div class="form-group">
                    <!-- Email input -->
                    <i class="fas fa-envelope"></i><label for="stuemail"
                        class="pl-2 font-weight-bold">Email</label><small id="statusMsg2"></small><input type="email"
                        class="form-control" placeholder="Email" name="stuemail" id="stuemail">
                    <!-- Email disclaimer -->
                    <small class="form-text">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <!-- Password input -->
                    <i class="fas fa-key"></i><label for="stupass" class="pl-2 font-weight-bold">New
                        Password</label><small id="statusMsg3"></small><input type="password" class="form-control"
                        placeholder="Password" name="stupass" id="stupass">
                </div>
                <!-- Sign Up button -->
                <button type="button" class="btn btn-primary" id="signup" onclick="addStu()">Sign Up</button>
            </form> <br />
            <!-- Success message -->
            <small id="successMsg"></small>
        </div>
    </div>
</div>
<hr />

<?php 
// Including the contact section
include('./contact.php'); 
?>

<?php 
  // Including the footer section from mainInclude 
  include('./mainInclude/footer.php'); 
?>