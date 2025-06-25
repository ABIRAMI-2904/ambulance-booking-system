<?php
include 'db.php';

if (!isset($_GET['id'])) {
  header("Location: manage_drivers.php");
  exit();
}

$id = $_GET['id'];

// Handle update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $driver = $_POST['driver'];
  $number = $_POST['number'];
  $type = $_POST['type'];
  $model = $_POST['model'];
  $contact = $_POST['contact'];
  $status = $_POST['status'];

  $sql = "UPDATE ambulances 
          SET driver='$driver', number='$number', type='$type', model='$model',
              contact='$contact', status='$status'
          WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    header("Location: manage_drivers.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}

// Get current values
$sql = "SELECT * FROM ambulances WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Driver</title>
  <link rel="stylesheet" href="ambulance_style.css">
  <style>
    .form-container {
      width: 400px; margin: 50px auto; background: #f8f8f8;
      padding: 20px; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }
    form label { display: block; margin-top: 10px; font-weight: bold; }
    form input, form select {
      width: 100%; padding: 10px; margin-top: 5px;
      border: 1px solid #ccc; border-radius: 5px;
    }
    button {
      margin-top: 15px; padding: 10px 20px;
      background: #2c4770; color: #fff;
      border: none; border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>
<body>
<div class="form-container">
  <h2>Edit Driver</h2>
  <form method="POST">
    <label>Driver Name:</label>
    <input type="text" name="driver" value="<?php echo $row['driver']; ?>" required>

    <label>Ambulance Number:</label>
    <input type="text" name="number" value="<?php echo $row['number']; ?>" required>

    <label>Ambulance Type:</label>
    <input type="text" name="type" value="<?php echo $row['type']; ?>" required>

    <label>Model:</label>
    <input type="text" name="model" value="<?php echo $row['model']; ?>" required>

    <label>Contact:</label>
    <input type="text" name="contact" value="<?php echo $row['contact']; ?>" required>

    <label>Status:</label>
    <select name="status" required>
      <option value="">-- Select --</option>
      <option value="ON DUTY" <?php if($row['status']=='ON DUTY') echo 'selected'; ?>>ON DUTY</option>
      <option value="OFF DUTY" <?php if($row['status']=='OFF DUTY') echo 'selected'; ?>>OFF DUTY</option>
    </select>

    <button type="submit">Update</button>
  </form>
</div>
</body>
</html>
