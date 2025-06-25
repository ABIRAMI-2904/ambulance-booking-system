<?php
include 'db.php';
$id = $_GET['id'];

$conn->query("DELETE FROM ambulances WHERE id=$id");
header("Location: manage_ambulance.php");
exit;
?>
