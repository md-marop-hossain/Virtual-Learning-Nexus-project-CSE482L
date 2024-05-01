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
    <!-- Search Form -->
    <div class="row justify-content-center">
        <form method="GET" action="" class="form-inline">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search courses..."
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Start All Course -->
    <h1 class="text-center mt-5">All Courses</h1>
    <div class="row mt-4">
        <!-- Start All Course Row -->
        <?php
        // Pagination configuration
        $results_per_page = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start_from = ($page - 1) * $results_per_page;

        // Get search term
        $search_term = isset($_GET['search']) ? $_GET['search'] : '';

        // Modify SQL query based on search term
        if ($search_term != '') {
            $sql = "SELECT * FROM course WHERE course_name LIKE ? OR course_desc LIKE ? LIMIT ?, ?";
            $stmt = $conn->prepare($sql);
            $like_term = '%' . $search_term . '%';
            $stmt->bind_param("ssii", $like_term, $like_term, $start_from, $results_per_page);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT * FROM course LIMIT ?, ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $start_from, $results_per_page);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        // Display course results
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
        } else {
            echo '<div class="col-12 text-center"><h3>No courses found.</h3></div>';
        }
        ?>
    </div><!-- End All Course Row -->
</div><!-- End All Course -->

<!-- Pagination -->
<div class="container mt-3 mb-5">
    <ul class="pagination justify-content-center">
        <?php
        // Get total course count for pagination
        if ($search_term != '') {
            $sql = "SELECT COUNT(*) AS total FROM course WHERE course_name LIKE ? OR course_desc LIKE ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $like_term, $like_term);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT COUNT(*) AS total FROM course";
            $result = $conn->query($sql);
        }

        $row = $result->fetch_assoc();
        $total_pages = ceil($row["total"] / $results_per_page);

        // Pagination links
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $page) ? ' active' : '';
            $query_params = http_build_query(array_merge($_GET, ["page" => $i]));
            echo "<li class='page-item$active_class'><a class='page-link' href='?$query_params'>" . $i . "</a></li>";
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