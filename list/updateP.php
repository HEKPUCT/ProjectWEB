<?php
include 'updateProduct.php';
if (!isset($_GET['id'])) {
    exit('Страница не найдена!');
}
$idproduct = $_GET['id'];
$idCatalog = $_GET['idCatalog'];


$put = '../img/catalog/product/';
$userId = 1;
$description = '';
$namefile = '';
$price = 0;
$pricePerShare = 0;
$countProduct = 0;
$nameProduct = '';
$photoAll = '';
$ran = rand(0000, 9999);
$ran1 = rand(0000, 9999);

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "seeds";


$img = $_FILES['filename'];


if (!empty($img)) {
    $img_desc = reArrayFiles($img);
    foreach ($img_desc as $val) {
        $newname = date('YmdHis', time()) . mt_rand() . '.jpg';
        $photoAll .= $put . $newname . "\n";
        move_uploaded_file($val['tmp_name'], $put . $newname);
    }
}


function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);

    for ($i = 0; $i < $file_count; $i++) {
        foreach ($file_key as $val) {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}

if (isset ($_FILES['userfile']['name']) && ($_FILES['userfile']['name'] != '')) {
    $name = $_FILES["userfile"]["name"];
    move_uploaded_file($_FILES["userfile"]["tmp_name"], $put . $ran . $ran1 . $name);
    $namefile = $put . $ran . $ran1 . $name;
}

if (isset($_POST['discription'])) {
    $description = htmlspecialchars($_POST['discription']);
}
if (isset($_POST['nameProduct'])) {
    $nameProduct = htmlspecialchars($_POST['nameProduct']);
}
if (isset($_POST['price'])) {
    $price = htmlspecialchars($_POST['price']);
}
if (isset($_POST['pricePerShare'])) {
    $pricePerShare = htmlspecialchars($_POST['pricePerShare']);
}
if (isset($_POST['countProduct'])) {
    $countProduct = htmlspecialchars($_POST['countProduct']);
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname) or die ("You are not connected");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$result = mysqli_query($conn, 'SELECT * FROM product');
foreach ($result as $name => $value) {
    if ($value["idCtalogGroup"] == $idCatalog && $value["id"] == $idproduct) {
        $pieces = explode("\n", $value["photoAll"]);
        for ($i = 0; $i < count($pieces) - 1; $i++) {
            echo $pieces[$i] . "<br>";
            unlink($pieces[$i]);
        }
        unlink(trim($value["photo"]));
        break;
    }
}


$sql = "UPDATE product SET nameProduct = '$nameProduct', description = '$description', photo = '$namefile', price = '$price', idCtalogGroup = '$idCatalog', pricePerShare = '$pricePerShare', productCount = '$countProduct', photoAll = '$photoAll' WHERE id = " . $idproduct;
if ($conn->query($sql) !== TRUE) {
    echo "<p  style='color:red;'> Error: " . $sql . "<br>" . $conn->error . "</p>";
}
$conn->close();
