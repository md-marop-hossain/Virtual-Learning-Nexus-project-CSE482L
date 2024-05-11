<?php
include('./dbConnection.php'); // Make sure to include the correct database connection file
// session_start();

// Check if the session variable is set
if (isset($_SESSION['stuLogEmail'])) {
    $stuEmail = $_SESSION['stuLogEmail'];

    // Prepare the SQL query to fetch the student's name
    $sql = "SELECT stu_name FROM student WHERE stu_email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $stuEmail); // Bind the email parameter to the query
    $stmt->execute(); // Execute the query

    // Fetch the result
    $result = $stmt->get_result();
    // $stuName = "Unknown"; // Default value in case no result is found

    if ($row = $result->fetch_assoc()) {
        $stuName = $row['stu_name']; // Get the student's name
    }

    $stmt->close(); // Close the statement

    // Now you can use $stuName as required
} else {
    // Handle the case where the session variable is not set or the session has been destroyed
    // You can provide default values or handle it according to your application's logic
    $stuEmail = ""; // or any default value
    $stuName = ""; // or any default value
}

?>


<!-- Start of Contact Us section -->
<div class="container mt-4" id="Contact">
    <!-- Start of Contact Us Container -->
    <h2 class="text-center mb-4">Contact US</h2> <!-- Heading for Contact Us -->
    <div class="row">
        <!-- Start of Contact Us Row -->
        <div class="col-md-8">
            <!-- Start of 1st Column for Contact Us Form -->
            <form id="contact" action="mail.php" method="post" onsubmit="return validateForm()">
                <div class="mb-3 mt-3">
                    <!-- <label for="name">Name:</label> -->
                    <input type="text" class="form-control" id="name" name="name"
                        <?php if(empty($stuName)) { echo 'placeholder="Please sign in to Show your Name"'; } else { echo 'value="' . $stuName . '" readonly'; } ?>
                        readonly>
                </div>

                <div class="mb-3 mt-3">
                    <!-- <label for="email">Email:</label> -->
                    <input type="email" class="form-control" id="email" name="email"
                        <?php if(empty($stuEmail)) { echo 'placeholder="Please sign in to Show your Email"'; } else { echo 'value="' . htmlspecialchars($stuEmail) . '" readonly'; } ?>
                        readonly>
                </div>

                <input class="form-control" placeholder="Type your subject line" type="text" name="subject"
                    tabindex="4"><br>
                <!-- Input field for Email -->
                <textarea class="form-control" name="message" placeholder="How can we help you?" style="height:150px;"
                    tabindex="5"></textarea><br> <!-- Textarea for Message -->
                <input class="btn" style="background-color: #092737; color: white" type="submit" name="send"
                    id="contact-submit"><br><br> <!-- Submit Button -->
            </form>
        </div> <!-- End of 1st Column for Contact Us Form -->

        <div class="col-md-4 stripe text-white text-center"
            style="background-image: linear-gradient(240deg, #130c0d, #17a2b8) !important;">
            <!-- Start of 2nd Column for Contact Information -->
            <h4>Virtual Learning Nexus</h4> <!-- Title for Contact Information -->
            <p>Virtual Learning Nexus,
                <!-- Address Information -->
                123 Main Street,
                CityVille,
                State - 12345<br />
                Phone: +123456789 <br /> <!-- Phone Number -->
                www.VirtualLearningNexus.com
            </p> <!-- Website URL -->

        </div> <!-- End of 2nd Column for Contact Information -->
    </div> <!-- End of Contact Us Row -->
</div> <!-- End of Contact Us Container -->
<!-- End of Contact Us section -->