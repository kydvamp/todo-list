<?php
require 'functions.php';

$id = $_GET["id"];
$task = query("SELECT * FROM activity WHERE id = $id")[0];

if (isset($_POST["submit-edit"])) {
  if (editData($_POST) > 0) {
    echo "<script>
            alert('Task updated successfully!');
            document.location.href = 'index.php';
          </script>";
  } else {
    echo "<script>
            alert('Failed to update task!');
            document.location.href = 'index.php';
          </script>";
  }
}
?>
<form action="" method="post">
  <input type="hidden" name="id" value="<?= $task['id']; ?>">
  <input type="text" name="nama" value="<?= $task['nama']; ?>" required>
  <select name="priority">
    <option value="low" <?= $task['priority'] == 'low' ? 'selected' : ''; ?>>Low</option>
    <option value="medium" <?= $task['priority'] == 'medium' ? 'selected' : ''; ?>>Medium</option>
    <option value="high" <?= $task['priority'] == 'high' ? 'selected' : ''; ?>>High</option>
  </select>
  <input type="text" name="category" value="<?= $task['category']; ?>">
  <input type="date" name="due_date" value="<?= $task['due_date']; ?>">
  <button type="submit" name="submit-edit">Update</button>
</form>