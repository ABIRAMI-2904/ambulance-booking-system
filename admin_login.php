<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ambulance_booking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get login form input
$admin_user = $_POST['username'];
$admin_pass = $_POST['password'];

// Check username and password directly (no hashing)
$sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $admin_user, $admin_pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $_SESSION['admin'] = $admin_user;
  echo "<script>alert('Login successful'); window.location.href='admindash.php';</script>";
} else {
  echo "<script>alert('Invalid username or password'); window.location.href='admin.html';</script>";
}

$stmt->close();
$conn->close();
?>
