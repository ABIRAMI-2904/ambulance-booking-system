<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "ambulance_booking";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$patient_name = $_POST['patient_name'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$emergency_type = $_POST['emergency_type'];
$relative_name = $_POST['relative_name'];
$relationship = $_POST['relationship'];
$contact_number = $_POST['contact_number'];
$ambulance_type = $_POST['ambulance_type'];
$pickup_date = $_POST['pickup_date'];
$pickup_time = $_POST['pickup_time'];
$pickup_location = $_POST['pickup_location'];
$drop_location = $_POST['drop_location'];

// Insert data
$sql = "INSERT INTO bookings (
    patient_name, gender, age, dob, emergency_type, relative_name, relationship,
    contact_number, ambulance_type, pickup_date, pickup_time, pickup_location, drop_location
) VALUES (
    '$patient_name', '$gender', '$age', '$dob', '$emergency_type', '$relative_name', '$relationship',
    '$contact_number', '$ambulance_type', '$pickup_date', '$pickup_time', '$pickup_location', '$drop_location'
)";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Booking submitted successfully!'); window.location.href='index.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
