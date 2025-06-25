<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM bookings WHERE id = $id";

  if ($conn->query($sql)) {
    header("Location: manage_patients.php");
    exit;
  } else {
    echo "Failed to delete patient: " . $conn->error;
  }
} else {
  echo "No patient ID provided.";
}
?>
