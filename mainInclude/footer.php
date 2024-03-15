<!-- Start Footer -->
<footer class="container-fluid text-center p-2" style="background-color: #092737; color: white;">
    <!-- Copyright and Designed By information -->
    <small class="text-white">Copyright &copy; 2024 || Designed By Virtual Learning Nexus ||
        <?php   
        // Check if admin is logged in, display appropriate links
        if (isset($_SESSION['is_admin_login'])){
            echo '<a href="admin/adminDashboard.php"> Admin Dashboard</a> <a href="logout.php">Logout</a>';
        } else {
            echo '<a href="#login" data-toggle="modal" data-target="#adminLoginModalCenter"> Admin Login</a>';
        }
        ?>
    </small>
</footer> <!-- End Footer -->

<!-- Start Student Registration Modal -->
<div class="modal fade" id="stuRegModalCenter" tabindex="-1" role="dialog" aria-labelledby="stuRegModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Modal title -->
                <h5 class="modal-title" id="stuRegModalCenterTitle">Student Registration</h5>
                <!-- Close button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearAllStuReg()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Include student registration form -->
                <?php include('studentRegistration.php'); ?>
            </div>
            <div class="modal-footer">
                <!-- Display success message -->
                <span id="successMsg"></span>
                <!-- Sign Up and Close buttons -->
                <button type="button" class="btn" style="background-color: #092737; color: white" id="signup"
                    onclick="addStu()">Sign Up</button>
                <button type="button" class="btn" style="background-color: #092737; color: white" data-dismiss="modal"
                    onclick="clearAllStuReg()">Close</button>
            </div>
        </div>
    </div>
</div> <!-- End Student Registration Modal -->

<!-- Start Student Login Modal -->
<div class="modal fade" id="stuLoginModalCenter" tabindex="-1" role="dialog" aria-labelledby="stuLoginModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Modal title -->
                <h5 class="modal-title" id="stuLoginModalCenterTitle">Student Login</h5>
                <!-- Close button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onClick="clearStuLoginWithStatus()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Student login form -->
                <form role="form" id="stuLoginForm">
                    <div class="form-group">
                        <!-- Email input -->
                        <i class="fas fa-envelope"></i><label for="stuLogEmail"
                            class="pl-2 font-weight-bold">Email</label><small id="statusLogMsg1"></small><input
                            type="email" class="form-control" placeholder="Email" name="stuLogEmail" id="stuLogEmail">
                    </div>
                    <div class="form-group">
                        <!-- Password input -->
                        <i class="fas fa-key"></i><label for="stuLogPass"
                            class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control"
                            placeholder="Password" name="stuLogPass" id="stuLogPass">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Display status message -->
                <small id="statusLogMsg"></small>
                <!-- Login and Cancel buttons -->
                <button type="button" class="btn" style="background-color: #092737; color: white" id="stuLoginBtn"
                    onclick="checkStuLogin()">Login</button>
                <button type="button" class="btn" style="background-color: #092737; color: white" data-dismiss="modal"
                    onClick="clearStuLoginWithStatus()">Cancel</button>
            </div>
        </div>
    </div>
</div> <!-- End Student Login Modal -->

<!-- Start Admin Login Modal -->
<div class="modal fade" id="adminLoginModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="adminLoginModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- Modal title -->
                <h5 class="modal-title" id="adminLoginModalCenterTitle">Admin Login</h5>
                <!-- Close button -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    onClick="clearAdminLoginWithStatus()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Admin login form -->
                <form role="form" id="adminLoginForm">
                    <div class="form-group">
                        <!-- Email input -->
                        <i class="fas fa-envelope"></i><label for="adminLogEmail"
                            class="pl-2 font-weight-bold">Email</label><input type="email" class="form-control"
                            placeholder="Email" name="adminLogEmail" id="adminLogEmail">
                    </div>
                    <div class="form-group">
                        <!-- Password input -->
                        <i class="fas fa-key"></i><label for="adminLogPass"
                            class="pl-2 font-weight-bold">Password</label><input type="password" class="form-control"
                            placeholder="Password" name="adminLogPass" id="adminLogPass">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- Display status message -->
                <small id="statusAdminLogMsg"></small>
                <!-- Login and Cancel buttons -->
                <button type="button" class="btn" style="background-color: #092737; color: white" id="adminLoginBtn"
                    onclick="checkAdminLogin()">Login</button>
                <button type="button" class="btn" style="background-color: #092737; color: white" data-dismiss="modal"
                    onClick="clearAdminLoginWithStatus()">Cancel</button>
            </div>
        </div>
    </div>
</div> <!-- End Admin Login Modal -->

<!-- Jquery and Boostrap JavaScript -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- Font Awesome JS -->
<script type="text/javascript" src="js/all.min.js"></script>

<!-- Student Testimonial Owl Slider JS -->
<script type="text/javascript" src="js/owl.min.js"></script>
<script type="text/javascript" src="js/testyslider.js"></script>

<!-- Student Ajax Call JavaScript -->
<script type="text/javascript" src="js/ajaxrequest.js"></script>

<!-- Admin Ajax Call JavaScript -->
<script type="text/javascript" src="js/adminajaxrequest.js"></script>

<!-- Custom JavaScript -->
<script type="text/javascript" src="js/custom.js"></script>

</body>

</html>