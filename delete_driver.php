<?php
include 'db.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM ambulances WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    header("Location: manage_drivers.php");
    exit();
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}
?>
