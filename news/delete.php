<?php
$user = "root";
$password = "root";
$db = "seeds";
$conn = new mysqli("localhost", $user, $password, $db) or die ("You are not connected");

if (!isset($_GET['id'])) {
    exit('Страница не найдена!');
}
$idNews = $_GET['id'];

$sql = "DELETE FROM news WHERE id =" . $idNews;
if ($conn->query($sql) !== TRUE) {
    echo "<p  style='color:red;'> Error: " . $sql . "<br>" . $conn->error . "</p>";
}
$conn->close();
header("Location: news.php",TRUE,301);