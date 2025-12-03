<?php
require 'functions.php';

// Load initial data
$activity = query("SELECT * FROM activity");

// Add Task
if (isset($_POST["submit-add"])) {
    if (addData($_POST) > 0) {
        echo "<script>
                alert('Task added successfully!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to add task!');
                document.location.href = 'index.php';
              </script>";
    }
}

// Search Task
if (isset($_POST["submit-search"])) {
    $activity = search($_POST["search"]);
}

// Filter Tasks
if (isset($_POST["submit-filter"])) {
    $filter = $_POST["filter"];
    if ($filter == "complete") {
        $activity = query("SELECT * FROM activity WHERE status = 'complete'");
    } elseif ($filter == "pending") {
        $activity = query("SELECT * FROM activity WHERE status = 'pending'");
    } elseif ($filter == "today") {
        $activity = query("SELECT * FROM activity WHERE due_date = CURDATE()");
    } elseif ($filter == "this_week") {
        $activity = query("SELECT * FROM activity WHERE WEEK(due_date) = WEEK(CURDATE())");
    } else {
        $activity = query("SELECT * FROM activity");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To-Do List</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <h2>To-Do List</h2>
    <button class="add-button" id="add-button">Add New</button>
    <form action="" method="post" id="add-box" class="form-box add-box">
      <div class="form-header">
        <h3>Add Task</h3>
      </div>
      <div class="form-handling">
        <input type="text" name="nama" class="input-box" placeholder="Task Name" required>
        <select name="priority" class="input-box">
          <option value="low">Low</option>
          <option value="medium">Medium</option>
          <option value="high">High</option>
        </select>
        <input type="text" name="category" class="input-box" placeholder="Category">
        <input type="date" name="due_date" class="input-box">
        <button type="submit" name="submit-add" class="btn-button">Add</button>
      </div>
    </form>
  </nav>
  <main>
    <form action="" method="post" class="search-box">
      <input type="text" name="search" class="input-box" placeholder="Search tasks...">
      <button type="submit" name="submit-search" class="btn-button">Search</button>
    </form>
    <form action="" method="post" class="filter-box">
      <select name="filter">
        <option value="all">All</option>
        <option value="complete">Completed</option>
        <option value="pending">Pending</option>
        <option value="today">Today</option>
        <option value="this_week">This Week</option>
      </select>
      <button type="submit" name="submit-filter" class="btn-button">Filter</button>
    </form>
    <?php if (!empty($activity)) : ?>
      <?php foreach ($activity as $item) : ?>
        <div class="card">
          <input type="checkbox" <?= isset($item['status']) && $item['status'] == 'complete' ? 'checked' : ''; ?> 
                 onclick="toggleStatus(<?= $item['id']; ?>)">
          <p class="card-title"><?= htmlspecialchars($item["nama"]); ?></p>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>No tasks found.</p>
    <?php endif; ?>
  </main>
  <script src="script.js"></script>
</body>
</html>
