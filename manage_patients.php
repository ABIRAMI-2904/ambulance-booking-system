<?php
include 'db.php';

// Handle search
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM bookings WHERE status='APPROVED'";

if (!empty($searchTerm)) {
  $sql .= " AND patient_name LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Manage Patients</title>
  <link rel="stylesheet" href="ambulance_style.css">
  <style>
    .btn { padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; }
    .add-btn, .search-btn { background-color: #2c4770; color: white; }
    .edit-btn { background-color: #475569; color: white; }
    .delete-btn { background-color: #e74c3c; color: white; }
    .table-container { margin-top: 20px; }
    .action-btns { display: flex; gap: 10px; }
    h1 span { color: #2c4770; }

    /* Modal Styles */
    .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); }

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

    .close { position: absolute; top: 10px; right: 20px; font-size: 22px; cursor: pointer; }
    .modal-content form label { display: block; margin-bottom: 5px; font-weight: 600; }
    .modal-content form input, .modal-content form select {
      width: 100%; padding: 10px; margin-bottom: 10px;
      border: 1px solid #ccc; border-radius: 8px; font-size: 15px;
    }
    .modal-content form button {
      background-color: #0d6efd; color: white;
      padding: 10px 20px; border: none;
      border-radius: 8px; font-size: 16px; cursor: pointer;
    }
    .modal-content form button:hover { background-color: #084cdf; }
  </style>
</head>
<body>

<div class="container">
  <h1>Manage <span>Patients</span></h1>

  <div style="display: flex; justify-content: space-between; align-items: center;">
    <button class="btn add-btn" onclick="openAddModal()">+ Add Patient</button>
    <form method="GET" action="manage_patients.php">
      <input type="text" name="search" placeholder="Search Patient Name..." value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Name</th><th>Gender</th><th>Age</th><th>DOB</th><th>Emergency Type</th>
          <th>Contact</th><th>Pickup</th><th>Drop</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['patient_name']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td><?php echo $row['age']; ?></td>
          <td><?php echo $row['dob']; ?></td>
          <td><?php echo $row['emergency_type']; ?></td>
          <td><?php echo $row['contact_number']; ?></td>
          <td><?php echo $row['pickup_location']; ?></td>
          <td><?php echo $row['drop_location']; ?></td>
          <td class="action-btns">
            <a href="edit_patient.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
            <a href="delete_patient.php?id=<?php echo $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9">No patients found.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Add Patient Modal -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeAddModal()">&times;</span>
    <h2>Add Patient</h2>
    <form method="post" action="add_patient.php">
      <label>Patient Name:</label><input type="text" name="patient_name" required>
      <label>Gender:</label>
      <select name="gender" required>
        <option value="">-- Select --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
      </select>
      <label>Age:</label><input type="number" name="age" required>
      <label>DOB:</label><input type="date" name="dob" required>
      <label>Emergency Type:</label><input type="text" name="emergency_type" required>
      <label>Contact Number:</label><input type="text" name="contact_number" required>
      <label>Pickup Location:</label><input type="text" name="pickup_location" required>
      <label>Drop Location:</label><input type="text" name="drop_location" required>
      <label>Ambulance Type:</label><input type="text" name="ambulance_type" required>
      <label>Pickup Date:</label><input type="date" name="pickup_date" required>
      <label>Pickup Time:</label><input type="time" name="pickup_time" required>
      <button type="submit">Add Patient</button>
    </form>
  </div>
</div>

<script>
function openAddModal() {
  document.getElementById("addModal").style.display = "block";
}
function closeAddModal() {
  document.getElementById("addModal").style.display = "none";
}
window.onclick = function(event) {
  const modal = document.getElementById("addModal");
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
</script>

</body>
</html>
