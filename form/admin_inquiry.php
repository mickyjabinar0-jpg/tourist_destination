<?php
session_start();

$conn = new mysqli("localhost", "root", "", "tourismdestination_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$messageData = null;
if (isset($_GET['msg_id'])) {
    $msg_id = intval($_GET['msg_id']);
    $stmt = $conn->prepare("SELECT * FROM touristdestination_db WHERE id = ?");
    $stmt->bind_param("i", $msg_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $messageData = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Leyte/OTHERcountriesTD | Admin</title>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/9638/9638452.png" />
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 320px;
            background-color:#fb6f92;
            color: white;
            padding: 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 0.25rem;
            padding: 0.5rem;
            border-radius: 4px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #495057;
            color: white;
            font-weight: bold;
        }

        main {
            margin-left: 320px;
            padding: 1rem;
            height: 100vh;
            overflow-y: auto;
            flex-grow: 1;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4 class="text-center">Tourism Destination</h4>
    <hr>
    <strong>MAIN</strong>
    <a href="admin_dashboard.php?page=admin_dashboard"><i class="fa-solid fa-house"></i> Dashboard</a>
    <a class="active" href="admin_inquiry.php"><i class="fa-solid fa-message"></i> Inquiry</a>
    <hr>
    <strong>PAGES</strong>
    <a href="homepage.php?page=homepage"><i class="fa-solid fa-file"></i> Home</a>
    <a href="#"><i class="fa-solid fa-file"></i> Services</a>
    <a href="#"><i class="fa-solid fa-file"></i> Contact</a>
    <a class="nav-link" href="login.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out</a>
</div>

<main>
    <h2>Welcome <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?>!</h2>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success">Inquiry deleted successfully.</div>
    <?php endif; ?>

    <div class="mt-4 mb-3"><h3>Inquiries / Messages</h3></div>

    <div class="table-responsive">
        <table id="inquiryTable" class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM touristdestination_db ORDER BY id DESC";
                    $result = $conn->query($sql);
                    $counter = 1;

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='text-center'>";
                            echo "<td>" . $counter++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>
                                    <a href='admin_inquiry.php?msg_id=" . urlencode($row['id']) . "' class='btn btn-info btn-sm'>
                                        <i class='bi bi-eye'></i>
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No inquiries found.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php if ($messageData): ?>
<!-- Modal for Viewing Message -->
<div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="viewMessageLabel">From: <?= htmlspecialchars($messageData['name']) ?></h5>
        <a href="admin_inquiry.php" class="btn-close" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        <p><strong>Email:</strong> <?= htmlspecialchars($messageData['email']) ?></p>
        <p><strong>Contact Number:</strong> <?= htmlspecialchars($messageData['contact_number']) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($messageData['user_date']) ?></p>
        <hr>
        <p style="white-space: pre-line;"><?= nl2br(htmlspecialchars($messageData['message'])) ?></p>
      </div>
      <div class="modal-footer">
        <a href="admin_inquiry.php" class="btn btn-secondary">Close</a>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $('#inquiryTable').DataTable({
        pagingType: 'simple_numbers',
        lengthChange: false,
        pageLength: 10,
        info: false,
        searching: true,
        order: [[0, 'asc']]
    });

    // Auto-show the message modal if messageData is available
    <?php if ($messageData): ?>
        var messageModal = new bootstrap.Modal(document.getElementById('viewMessageModal'));
        messageModal.show();
    <?php endif; ?>
});
</script>
</body>
</html>
