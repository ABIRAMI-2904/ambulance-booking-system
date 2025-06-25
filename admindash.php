<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "ambulance_booking";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Count queries
$ambulanceCount = $conn->query("SELECT COUNT(*) as total FROM ambulances")->fetch_assoc()['total'];
$onDutyDriverCount = $conn->query("SELECT COUNT(*) as total FROM ambulances WHERE status = 'ON DUTY'")->fetch_assoc()['total'];
$newRequestCount = $conn->query("SELECT COUNT(*) as pending FROM bookings WHERE status = 'PENDING'")->fetch_assoc()['pending'];
$approvedRequestCount = $conn->query("SELECT COUNT(*) as approved FROM bookings WHERE status = 'APPROVED'")->fetch_assoc()['approved'];
$rejectedRequestCount = $conn->query("SELECT COUNT(*) as rejected FROM bookings WHERE status = 'REJECTED'")->fetch_assoc()['rejected'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - RapidRescue</title>
  <link rel="stylesheet" href="admindashstyle.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@1,700&display=swap" rel="stylesheet">
  <style>
    .modal-content {
      max-height: 80vh;
      overflow-y: auto;
    }
    .request-box {
      padding: 10px;
      margin-bottom: 15px;
      background-color: #f9f9f9;
      border-left: 5px solid #2c4770;
    }
    .request-box p {
      margin: 6px 0;
    }
    .action-form {
      margin-top: 10px;
      display: flex;
      gap: 10px;
    }
    .action-form button {
      padding: 8px 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: 600;
    }
    .accept {
      background-color: #27ae60;
      color: white;
    }
    .reject {
      background-color: #e74c3c;
      color: white;
    }
    /* Fix for dropdown menu */
.admin-dropdown {
  position: relative;
}

.dropdown-content {
  display: none;
  position: absolute;
  top: 45px;
  right: 0;
  background-color: white;
  min-width: 160px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.2);
  z-index: 1000;
  border-radius: 6px;
  overflow: hidden;
}

.dropdown-content a {
  color: #333;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

/* This is the key missing part */
.dropdown-content.show {
  display: block;
}
.dashboard-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  row-gap: 170px;
  padding: 70px;
  max-width: 1200px;
  margin: auto;
  box-sizing: border-box;
}

.dashboard-tile {
  background-color: #f5f5f5;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  text-align: center;
}

.dashboard-tile h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.dashboard-tile .count {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 15px;
}

.view-btn {
  padding: 8px 16px;
  background-color: #2c4770;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
}

.view-btn:hover {
  background-color: #1e3454;
}

  </style>
</head>
<body>
  <header class="admin-header">
    <div class="left-section">
      <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
      <span class="admin-title">ADMIN</span>
    </div>
    <div class="right-section">
      <div class="admin-dropdown">
  <button onclick="toggleDropdown()" class="admin-btn">
    <img src="svg-repo/user-profile-circle-solid-svgrepo-com.svg" alt="Admin Icon">
    Admin123 <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-content" id="dropdown">
    <a href="edit_admin.php">Edit Profile</a>
    <a href="index.html">Logout</a>
  </div>
</div>

    </div>
  </header>

  <div class="sidebar" id="sidebar">
    <ul class="sidebar-menu">
      <li><a href="admindash.php"><img src="svg-repo/dashboard-svgrepo-com.svg"> Dashboard</a></li>
      <li><a href="manage_ambulance.php"><img src="svg-repo/ambulance-4-svgrepo-com.svg"> Manage Ambulance</a></li>
      <li><a href="manage_drivers.php"><img src="svg-repo/driver-svgrepo-com.svg"> Manage Drivers</a></li>
      <li><a href="view_request.php"><img src="svg-repo/view-alt-1-svgrepo-com.svg"> View Requests</a></li>
      <li><a href="manage_patients.php"><img src="svg-repo/patient-bed-hospital-svgrepo-com.svg"> Manage Patients</a></li>
    </ul>
  </div>
<main class="dashboard-grid">
  <div class="dashboard-tile">
    <h3>Total Ambulances Available</h3>
    <p class="count"><?php echo $ambulanceCount; ?></p>
    <a href="view_ambulances.php" class="view-btn">View Details</a>
  </div>
  <div class="dashboard-tile">
    <h3>New Requests</h3>
    <p class="count"><?php echo $newRequestCount; ?></p>
    <button class="view-btn" onclick="openRequestModal()">View Details</button>
  </div>
  <div class="dashboard-tile">
    <h3>Rejected Requests</h3>
    <p class="count"><?php echo $rejectedRequestCount; ?></p>
    <a href="view_rejected.php" class="view-btn">View Details</a>
  </div>
  <div class="dashboard-tile">
    <h3>Approved Request</h3>
    <p class="count"><?php echo $approvedRequestCount; ?></p>
    <a href="view_approved.php" class="view-btn">View Details</a>
  </div>
  <div class="dashboard-tile">
    <h3>Drivers On Duty</h3>
    <p class="count"><?php echo $onDutyDriverCount; ?></p>
    <a href="view_drivers.php" class="view-btn">View Details</a>
  </div>
  <div class="dashboard-tile">
    <h3>Rejected Requests</h3>
    <p class="count"><?php echo $rejectedRequestCount; ?></p>
    <a href="view_rejected.php" class="view-btn">View Details</a>
  </div>
</main>

  <div id="requestModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeRequestModal()">&times;</span>
      <h2>NEW REQUESTS</h2>
      <?php
      $pending_sql = "SELECT * FROM bookings WHERE status = 'PENDING'";
      $pending_result = $conn->query($pending_sql);
      if ($pending_result && $pending_result->num_rows > 0) {
        while($row = $pending_result->fetch_assoc()) {
      ?>
        <div class="request-box">
          <p><strong>Patient Name:</strong> <?php echo $row['patient_name']; ?></p>
          <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
          <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
          <p><strong>DOB:</strong> <?php echo $row['dob']; ?></p>
          <p><strong>Emergency Type:</strong> <?php echo $row['emergency_type']; ?></p>
          <p><strong>Relative Name:</strong> <?php echo $row['relative_name']; ?></p>
          <p><strong>Relationship:</strong> <?php echo $row['relationship']; ?></p>
          <p><strong>Contact:</strong> <?php echo $row['contact_number']; ?></p>
          <p><strong>Ambulance Type:</strong> <?php echo $row['ambulance_type']; ?></p>
          <p><strong>Pickup Date:</strong> <?php echo $row['pickup_date']; ?></p>
          <p><strong>Pickup Time:</strong> <?php echo $row['pickup_time']; ?></p>
          <p><strong>Pickup Location:</strong> <?php echo $row['pickup_location']; ?></p>
          <p><strong>Drop Location:</strong> <?php echo $row['drop_location']; ?></p>
          <form method="post" action="handle_request.php" class="action-form">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" name="action" value="accept" class="accept">Accept</button>
            <button type="submit" name="action" value="reject" class="reject">Reject</button>
          </form>
        </div>
      <?php }} else { echo "<p>No new requests.</p>"; } ?>
    </div>
  </div>

<script>
  function toggleSidebar() {
    document.getElementById("sidebar").classList.toggle("sidebar-open");
  }
  function toggleDropdown() {
    document.getElementById("dropdown").classList.toggle("show");
  }
  function openRequestModal() {
    document.getElementById("requestModal").style.display = "block";
  }
  function closeRequestModal() {
    document.getElementById("requestModal").style.display = "none";
  }
  window.onclick = function(event) {
    const modal = document.getElementById("requestModal");
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
</script>
</body>
</html>
