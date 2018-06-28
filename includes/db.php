<?php

if (!empty(file_exists('libs/rb.php')))
{
    require 'libs/rb.php';
}
else{
    require '../libs/rb.php';
}



R::setup('mysql:host=localhost;dbname=seeds',
    'root', 'root'); //for both mysql or mariaDB

session_start();