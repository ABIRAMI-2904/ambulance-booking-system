<?php
include 'db.php';

echo "Form submitted!<br>"; // ✅ Add this for debugging

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $action = $_POST['action'];

  echo "ID: $id | Action: $action<br>"; // ✅ Print values

  $status = ($action === 'accept') ? 'APPROVED' : 'REJECTED';

  $sql = "UPDATE bookings SET status = '$status' WHERE id = $id";

  if ($conn->query($sql)) {
    echo "Status updated successfully.";
    header("Location: admindash.php");
    exit;
  } else {
    echo "Error updating status: " . $conn->error;
  }
} else {
  echo "Form not submitted via POST.";
}
?>
