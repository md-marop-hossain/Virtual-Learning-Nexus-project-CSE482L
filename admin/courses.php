<?php
if (!isset($_SESSION)) {
  session_start();
}

define('TITLE', 'Courses');
define('PAGE', 'courses');
include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
  $adminEmail = $_SESSION['adminLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-9 mt-5">
    <!-- Table -->
    <p class="bg-dark text-white p-2">List of Courses</p>
    <?php
      // Query to get courses in descending order by course_id
      $sql = "SELECT * FROM course ORDER BY course_id DESC"; // Adjusted query
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        echo '<table class="table">';
        echo '<thead>';
        echo '  <tr>';
        echo '    <th scope="col">Course ID</th>';
        echo '    <th scope="col">Name</th>';
        echo '    <th scope="col">Author</th>';
        echo '    <th scope="col">Action</th>';
        echo '  </tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop through and display courses
        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<th scope="row">' . $row["course_id"] . '</th>';
          echo '<td>' . $row["course_name"] . '</td>';
          echo '<td>' . $row["course_author"] . '</td>';
          echo '<td>';
          echo '  <form action="editcourse.php" method="POST" class="d-inline">';
          echo '    <input type="hidden" name="id" value=' . $row["course_id"] . '>';
          echo '    <button type="submit" class="btn btn-info mr-3" name="view" value="View"><i class="fas fa-pen"></i></button>';
          echo '  </form>';
          echo '  <form action="" method="POST" class="d-inline">';
          echo '    <input type="hidden" name="id" value=' . $row["course_id"] . '>';
          echo '    <button type="submit" class="btn btn-secondary" name="delete" value="Delete"><i class="far fa-trash-alt"></i></button>';
          echo '  </form>';
          echo '</td>';
          echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
      } else {
        echo "No Courses Available";
      }

      // Handle delete requests
      if (isset($_REQUEST['delete'])) {
        $sql = "DELETE FROM course WHERE course_id = {$_REQUEST['id']}";
        if ($conn->query($sql) === TRUE) {
          echo '<meta http-equiv="refresh" content= "0;URL=?deleted" />';
        } else {
          echo "Unable to Delete Data";
        }
      }
    ?>
</div>

<div>
    <a class="btn btn-danger box" href="./addCourse.php"><i class="fas fa-plus fa-2x"></i></a>
</div>

<?php
include('./adminInclude/footer.php');
?>