<?php
include 'db.php';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $model = $_POST['model'];
  $type = $_POST['type'];
  $number = $_POST['number'];
  $driver = $_POST['driver'];
  $contact = $_POST['contact'];
  $status = $_POST['status'];

  $sql = "UPDATE ambulances SET name='$name', model='$model', type='$type', number='$number',
          driver='$driver', contact='$contact', status='$status' WHERE id=$id";

  if ($conn->query($sql)) {
    header("Location: manage_ambulance.php");
    exit;
  } else {
    echo "Update failed: " . $conn->error;
  }
} else {
  $result = $conn->query("SELECT * FROM ambulances WHERE id=$id");
  $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Ambulance</title>
  <style>
    form { width: 400px; margin: 30px auto; padding: 20px; background: #f4f4f4; border-radius: 8px; }
    label { font-weight: bold; display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; margin-top: 5px; }
    button { background: #0d6efd; color: #fff; padding: 10px; margin-top: 15px; border: none; border-radius: 6px; }
  </style>
</head>
<body>
  <form method="post">
    <h2>Edit Ambulance</h2>
    <label>Name:</label><input type="text" name="name" value="<?= $row['name'] ?>" required>
    <label>Model:</label><input type="text" name="model" value="<?= $row['model'] ?>" required>
    <label>Type:</label><input type="text" name="type" value="<?= $row['type'] ?>" required>
    <label>Number:</label><input type="text" name="number" value="<?= $row['number'] ?>" required>
    <label>Driver:</label><input type="text" name="driver" value="<?= $row['driver'] ?>" required>
    <label>Contact:</label><input type="text" name="contact" value="<?= $row['contact'] ?>" required>
    <label>Status:</label>
    <select name="status" required>
      <option value="AVAILABLE" <?= $row['status'] == 'AVAILABLE' ? 'selected' : '' ?>>AVAILABLE</option>
      <option value="ON DUTY" <?= $row['status'] == 'ON DUTY' ? 'selected' : '' ?>>ON DUTY</option>
      <option value="OFFLINE" <?= $row['status'] == 'OFFLINE' ? 'selected' : '' ?>>OFFLINE</option>
    </select>
    <button type="submit">Update</button>
  </form>
</body>
</html>
