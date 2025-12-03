<?php

// Database connection
$connDB = mysqli_connect("localhost", "root", "", "todolist");
if (!$connDB) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Query helper function
function query($sql) {
    global $connDB;
    $result = mysqli_query($connDB, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($connDB)); // Add error handling
    }
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    return $data;
}

// Add a new task
function addData($add) {
    global $connDB;
    $nama = htmlspecialchars($add["nama"]);
    $priority = htmlspecialchars($add["priority"]);
    $category = htmlspecialchars($add["category"]);
    $due_date = htmlspecialchars($add["due_date"]);

    $query = "INSERT INTO activity (nama, priority, category, due_date) 
              VALUES ('$nama', '$priority', '$category', '$due_date')";
    mysqli_query($connDB, $query);
    return mysqli_affected_rows($connDB);
}

// Edit an existing task
function editData($data) {
    global $connDB;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $priority = htmlspecialchars($data["priority"]);
    $category = htmlspecialchars($data["category"]);
    $due_date = htmlspecialchars($data["due_date"]);

    $query = "UPDATE activity SET 
                nama = '$nama', 
                priority = '$priority', 
                category = '$category', 
                due_date = '$due_date' 
              WHERE id = $id";
    mysqli_query($connDB, $query);
    return mysqli_affected_rows($connDB);
}

// Delete a task
function deleteData($id) {
    global $connDB;
    $query = "DELETE FROM activity WHERE id = $id";
    mysqli_query($connDB, $query);
    return mysqli_affected_rows($connDB);
}

// Toggle task status (complete/pending)
function toggleStatus($id) {
    global $connDB;
    $task = query("SELECT status FROM activity WHERE id = $id")[0] ?? null;

    if (!$task || !isset($task['status'])) {
        return 0; // Return early if the task or status is missing
    }

    $newStatus = $task['status'] == 'complete' ? 'pending' : 'complete';

    $query = "UPDATE activity SET status = '$newStatus' WHERE id = $id";
    mysqli_query($connDB, $query);
    return mysqli_affected_rows($connDB);
}

// Search tasks
function search($search) {
    global $connDB;
    $query = "SELECT * FROM activity WHERE nama LIKE '%$search%'";
    return query($query);
}