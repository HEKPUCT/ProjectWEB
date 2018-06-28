<?php
include 'addNews.php';
$ran = rand(0000, 9999);
$ran1 = rand(0000, 9999);
$put = '../img/news/';
$namefile = '';
$description = '';
$theme = '';
$userId = 1;

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "seeds";


if (isset ($_FILES['filename']['name']) && ($_FILES['filename']['name'] != '')) {
    $name = $_FILES["filename"]["name"];
    move_uploaded_file($_FILES["filename"]["tmp_name"], $put . $ran . $ran1 . $name);
    $namefile = $ran . $ran1 . $name;
}
if (isset($_POST['discription']))
{
    $description = htmlspecialchars($_POST['discription']);
}
if (isset($_POST['theme']))
{
    $theme = htmlspecialchars($_POST['theme']);
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dateToday = date("Y-m-d H:i:s");
$sql = "INSERT INTO news (dateNews, theme, description, idUser, photo) VALUES ('$dateToday','$theme', '$description', '$userId', '$namefile')";
if ($conn->query($sql) !== TRUE) {
    echo "<p  style='color:red;'> Error: " . $sql . "<br>" . $conn->error . "</p>";
}
$conn->close();

