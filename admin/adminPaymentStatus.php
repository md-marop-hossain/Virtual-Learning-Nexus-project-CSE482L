<?php
  define('TITLE', 'Payment Status');
  define('PAGE', 'paymentstatus');
  include('./adminInclude/header.php'); 
  include('../dbConnection.php');

	$ORDER_ID = "";


	if (isset($_POST["ORDER_ID"]) && $_POST["ORDER_ID"] != "") {

		// In Test Page, we are taking parameters from POST request. In actual implementation these can be collected from session or DB. 
		$ORDER_ID = $_POST["ORDER_ID"];

	} 

?>
<div class="container">
    <h2 class="text-center my-4">Payment Status </h2>
    <form method="post" action="">
        <div class="form-group row">
            <label class="offset-sm-3 col-form-label">Order ID: </label>
            <div>
                <input class="form-control mx-3" id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID"
                    autocomplete="off" value="<?php echo $ORDER_ID ?>">
            </div>
            <div>
                <input class="btn btn-success mx-4" value="View" type="submit">
            </div>
        </div>
    </form>
</div>

<div class="container">
    <?php
    if ($ORDER_ID != "") {
      $sql = "SELECT order_id, stu_email, course_id, amount, order_date, status, TXNID FROM courseorder WHERE order_id = '$ORDER_ID'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
  ?>
    <div class="row justify-content-center">
        <div class="col-auto">
            <h2 class="text-center">Payment Receipt</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><label>Order ID</label></td>
                        <td><?php echo $row['order_id']; ?></td>
                    </tr>
                    <tr>
                        <td><label>Student Email</label></td>
                        <td><?php echo $row['stu_email']; ?></td>
                    </tr>
                    <tr>
                        <td><label>Course Id</label></td>
                        <td><?php echo $row['course_id']; ?></td>
                    </tr>
                    <tr>
                        <td><label>Course Price</label></td>
                        <td><?php echo $row['amount']; ?></td>
                    </tr>
                    <tr>
                        <td><label>Order Date</label></td>
                        <td><?php echo $row['order_date']; ?></td>
                    </tr>
                    <tr>
                        <td><label>Payment Status</label></td>
                        <td><?php echo $row['status']; ?></td>
                    </tr>
                    <tr>
                        <td><label>TXNID</label></td>
                        <td><?php echo $row['TXNID']; ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><button class="btn btn-primary" onclick="javascript:window.print();">Print Receipt</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
          }
        }
  ?>
        </div>
    </div>
</div>

<?php
  include('./adminInclude/footer.php'); 
?>