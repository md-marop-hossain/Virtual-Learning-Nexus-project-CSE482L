<?php
include('./dbConnection.php');
// Header Include from mainInclude 
include('./mainInclude/header.php');
?>

<div class="container-fluid bg-dark">
    <!-- Start Course Page Banner -->
    <div class="row">
        <img src="./image/virtuallearning.jpg" alt="courses"
            style="height:500px; width:100%; object-fit:cover; box-shadow:10px;" />
    </div>
</div> <!-- End Course Page Banner -->

<div class="container mt-5">
    <!-- Start All Course -->
    <h1 class="text-center">All Courses</h1>
    <div class="row mt-4">
        <!-- Start All Course Row -->
        <?php
        // Pagination configuration
        $results_per_page = 6;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $start_from = ($page - 1) * $results_per_page;

        $sql = "SELECT * FROM course LIMIT $start_from, $results_per_page";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];
                echo '
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4">
                        <a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px;">
                            <div class="card">
                                <img src="' . str_replace('..', '.', $row['course_img']) . '" class="card-img-top" alt="Guitar" />
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['course_name'] . '</h5>
                                    <p class="card-text">' . $row['course_desc'] . '</p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text d-inline">Price: <small><del>&#65284; ' . $row['course_original_price'] . '</del></small> <span class="font-weight-bolder">&#65284; ' . $row['course_price'] . '<span></p> 
                                    <a class="btn text-white font-weight-bolder float-right" style="background-color: #092737; color: white" href="coursedetails.php?course_id=' . $course_id . '">Enroll</a>
                                </div>
                            </div> 
                        </a>
                    </div>
                ';
            }
        }
        ?>
    </div><!-- End All Course Row -->
</div><!-- End All Course -->

<!-- Pagination -->
<div class="container mt-3 mb-5">
    <ul class="pagination justify-content-center">
        <?php
        $sql = "SELECT COUNT(*) AS total FROM course";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $results_per_page);

        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
        }
        ?>
    </ul>
</div>

<?php
// Contact Us
include('./contact.php');
?>

<?php
// Footer Include from mainInclude 
include('./mainInclude/footer.php');
?>