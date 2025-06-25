<?php
$conn = new mysqli("localhost", "root", "", "ambulance_booking");
if ($conn->connect_error) die("Connection failed");

$stmt = $conn->prepare("UPDATE ambulances SET name=?, model=?, type=?, number=?, driver=?, contact=?, status=? WHERE id=?");
$stmt->bind_param("sssssssi", $_POST['name'], $_POST['model'], $_POST['type'], $_POST['number'], $_POST['driver'], $_POST['contact'], $_POST['status'], $_POST['id']);
$stmt->execute();

header("Location: manage_ambulance.html");
?>
