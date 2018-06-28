<?php
include 'updateCatalog.php';
if (!isset($_GET['idCatalog'])) {
    exit('Страница не найдена!');
}
$idCatalog = $_GET['idCatalog'];

$put = '../img/catalog/product/';
$userId = 1;
$description = '';
$nameFile = '';
$price = 0;
$pricePerShare = 0;
$countProduct = 0;
$nameCatalog = '';
$photoAll = '';
$ran = rand(0000, 9999);
$ran1 = rand(0000, 9999);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "seeds";






if (isset ($_FILES['userFile']['name']) && ($_FILES['userFile']['name'] != '')) {
    $name = $_FILES["userFile"]["name"];
    move_uploaded_file($_FILES["userFile"]["tmp_name"], $put . $ran . $ran1 . $name);
    $nameFile = $put . $ran . $ran1 . $name;
}

if (isset($_POST['description'])) {
    $description = htmlspecialchars($_POST['description']);
}
if (isset($_POST['nameCatalog'])) {
    $nameCatalog = htmlspecialchars($_POST['nameCatalog']);
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die ("You are not connected");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = mysqli_query($conn, 'SELECT * FROM cataloggroup');
foreach ($result as $name => $value) {
    if ($value["id"] == $idCatalog) {
        unlink(trim($value["photo"]));
        break;
    }
}
$sql = "UPDATE cataloggroup SET nameGroupProduct = '$nameCatalog', description = '$description', photo = '$nameFile' WHERE id = " . $idCatalog;
if ($conn->query($sql) !== TRUE) {
    echo "<p  style='color:red;'> Error: " . $sql . "<br>" . $conn->error . "</p>";
}
$conn->close();
