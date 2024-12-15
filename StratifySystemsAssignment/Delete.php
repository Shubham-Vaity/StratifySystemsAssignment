<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM tasks WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error deleting task: " . $conn->error;
    }
}

$conn->close();
?>

