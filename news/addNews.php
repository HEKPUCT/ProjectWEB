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
<div class="moreNews">
    <a name="news"></a>
    <h1>
        Новости
    </h1>

    <div class="moreNewsContent">
        <form class="addNews" action='upload.php' method='POST' enctype="multipart/form-data">
            <div class='addNewsArticle'>

                <div class="contentAddNews">
                    <div>
                        <p>Тема:<input type='text' name='theme'></p>
                    </div>
                    <div><p>Описание:</p> <textarea name="discription" cols="160" rows="30"></textarea></div>

                    <div>
                        Эскиз: <input type='file' name='filename'>
                    </div>
                    <div class="submit">
                        <input type='submit' value='Добавить'>
                    </div>
                </div>
            </div>
        </form>

    </div>


    <div class="b-popup" id="popup1">
        <div class="b-popup-content">
            <h1>
                Тема
            </h1>
            <p>
                Тест
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
    <script type="text/javascript">

    </script>

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






