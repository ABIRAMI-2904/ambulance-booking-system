<?php
include 'db.php';

$sql = "SELECT * FROM bookings WHERE status = 'APPROVED'";
$result = $conn->query($sql);
$total = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Approved Requests</title>
  <link rel="stylesheet" href="ambulance_style.css">
</head>
<body>
  <div class="container">
    <h1>Total Approved Requests: <span><?php echo $total; ?></span></h1>
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
            <th>Contact Number</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
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
