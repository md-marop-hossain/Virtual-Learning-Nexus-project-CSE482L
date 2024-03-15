<!-- 
This is an HTML form for student registration.
-->
<form role="form" id="stuRegForm">
    <!-- Name input field -->
    <div class="form-group">
        <!-- Icon for name input -->
        <i class="fas fa-user"></i>
        <!-- Label for name input -->
        <label for="stuname" class="pl-2 font-weight-bold">Name</label>
        <!-- Placeholder for name input -->
        <small id="statusMsg1"></small>
        <!-- Text input field for name -->
        <input type="text" class="form-control" placeholder="Name" name="stuname" id="stuname">
    </div>
    <!-- Email input field -->
    <div class="form-group">
        <!-- Icon for email input -->
        <i class="fas fa-envelope"></i>
        <!-- Label for email input -->
        <label for="stuemail" class="pl-2 font-weight-bold">Email</label>
        <!-- Placeholder for email input -->
        <small id="statusMsg2"></small>
        <!-- Text input field for email -->
        <input type="email" class="form-control" placeholder="Email" name="stuemail" id="stuemail">
        <!-- Note about email sharing -->
        <small class="form-text">We'll never share your email with anyone else.</small>
    </div>
    <!-- Password input field -->
    <div class="form-group">
        <!-- Icon for password input -->
        <i class="fas fa-key"></i>
        <!-- Label for password input -->
        <label for="stupass" class="pl-2 font-weight-bold">New Password</label>
        <!-- Placeholder for password input -->
        <small id="statusMsg3"></small>
        <!-- Password input field -->
        <input type="password" class="form-control" placeholder="Password" name="stupass" id="stupass">
    </div>
</form>