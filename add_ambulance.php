<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $model = $_POST['model'];
  $type = $_POST['type'];
  $number = $_POST['number'];
  $driver = $_POST['driver'];
  $contact = $_POST['contact'];
  $status = $_POST['status'];

  $sql = "INSERT INTO ambulances (name, model, type, number, driver, contact, status)
          VALUES ('$name', '$model', '$type', '$number', '$driver', '$contact', '$status')";

  if ($conn->query($sql)) {
    header("Location: manage_ambulance.php");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
