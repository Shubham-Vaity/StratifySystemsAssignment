<?php include('db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Task Manager</h1>
    
    <form action="add_task.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" required><br><br>

        <label for="description">Description:</label><br>
        <textarea name="description" id="description" maxlength="500"></textarea><br><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status">
            <option value="Pending">Pending</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
        </select><br><br>

        <button type="submit">Add Task</button>
    </form>

    <h2>All Tasks</h2>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

        <?php
        $sql = "SELECT * FROM tasks";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='update_task.php?id={$row['id']}'>Update</a> |
                        <a href='delete_task.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tasks found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
