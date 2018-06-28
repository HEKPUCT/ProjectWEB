<?php
$user = "root";
$password = "root";
$db = "seeds";
$conn = new mysqli("localhost", $user, $password, $db) or die ("You are not connected");
$result = mysqli_query($conn, 'SELECT * FROM review WHERE is_moderate = "1"');
$resultUser = mysqli_query($conn, 'SELECT * FROM user');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Seeds</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" media="screen,projection" href="../css/ui.totop.css"/>
    <meta name="viewport" content="width=device-width; initial-scale=1"/>
    <script src='js/jquery-2.2.4.min.js'>
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
                            <input type="search" name="" placeholder="Поиск" class="input">
                            <input type="submit" name="" value="" class="submit"/>
                            </input>
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
<div class="moreReviews">
    <a name="reviews"></a>
    <h1>
        Отзывы
    </h1>
    <div class="moreReviewsContent">
        <?php
        if (!$result) {
            die('Неверный запрос: ' . mysqli_error());
        } else {
            foreach ($result as $name => $value) {
                echo "    
                    <div class='moreReviewsArticle'>
                            <h2>";
                foreach ($resultUser as $nameUser => $valueUser) {
                    if ($valueUser["id"] == $value["idUser"]) {
                        echo $valueUser["surname"] . " " . $valueUser["nameuser"] . " " . $valueUser["patronymic"];
                        echo "
                             </h2>
                             <p>
                                <a name='#" . $value["id"] . "'></a>
                                <img class ='moreReviewsImage1' src='" . $valueUser["photo"] . "'>
                              <b>" . $value["dateReview"] . "</b> " . $value["description"] . "
                             </p>";
                        break;
                    }
                }
                echo " <a href='javascript:PopUpShow()'>Больше...</a>
                        </div>";

            }
        }
        ?>

    </div>
    <div class="formAddReviews">
        <h2>Оставьте свой отзыв</h2>
        <form class="addNews" action='upload.php' method='POST' enctype="multipart/form-data">
            <div class="reviewP"><p><b>Содержание:</b></p></div>
            <div class="inputElement"><textarea name="discription" cols="160" rows="30"></textarea></div>
            <div class="buttonAddReview">
                <a href="addListProduct.php">
                    <input type='submit' value='Добавить'>
                </a>
            </div>
        </form>
    </div>

    <div class="b-popup" id="popup1">
        <div class="b-popup-content">
            <h1>
                Тема
            </h1>
            <p>
                <a name="#3"></a>
                <img class="newsImage1" src="../img/news/news2.jpg">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
            </p>
            <a href="javascript:PopUpHide()">Закрыть</a>
        </div>

    </div>
    <script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
    <!-- easing plugin ( optional ) -->
    <script src="../js/easing.js" type="text/javascript"></script>
    <!-- UItoTop plugin -->
    <script src="../js/jquery.ui.totop.js" type="text/javascript"></script>
    <!-- Starting the plugin -->


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
            <p>© <a href="#"> ешьТомат.ru</a>, 2018 </p>
        </div>
        <div class="copyrightText">
            <p> При перепечатке материала активная ссылка на сайт <a href="#"> ешьТомат.ru</a> обязательна.</p>
        </div>
    </div>
</footer>
</html>
