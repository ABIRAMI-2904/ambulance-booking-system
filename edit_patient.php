<?php
include 'db.php';

if (!isset($_GET['id'])) {
  echo "Invalid ID.";
  exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM bookings WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows != 1) {
  echo "Patient not found.";
  exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Patient</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: rgba(0,0,0,0.2);
    }

    .modal-content {
      background-color: #fff;
      margin: 5% auto;
      padding: 30px;
      border-radius: 15px;
      width: 500px;
      max-width: 90%;
      max-height: 70vh;
      overflow-y: auto;
      box-shadow: 0 10px 25px rgba(0,0,0,0.3);
      position: relative;
    }

    h2 {
      text-align: center;
      color: #2c4770;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 12px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

    button {
      background-color: #0d6efd;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #084cdf;
    }
  </style>
</head>
<body>
  <div class="modal-content">
    <h2>Edit Patient</h2>
    <form method="POST" action="update_patient.php">
      <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

      <label>Patient Name</label>
      <input type="text" name="patient_name" value="<?php echo $row['patient_name']; ?>" required>

      <label>Gender</label>
      <select name="gender" required>
        <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        <option value="Other" <?php if($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
      </select>

      <label>Age</label>
      <input type="number" name="age" value="<?php echo $row['age']; ?>" required>

      <label>DOB</label>
      <input type="date" name="dob" value="<?php echo $row['dob']; ?>" required>

      <label>Emergency Type</label>
      <input type="text" name="emergency_type" value="<?php echo $row['emergency_type']; ?>" required>

      <label>Contact Number</label>
      <input type="text" name="contact_number" value="<?php echo $row['contact_number']; ?>" required>

      <label>Pickup Location</label>
      <input type="text" name="pickup_location" value="<?php echo $row['pickup_location']; ?>" required>

      <label>Drop Location</label>
      <input type="text" name="drop_location" value="<?php echo $row['drop_location']; ?>" required>

      <button type="submit">Update Patient</button>
    </form>
  </div>
</body>
</html>
