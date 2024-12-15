<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM tasks WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        die("Task not found.");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $status = $conn->real_escape_string($_POST['status']);
    $sql = "UPDATE tasks SET status = '$status' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating task: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h1>Update Task</h1>
    <form method="POST">
        <label for="status">Status:</label><br>
        <select name="status" id="status">
            <option value="Pending" <?= $task['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
            <option value="In Progress" <?= $task['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
            <option value="Completed" <?= $task['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
        </select><br><br>
        <button type="submit">Update Task</button>
    </form>
</body>
</html>
