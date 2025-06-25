<?php
include 'db.php';

// Fetch only ON DUTY drivers from ambulance table
$sql = "SELECT driver, contact, name AS ambulance_name, type, number FROM ambulances WHERE status = 'ON DUTY'";
$result = $conn->query($sql);

// Get total on-duty driver count
$total = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Drivers On Duty</title>
  <link rel="stylesheet" href="driver_style.css" />
</head>
<body>
  <div class="container">
    <h1>Total Drivers On Duty: <span><?php echo $total; ?></span></h1>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Driver Name</th>
            <th>Contact</th>
            <th>Ambulance Name</th>
            <th>Ambulance Type</th>
            <th>Ambulance Number</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['driver']; ?></td>
              <td><?php echo $row['contact']; ?></td>
              <td><?php echo $row['ambulance_name']; ?></td>
              <td><?php echo $row['type']; ?></td>
              <td><?php echo $row['number']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
