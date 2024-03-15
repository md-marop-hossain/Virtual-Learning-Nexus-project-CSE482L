<?php
  // Including the database connection file
  include('./dbConnection.php');

  // Including the header section from mainInclude
  include('./mainInclude/header.php'); 
?>

<div class="container-fluid bg-dark">
    <!-- Start Course Page Banner -->
    <div class="row">
        <!-- Displaying the course banner image -->
        <img src="./image/onlinepayment.png" alt="courses"
            style="height:400px; width:100%; object-fit:cover; box-shadow:10px;" />
    </div>
</div> <!-- End Course Page Banner -->

<div class="container mt-5">
    <!-- Start All Course -->
    <?php
          // Checking if a course_id is set in the URL
          if(isset($_GET['course_id'])){
           $course_id = $_GET['course_id'];
           // Setting the course_id in the session
           $_SESSION['course_id'] = $course_id;
           // Fetching course details based on course_id
           $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
           $result = $conn->query($sql);
           // Checking if there are any results
           if($result->num_rows > 0){ 
             // Displaying course details
             while($row = $result->fetch_assoc()){
               echo ' 
                <div class="row">
                  <div class="col-md-4">
                    <!-- Displaying course image -->
                    <img src="'.str_replace('..', '.', $row['course_img']).'" class="card-img-top" alt="Guitar" />
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">Course Name: '.$row['course_name'].'</h5>
                      <p class="card-text"> Description: '.$row['course_desc'].'</p>
                      <p class="card-text"> Duration: '.$row['course_duration'].'</p>
                      <!-- Form for course checkout -->
                      <form action="checkout.php" method="post">
                        <p class="card-text d-inline">Price: <small><del>&#65284 '.$row['course_original_price'].'</del></small> <span class="font-weight-bolder">&#65284 '.$row['course_price'].'<span></p>
                        <!-- Hidden input field to pass course price to checkout -->
                        <input type="hidden" name="id" value='. $row["course_price"] .'> 
                        <!-- Button to buy the course -->
                        <button type="submit" class="btn text-white font-weight-bolder float-right" style="background-color: #092737; color: white" name="buy">Buy Now</button>
                      </form>
                    </div>
                  </div>
                ';
             }
           }
         }
    ?>
</div><!-- End All Course -->

<div class="container">
    <div class="row">
        <?php 
          // Fetching all lessons from the database
          $sql = "SELECT * FROM lesson";
          $result = $conn->query($sql);
          // Checking if there are any lessons available
          if($result->num_rows > 0){
            echo '
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Lesson No.</th>
                    <th scope="col">Lesson Name</th>
                  </tr>
                </thead>
                <tbody>';
                $num = 0;
                // Displaying lesson details
                while($row = $result->fetch_assoc()){
                  if($row['course_id'] == $course_id) {
                    $num++;
                    echo ' <tr>
                      <th scope="row">'.$num.'</th>
                      <td>'. $row["lesson_name"].'</td></tr>';
                  }
                }
                echo '</tbody>
              </table>';
          } 
        ?>
    </div>
</div>

<?php 
  // Including the footer section from mainInclude 
  include('./mainInclude/footer.php'); 
?>