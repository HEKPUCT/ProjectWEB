<?php
include 'updateCatalog.php';
if (!isset($_GET['id'])) {
    exit('Страница не найдена!');
}
$id = $_GET['id'];


$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "seeds";


if($_POST['action'] == 'В корзину')
{

}
else{
   // header("Location: ../index.php#catalog",TRUE,301);
}