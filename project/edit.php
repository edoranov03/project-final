<?php
include 'config.php';
include 'session.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];

    $sql = "UPDATE books SET title = ?, author = ?, year = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $title, $author, $year, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
} else {
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h1>Edit Book</h1>
    <form method="post" action="edit.php?id=<?php echo $id; ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
        <label for="author">Author:</label>
        <input type="text" name="author" value="<?php echo $book['author']; ?>" required>
        <label for="year">Year:</label>
        <input type="number" name="year" value="<?php echo $book['year']; ?>" required>
        <button type="submit">Update Book</button>
    </form>
</body>
</html>
