<?php
include 'db.php';

// Fetch data from database
$sql = "SELECT * FROM ambulances";
$result = $conn->query($sql);

// Get total count
$total = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Total Ambulances Available</title>
  <link rel="stylesheet" href="ambulance_style.css" />
</head>
<body>
  <div class="container">
    <h1>Total Number of Ambulance Available: <span><?php echo $total; ?></span></h1>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Model</th>
            <th>Type</th>
            <th>Number</th>
            <th>Driver</th>
            <th>Contact</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['model']; ?></td>
              <td><?php echo $row['type']; ?></td>
              <td><?php echo $row['number']; ?></td>
              <td><?php echo $row['driver']; ?></td>
              <td><?php echo $row['contact']; ?></td>
              <td><?php echo $row['status']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
