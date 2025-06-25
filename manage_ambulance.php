<?php
include 'db.php';

// Search logic
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM ambulances";
if (!empty($searchTerm)) {
  $sql .= " WHERE name LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Manage Ambulances</title>
  <link rel="stylesheet" href="ambulance_style.css">
  <style>
    .btn { padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; }
    .add-btn, .search-btn { background-color: #2c4770; color: white; }
    .edit-btn { background-color: #475569; color: white; }
    .delete-btn { background-color: #e74c3c; color: white; }
    .action-btns { display: flex; gap: 10px; justify-content: center; }

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
  <h1>Manage <span>Ambulances</span></h1>

  <div style="display: flex; justify-content: space-between; align-items: center;">
    <button class="btn add-btn" onclick="openAddModal()">+ Add Ambulance</button>
    <form method="GET" action="manage_ambulance.php">
      <input type="text" name="search" placeholder="Search Ambulance Name..." value="<?php echo htmlspecialchars($searchTerm); ?>">
      <button type="submit" class="btn search-btn">Search</button>
    </form>
  </div>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Model</th>
          <th>Type</th>
          <th>Number</th>
          <th>Driver</th>
          <th>Contact</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['model']; ?></td>
            <td><?= $row['type']; ?></td>
            <td><?= $row['number']; ?></td>
            <td><?= $row['driver']; ?></td>
            <td><?= $row['contact']; ?></td>
            <td><?= $row['status']; ?></td>
            <td class="action-btns">
              <a href="edit_ambulance.php?id=<?= $row['id']; ?>" class="btn edit-btn">Edit</a>
              <a href="delete_ambulance.php?id=<?= $row['id']; ?>" class="btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
        <?php endwhile; else: ?>
          <tr><td colspan="8">No ambulances found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Add Modal -->
<div id="addModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeAddModal()">&times;</span>
    <h2>Add Ambulance</h2>
    <form method="post" action="add_ambulance.php">
      <label>Name:</label><input type="text" name="name" required>
      <label>Model:</label><input type="text" name="model" required>
      <label>Type:</label><input type="text" name="type" required>
      <label>Number:</label><input type="text" name="number" required>
      <label>Driver:</label><input type="text" name="driver" required>
      <label>Contact:</label><input type="text" name="contact" required>
      <label>Status:</label>
      <select name="status" required>
        <option value="">-- Select Status --</option>
        <option value="AVAILABLE">AVAILABLE</option>
        <option value="ON DUTY">ON DUTY</option>
      </select>
      <button type="submit">Add Ambulance</button>
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
  if (event.target == modal) modal.style.display = "none";
}
</script>
</body>
</html>
