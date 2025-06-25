<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $driver = $_POST['driver'];
  $number = $_POST['number'];
  $type = $_POST['type'];
  $model = $_POST['model'];
  $contact = $_POST['contact'];
  $status = $_POST['status'];

  $sql = "INSERT INTO ambulances (driver, number, type, model, contact, status)
          VALUES ('$driver', '$number', '$type', '$model', '$contact', '$status')";

  if ($conn->query($sql) === TRUE) {
    header("Location: manage_drivers.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
