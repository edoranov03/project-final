<?php
include 'config.php';
include 'session.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    $sql = "INSERT INTO books (title, author, year) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $author, $year);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h1>Add Book</h1>
    <form method="post" action="add.php">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="author">Author:</label>
        <input type="text" name="author" required>
        <label for="year">Year:</label>
        <input type="number" name="year" required>
        <button type="submit">Add Book</button>
    </form>
</body>
</html>
