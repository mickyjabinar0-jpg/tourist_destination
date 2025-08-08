<?php
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "tourismdestination_db";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Fetch data
$carousel_sql = "SELECT * FROM carousel_ft_tb ORDER BY cft_id";
$carousel_result = $conn->query($carousel_sql);

$hero_sql = "SELECT * FROM hero_ft_tb ORDER BY hft_id";
$hero_result = $conn->query($hero_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Admin | Home Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Bootstrap + DataTables -->
        <link href="https://getbootstrap.com/docs/4.6/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap4.css" rel="stylesheet">
         <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
    body, html {
    margin: 0;
    padding: 0;
    height: 100%;
    width: 100%;
}

.sidebar {
    width: 320px;
    background-color: #fb6f92;
    color: white;
    padding: 1rem;
    min-height: 100vh;
    flex-shrink: 0;
    position: sticky;
    top: 0;
}
.sidebar h4 {
    text-align: center;
}

.sidebar strong {
    color: hotpink;
    display: block;
    margin-top: 1rem;
}

.sidebar a {
    color: white;
    text-decoration: none;
    display: block;
    padding: 0.5rem;
    margin-bottom: 0.25rem;
    border-radius: 4px;
}

.sidebar a:hover {
    background-color: white;
    color: black;
}

.content {
    background-color: #fff;
    min-height: 100vh;
    overflow-x: auto;
}


.auto-resize {
    min-height: 100px;
    overflow-y: hidden;
    resize: none;
}

    </style>
</head>
<body>

<div class="d-flex w-100">
   <div class="sidebar">
        <h4>Tourism Destination</h4>
        <hr>
        <strong>MAIN</strong>
        <a class="active" href="admin_dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="admin_inquiry.php"><i class="fa-solid fa-message"></i> Inquiry</a>
        <hr>
        <strong>PAGES</strong>
        <a  href="homepage.php"><i class="fa-solid fa-file"></i> Home</a>
        <a href="#"><i class="fa-solid fa-file"></i> Services</a>
        <a href="#"><i class="fa-solid fa-file"></i> Contact</a>
        <a href="#"><i class="fa-solid fa-file"></i> Search</a>
         
			<li class="nav-item text-nowrap">
			<a class="nav-link" href="login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Sign out</a>
			</li>
		</ul>
    </div>


<main class="content flex-grow-1 p-4">
      <h2>Manage Home Page</h2>

    <!-- Carousel Section -->
    <div class="table-responsive mt-4">
        <h4>Featured Carousel</h4>
        <table class="table table-bordered" id="carouselTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image & Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($carousel_result->num_rows > 0): ?>
                    <?php while ($row = $carousel_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['cft_id']) ?></td>
                            <td>
                                <img src="<?= htmlspecialchars($row['cft_imgLink']) ?>" alt="Image" style="width:60px; height:60px; object-fit:cover;">
                                <strong><?= htmlspecialchars($row['cft_name']) ?></strong>
                            </td>
                            <td><?= nl2br(htmlspecialchars($row['cft_desc'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#update<?= $row['cft_id'] ?>">Edit</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="update<?= $row['cft_id'] ?>" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="../form/process_data.php?page=home" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Carousel Featured</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= htmlspecialchars($row['cft_imgLink']) ?>" width="100%" class="mb-3" alt="Current Image">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input class="form-control" type="text" name="name" value="<?= htmlspecialchars($row['cft_name']) ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea class="form-control auto-resize" name="desc"><?= htmlspecialchars($row['cft_desc']) ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Online Image Link:</label>
                                                <input class="form-control" type="text" name="changeImageLink">
                                            </div>
                                            <div class="form-group">
                                                <label>Upload Local Image:</label>
                                                <input class="form-control" type="file" name="changeImage">
                                            </div>
                                            <div class="form-group">
                                                <label>More Button Link:</label>
                                                <input class="form-control" type="text" name="moreLink">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['cft_id']) ?>">
                                            <button type="submit" class="btn btn-success btn-sm" name="updateDestination">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


    <!-- Hero Featured Section -->
    <div class="table-responsive mt-5">
        <h4>Hero Featured Destination</h4>
        <table class="table table-bordered" id="heroTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($hero_result && $hero_result->num_rows > 0): ?>
                    <?php while ($row = $hero_result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['hft_id']) ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="<?= htmlspecialchars($row['hft_img']) ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:5px;margin-right:10px;">
                                    <?= htmlspecialchars($row['hft_title']) ?>
                                </div>
                            </td>
                            <td><?= nl2br(htmlspecialchars($row['hft_desc'])) ?></td>
                            <td>
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#updateHero<?= $row['hft_id'] ?>">Edit</button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="updateHero<?= $row['hft_id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="process_data.php?page=home" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Hero Featured</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= htmlspecialchars($row['hft_img']) ?>" class="w-100 mb-3" alt="Current Image">
                                            <div class="form-group">
                                                <label>Name:</label>
                                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($row['hft_title']) ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <textarea name="desc" class="form-control auto-resize" required><?= htmlspecialchars($row['hft_desc']) ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Online Image Link:</label>
                                                <input type="url" name="changeImageLink" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Upload Local Image:</label>
                                                <input type="file" name="changeImage" class="form-control-file">
                                            </div>
                                            <div class="form-group">
                                                <label>More Button Link:</label>
                                                <input type="url" name="moreLink" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['hft_id']) ?>">
                                            <button type="submit" name="updateDestination" class="btn btn-success btn-sm">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No hero records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
</main>
</div>


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
        $('#carouselTable, #heroTable').DataTable();
    });
</script>
</body>
</html>

<?php $conn->close(); ?>
