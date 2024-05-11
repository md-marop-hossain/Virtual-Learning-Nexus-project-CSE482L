
// This function ensures that the DOM is fully loaded before executing any jQuery code
$(document).ready(function() {
  
  // Ajax Call for Email Verification
  $("#stuemail").on("keypress blur", function() {
    // Regular expression to validate email format
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var stuemail = $("#stuemail").val();
    
    // Ajax call to check if email already exists
    $.ajax({
      url: "student/addstudent.php",
      type: "post",
      data: {
        checkemail: "checkmail",
        stuemail: stuemail
      },
      success: function(data) {
        console.log(data);
        // Handling different cases based on the response
        if (data != 0) {
          $("#statusMsg2").html(
            '<small style="color:red;"> Email ID Already Registered ! </small>'
          );
          $("#signup").attr("disabled", true);
        } else if (data == 0 && reg.test(stuemail)) {
          $("#statusMsg2").html(
            '<small style="color:green;"> There you go ! </small>'
          );
          $("#signup").attr("disabled", false);
        } else if (!reg.test(stuemail)) {
          $("#statusMsg2").html(
            '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
          );
          $("#signup").attr("disabled", false);
        }
        if (stuemail == "") {
          $("#statusMsg2").html(
            '<small style="color:red;"> Please Enter Email ! </small>'
          );
        }
      }
    });
  });
  
  // Checking name on keypress
  $("#stuname").keypress(function() {
    var stuname = $("#stuname").val();
    if (stuname !== "") {
      $("#statusMsg1").html(" ");
    }
  });

  // Checking Password on keyup
  $("#stupass").keyup(function() {
    var stupass = $(this).val();
    if (stupass.length < 8 || stupass.length > 16) {
      $("#statusMsg3").html(
        '<small style="color:red;">Password must be between 8 to 16 characters.</small>'
      );
    } else {
      $("#statusMsg3").html("");
    }
  });
});

// Function to add a new student via Ajax
// Function to add a new student via Ajax
function addStu() {
  // Regular expression to validate email format
  var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
  var stuname = $("#stuname").val();
  var stuemail = $("#stuemail").val();
  var stupass = $("#stupass").val();
  
  // Checking fields on form submission
  if (stuname.trim() == "") {
    $("#statusMsg1").html(
      '<small style="color:red;"> Please Enter Name ! </small>'
    );
    $("#stuname").focus();
    return false;
  } else if (stuemail.trim() == "") {
    $("#statusMsg2").html(
      '<small style="color:red;"> Please Enter Email ! </small>'
    );
    $("#stuemail").focus();
    return false;
  } else if (stuemail.trim() != "" && !reg.test(stuemail)) {
    $("#statusMsg2").html(
      '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
    );
    $("#stuemail").focus();
    return false;
  } else if (stupass.trim() == "") {
    $("#statusMsg3").html(
      '<small style="color:red;"> Please Enter Password ! </small>'
    );
    $("#stupass").focus();
    return false;
  }
  else {
    // Ajax call to add new student
    $.ajax({
      url: "student/addstudent.php",
      type: "post",
      data: {
        stusignup: "stusignup",
        stuname: stuname,
        stuemail: stuemail,
        stupass: stupass
      },
      success: function(data) {
        console.log(data);
        if (data == "OK") {
          // Perform login after successful registration
          $.ajax({
            url: "student/addstudent.php", // Assuming this is the login endpoint
            type: "post",
            data: {
              checkLogemail: "checklogmail",
              stuLogEmail: stuemail,
              stuLogPass: stupass
            },
            success: function(data) {
              console.log(data);
              if (data == 1) {
                // Redirect after successful login
                window.location.href = "student/studentProfile.php";
              } else {
                // Handle login failure after registration
                console.log("Login failed after registration");
              }
            }
          });
        } else if (data == "Failed") {
          $("#successMsg").html(
            '<span class="alert alert-danger"> Unable to Register ! </span>'
          );
        }
      }
    });
  }
}


// Function to empty all fields and status messages of student registration form
function clearStuRegField() {
  $("#stuRegForm").trigger("reset");
  $("#statusMsg1").html(" ");
  $("#statusMsg2").html(" ");
  $("#statusMsg3").html(" ");
}

// Function to clear all status messages and fields of student registration form
function clearAllStuReg() {
  $("#successMsg").html(" ");
  clearStuRegField();
}

// Function to verify student login credentials via Ajax
function checkStuLogin() {
  var stuLogEmail = $("#stuLogEmail").val();
  var stuLogPass = $("#stuLogPass").val();
  // Ajax call to verify student login
  $.ajax({
    url: "student/addstudent.php",
    type: "post",
    data: {
      checkLogemail: "checklogmail",
      stuLogEmail: stuLogEmail,
      stuLogPass: stuLogPass
    },
    success: function(data) {
      console.log(data);
      if (data == 0) {
        $("#statusLogMsg").html(
          '<small class="alert alert-danger"> Invalid Email ID or Password ! </small>'
        );
      } else if (data == 1) {
        $("#statusLogMsg").html(
          '<div class="spinner-border text-success" role="status"></div>'
        );
        // Emptying login fields
        clearStuLoginField();
        // Redirecting after successful login
        setTimeout(() => {
          window.location.href = "student/studentProfile.php";
        }, 1000);
      }
    }
  });
}

// Function to clear student login fields
function clearStuLoginField() {
  $("#stuLoginForm").trigger("reset");
}

// Function to clear student login fields and status message
function clearStuLoginWithStatus() {
  $("#statusLogMsg").html(" ");
  clearStuLoginField();
}
