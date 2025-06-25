<?php
include 'db.php';

// Fetch all 3 types of requests
$approved = $conn->query("SELECT * FROM bookings WHERE status = 'APPROVED'");
$rejected = $conn->query("SELECT * FROM bookings WHERE status = 'REJECTED'");
$pending = $conn->query("SELECT * FROM bookings WHERE status = 'PENDING'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View All Requests - Admin</title>
  <link rel="stylesheet" href="ambulance_style.css">
</head>
<body>
  <div class="container">
    <h1>View All Requests</h1>

    <!-- ✅ Approved Requests -->
    <h2>✅ Approved Requests (<?php echo $approved->num_rows; ?>)</h2>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Patient Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Emergency Type</th>
            <th>Ambulance Type</th>
            <th>Pickup Date</th>
            <th>Pickup Time</th>
            <th>Pickup Location</th>
            <th>Drop Location</th>
            <th>Contact</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $approved->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['patient_name']; ?></td>
              <td><?php echo $row['gender']; ?></td>
              <td><?php echo $row['age']; ?></td>
              <td><?php echo $row['emergency_type']; ?></td>
              <td><?php echo $row['ambulance_type']; ?></td>
              <td><?php echo $row['pickup_date']; ?></td>
              <td><?php echo $row['pickup_time']; ?></td>
              <td><?php echo $row['pickup_location']; ?></td>
              <td><?php echo $row['drop_location']; ?></td>
              <td><?php echo $row['contact_number']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- ❌ Rejected Requests -->
    <h2>❌ Rejected Requests (<?php echo $rejected->num_rows; ?>)</h2>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Patient Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Emergency Type</th>
            <th>Ambulance Type</th>
            <th>Pickup Date</th>
            <th>Pickup Time</th>
            <th>Pickup Location</th>
            <th>Drop Location</th>
            <th>Contact</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $rejected->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['patient_name']; ?></td>
              <td><?php echo $row['gender']; ?></td>
              <td><?php echo $row['age']; ?></td>
              <td><?php echo $row['emergency_type']; ?></td>
              <td><?php echo $row['ambulance_type']; ?></td>
              <td><?php echo $row['pickup_date']; ?></td>
              <td><?php echo $row['pickup_time']; ?></td>
              <td><?php echo $row['pickup_location']; ?></td>
              <td><?php echo $row['drop_location']; ?></td>
              <td><?php echo $row['contact_number']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <!-- ⏳ Pending Requests -->
    <h2>⏳ Pending Requests (<?php echo $pending->num_rows; ?>)</h2>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Patient Name</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Emergency Type</th>
            <th>Ambulance Type</th>
            <th>Pickup Date</th>
            <th>Pickup Time</th>
            <th>Pickup Location</th>
            <th>Drop Location</th>
            <th>Contact</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $pending->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['patient_name']; ?></td>
              <td><?php echo $row['gender']; ?></td>
              <td><?php echo $row['age']; ?></td>
              <td><?php echo $row['emergency_type']; ?></td>
              <td><?php echo $row['ambulance_type']; ?></td>
              <td><?php echo $row['pickup_date']; ?></td>
              <td><?php echo $row['pickup_time']; ?></td>
              <td><?php echo $row['pickup_location']; ?></td>
              <td><?php echo $row['drop_location']; ?></td>
              <td><?php echo $row['contact_number']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
