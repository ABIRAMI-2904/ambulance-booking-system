<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $name = $_POST['patient_name'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $dob = $_POST['dob'];
  $emergency = $_POST['emergency_type'];
  $contact = $_POST['contact_number'];
  $pickup = $_POST['pickup_location'];
  $drop = $_POST['drop_location'];

  $sql = "UPDATE bookings SET 
            patient_name='$name',
            gender='$gender',
            age='$age',
            dob='$dob',
            emergency_type='$emergency',
            contact_number='$contact',
            pickup_location='$pickup',
            drop_location='$drop'
          WHERE id=$id";

  if ($conn->query($sql)) {
    header("Location: manage_patients.php");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
