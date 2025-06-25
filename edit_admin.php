<?php
session_start();
include 'db.php';

// Assuming admin ID is stored in session
$admin_id = 1; // Replace with: $_SESSION['admin_id'] if using sessions

// Fetch current admin data
$sql = "SELECT * FROM admin WHERE id = $admin_id";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();

// Handle form submission
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $new_name = $_POST['username'];
  $new_password = $_POST['password'];

  if (!empty($new_password)) {
    $update_sql = "UPDATE admin SET username='$new_name', password='$new_password' WHERE id=$admin_id";

} else {
    $update_sql = "UPDATE admin SET username='$new_name' WHERE id=$admin_id";
  }

  if ($conn->query($update_sql) === TRUE) {
    $success = "Profile updated successfully!";
    header("refresh:1;url=admindash.php");
  } else {
    $error = "Error updating profile: " . $conn->error;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Profile - Admin</title>
  <link rel="stylesheet" href="ambulance_style.css">
  <style>
    .form-container {
      width: 400px;
      margin: 80px auto;
      background-color: #f8f8f8;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2c4770;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
    }

    button {
      background-color: #2c4770;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #1e3555;
    }

    .message {
      text-align: center;
      color: green;
      font-weight: bold;
      margin-bottom: 10px;
    }

    .error {
      text-align: center;
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="form-container">
  <h2>Edit Profile</h2>

  <?php if ($success): ?>
    <p class="message"><?php echo $success; ?></p>
  <?php elseif ($error): ?>
    <p class="error"><?php echo $error; ?></p>
  <?php endif; ?>

  <form method="POST">
    <label>Admin Username</label>
    <input type="text" name="username" value="<?php echo $admin['username']; ?>" required>

    <label>New Password <small>(Leave blank to keep existing)</small></label>
    <input type="password" name="password">

    <button type="submit">Update Profile</button>
  </form>
</div>

</body>
</html>
