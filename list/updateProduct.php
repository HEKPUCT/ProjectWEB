<?php
$user = "root";
$password = "root";
$db = "seeds";
$conn = new mysqli("localhost", $user, $password, $db) or die ("You are not connected");
$result = mysqli_query($conn, 'SELECT * FROM product');

if (!isset($_GET['id'])) {
    exit('Страница не найдена!');
}
$idproduct = $_GET['id'];
$idCatalog = $_GET['idCatalog'];
?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Seeds</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" media="screen,projection" href="../css/ui.totop.css"/>
    <meta name="viewport" content="width=device-width; initial-scale=1"/>
    <script src='../js/jquery-2.2.4.min.js'>
    </script>

</head>

<header>
    <ul class="body_slides">
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="heads">
        <div id="block" class="blockMenu" style="display: none;">
            <li>
                <a href="../index.php">
                    Главная
                </a>
            </li>
            <li>
                <a href="../index.php#news">
                    Новости
                </a>
            </li>
            <li>
                <a href="../index.php#about">
                    О нас
                </a>
            </li>
            <li>
                <a href="../index.php#reviews">
                    Отзывы
                </a>
            </li>
            <li>
                <a href="../index.php#feedback">
                    Обратная связь
                </a>
            </li>
            <li>
                <a href="../index.php#contact">
                    Контакты
                </a>
            </li>
        </div>
        <div class="title">
            <div class="bodyTitle">
                <div class="leftlogo">
                    <div class="logo">
                        <a href="../index.php"><img src="../img/icons/logo.png"> </a>
                    </div>
                    <div class="search">
                        <form action="" method="post" class="search">
                            <input type="search" name="" placeholder="Поиск" class="input"/ >
                            <input type="submit" name="" value="" class="submit"/>

                        </form>
                    </div>
                </div>
                <div class="menu">
                    <ul>
                        <li>
                            <div id="button">
                                Меню
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                Корзина
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Войти
                            </a>
                        </li>
                        <li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<body>
<div class="addListProduct">
    <a name="list"></a>
    <div class="title">
        <h1>
            Продукция
        </h1>
    </div>

    <form class='productCatalogContent' method='POST' enctype="multipart/form-data" action =
    <?php echo "'updateP.php?id=" . $idproduct . "&idCatalog=".$idCatalog."' >"; ?>

    <div class='addNewsArticle'>

        <div class="contentAddNews">
            <?php
            if (!$result) {
                die('Неверный запрос: ' . mysqli_error());
            } else {
                echo " <div>";
                foreach ($result as $name => $value) {
                    if ($value["id"] == $idproduct) {
                        echo "<p>Название: <input type='text' name='nameProduct' value='" . $value["nameProduct"] . "'></p>
                            <p>Цена без акции: <input type='number' name='price' value='" . $value["price"] . "'></p>
                            <p>Цена по акции: <input type='number' name='pricePerShare' value='" . $value["pricePerShare"] . "'></p>
                            <p>Количество товара: <input type='number' name='countProduct' value='" . $value["productCount"] . "'></p>                            
                           
                        </div>
                        <div class='inputElement'>
                            <p>Описание:</p>
                            <textarea name='discription' cols='160' rows='30'>". $value['description']." </textarea>
                        </div>
                        <div>
                            Эскиз: <input type='file' name='userfile'>
                        </div>
                        <br>
                        <div>
                            Изображение продукта: <input type='file' name='filename[]' multiple>
                        </div>";
                        break;
                    }
                }
            }?>
                        <div class="submit">
                <input type='submit' value='Добавить'>
            </div>
        </div>
    </div>
    </form>
</div>

<script type="text/javascript"> $(document).ready(function () {
        PopUpHide();
    });
    function PopUpShow() {
        $("#popup1").show();
    }
    function PopUpHide() {
        $("#popup1").hide();
    }</script>


<script type="text/javascript">
    $('body').prepend('<a href="#" class="back-to-top"></a>');
</script>

<script type="text/javascript">
    var amountScrolled = 200;

    $(window).scroll(function () {
        if ($(window).scrollTop() > amountScrolled) {
            $('a.back-to-top').fadeIn('slow');
        } else {
            $('a.back-to-top').fadeOut('slow');
        }
    });
    $('a.back-to-top').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 700);
        return false;
    });
</script>

<script>
    $(function () {
        $('#button').on('click', function (e) {
            $('#block').slideToggle(function () {
                console.log($(e.target).is(':visible'));
                $(e.target).text($(this).is(':visible') ? 'Меню' : 'Меню');
            });
        });
    });
</script>

</body>
<footer class="footerPage">
    <div class="footerTextPage">
        <div class="copyright">
            <p>© <a href="index.php"> ешьТомат.ru</a>, 2018 </p>
        </div>
        <div class="copyrightText">
            <p> При перепечатке материала активная ссылка на сайт <a href="index.php"> ешьТомат.ru</a> обязательна.
            </p>
        </div>
    </div>
</footer>
</html>






