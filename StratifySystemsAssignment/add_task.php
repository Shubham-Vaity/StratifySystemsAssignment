<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);

    if (!empty($title) && strlen($description) <= 500) {
        $sql = "INSERT INTO tasks (title, description, status) VALUES ('$title', '$description', '$status')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Validation error: Ensure title is not empty and description is under 500 characters.";
    }
}

$conn->close();
?>

