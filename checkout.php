<?php 
include('./dbConnection.php');
session_start();
if(!isset($_SESSION['stuLogEmail'])) {
    echo "<script> location.href='loginorsignup.php'; </script>";
} else {
    $stuEmail = $_SESSION['stuLogEmail'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle form submission
        if(isset($_POST['ORDER_ID']) && isset($_POST['course_id']) && isset($_POST['course_price'])) {
            // Get form data
            $orderID = $_POST['ORDER_ID'];
            $courseID = $_POST['course_id'];
            $amount = $_POST['course_price'];
            // Generate current date
            $orderDate = date("Y-m-d");

            // Insert data into the database
            $sql = "INSERT INTO courseorder (order_id, stu_email, course_id, order_date, amount) 
                    VALUES ('$orderID', '$stuEmail', '$courseID', '$orderDate', '$amount')";
            $result = $conn->query($sql);

            if ($result) {
                echo "<script>alert('Order placed successfully');</script>";
            } else {
                echo "<script>alert('Failed to place order');</script>";
            }
        } else {
            // echo "<script>alert('Form fields are not set');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="GENERATOR" content="Evrsoft First Page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />

    <title>Checkout</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 jumbotron">
                <h3 class="mb-5">Welcome to E-Learning Payment Page</h3>
                <form id="checkoutForm" method="post" action="#">
                    <div class="form-group row">
                        <label for="ORDER_ID" class="col-sm-4 col-form-label">Order ID</label>
                        <div class="col-sm-8">
                            <input id="ORDER_ID" class="form-control" tabindex="1" maxlength="20" size="20"
                                name="ORDER_ID" autocomplete="off" value="<?php echo  "ORDS" . rand(10000,99999999)?>"
                                readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="student_email" class="col-sm-4 col-form-label">Student Email</label>
                        <div class="col-sm-8">
                            <input id="student_email" class="form-control" tabindex="2" maxlength="12" size="12"
                                name="student_email" autocomplete="off"
                                value="<?php if(isset($stuEmail)){echo $stuEmail; }?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course_price" class="col-sm-4 col-form-label">Amount</label>
                        <div class="col-sm-8">
                            <input title="course_price" class="form-control" tabindex="10" type="text"
                                name="course_price" value="<?php if(isset($_POST['id'])){echo $_POST['id']; }?>"
                                readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="course_id" class="col-sm-4 col-form-label">Course Id</label>
                        <div class="col-sm-8">
                            <input title="course_id" class="form-control" tabindex="10" type="text" name="course_id"
                                value="<?php if(isset($_POST['cid'])){echo $_POST['cid']; }?>" readonly>
                        </div>
                    </div>

                    <div class="text-center">
                        <input value="Check out" type="submit" class="btn btn-primary">
                        <a href="./courses.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
                <small class="form-text text-muted">Note: No Payment Integration Currently</small>
            </div>
        </div>
    </div>

    <!-- Jquery and Boostrap JavaScript -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- Font Awesome JS -->
    <script type="text/javascript" src="js/all.min.js"></script>
</body>

</html>

<?php } ?>