<?php
require "includes/db.php";
$numberReview = 1;
$numberTable = 1;
$user = "root";
$password = "root";
$db = "seeds";
$conn = new mysqli("localhost", $user, $password, $db) or die ("You are not connected");
function dump($what)
{
    echo '<pre>';
    print_r($what);
    echo '</pre>';
}

$data = $_POST;
if (isset($data['do_login'])) {
    $errors = array();
    $user = R::findOne('user', 'login = ?', array($data['login']));
    if ($user) {
        if (password_verify($data['password'], $user->password)) {
            $_SESSION['logged_user'] = $user;
        } else {
            $errors[] = 'Неверно введен пароль!';
        }
    } else {
        $errors[] = 'Пользователь с таким логином не найден!';
    }

    if (!empty($errors)) {
        echo "<div class='errorview'>" . array_shift($errors) . "</div><hr>";
    }

}


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Seeds</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" media="screen,projection" href="css/ui.totop.css"/>
    <link rel="stylesheet" href="css/font-awesome.css" type="text/css">
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
    <div class="head">
        <div id="block" class="blockMenu" style="display: none;">

        </div>
        <div class="title">

            <div class="bodyTitle">
                <div class="leftlogo">
                    <div class="logo">
                        <a href="#"><img src="img/icons/logo.png"></a>
                    </div>
                    <div class="search">
                        <form action="" method="post" class="search">
                            <input type="search" name="" placeholder="Поиск" class="input"/>
                            <input type="submit" name="" value="" class="submit"/>
                        </form>

                    </div>
                </div>
                <div class="menu">
                    <ul>
                        <li>
                            <a href="#catalog">
                                Каталог
                            </a>
                        </li>
                        <li>
                            <a href="#news">
                                Новости
                            </a>
                        </li>
                        <li>
                            <a href="#about">
                                О нас
                            </a>
                        </li>
                        <li>
                            <a href="#reviews">
                                Отзывы
                            </a>
                        </li>
                        <li>
                            <a href="#feedback">
                                Обратная связь
                            </a>
                        </li>
                        <li>
                            <a href="#contact">
                                Контакты
                            </a>
                        </li>
                        <li>
                            <a href="order/order.php">
                                Корзина
                            </a>
                        </li>
                        <li>
                            <?php
                            if (isset($_SESSION['logged_user'])):?>
                                <ul class="topmenu">
                                    <li>
                                        <a href="" class="down"><?php echo $_SESSION['logged_user']->login; ?></a>
                                        <ul class="submenu">
                                            <div class="infoUser">
                                                <div class="moreInfoUser">
                                                    <p>
                                                        <?php echo $_SESSION['logged_user']->surname; ?>
                                                    </p>
                                                    <p>
                                                        <?php echo $_SESSION['logged_user']->nameuser; ?>
                                                    </p>
                                                    <p>
                                                        <?php echo $_SESSION['logged_user']->patronymic; ?>
                                                    </p>
                                                </div>
                                                <div class="imgInfoUser">
                                                    <img src="<?php echo $_SESSION['logged_user']->photo; ?>">
                                                </div>
                                            </div>
                                            <li>
                                                <a href="order/orderHistory.php">История заказов</a>
                                            </li>
                                            <li>
                                                <a href="#">Редактировать</a>
                                            </li>
                                            <li>
                                                <a href="auth/logout.php">Выйти</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>

                            <?php else: ?>
                                <a href='javascript:PopUpShow()'>
                                    Войти
                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="blockTitle">
            <div class="textTitle">
                <p>
                    Хотите хороший урожай?
                </p>
            </div>
            <div class="textTitle1">
                <p>
                    Заказывайте семена у нас. Доставка по всей России!
                </p>
            </div>
            <button class="buttonTitle" style="vertical-align:middle"><span>Подробнее</span></button>
        </div>
    </div>
</header>
<body>
<div class="catalog">
    <a name="catalog"></a>
    <div class="catalogContent">
        <h1>
            Каталог
        </h1>
        <ul class="products clearfix">
            <?php

            $result = mysqli_query($conn, 'SELECT * FROM cataloggroup');
            if (!$result) {
                die('Неверный запрос: ' . mysqli_error());
            } else {
                foreach ($result as $name => $value) {
                    echo " <li class='product-wrapper'>
                    <a href='list/catalog.php?id=" . $value["id"] . "' class='product'>
                        <div class='product-main'>
                            <div class='product-photo'>
                                <img src='" . substr($value["photo"], 3) . "' alt=''>
                            </div>
                            <div class='product-text'>
                                <h2 class='produvt-name'>" . $value["nameGroupProduct"] . "</h2>
                                <p>" . $value["description"] . "</p>
                            </div>                   
                        <div class='stock' >
                                        <span >";
                    if ($value["statusAction"] == 1) {
                        echo "<b color = 'red' > Акция!<br></b > ";
                    } else {
                        echo "<b color = 'red' > <br></b > ";
                    }
                    echo "</span >
                            </div >
                        </div >                    
                    </a>
                </li>";
                }
            }
            ?>
        </ul>
    </div>
</div>

<div class="news">
    <a name="news"></a>
    <h1>
        Новости
    </h1>
    <div class="newsContent">
        <?php
        $query = $conn->query("SELECT * FROM news");
        $result = mysqli_query($conn, 'SELECT * FROM news ORDER BY id DESC LIMIT 3');
        if (!$result) {
            die('Неверный запрос: ' . mysqli_error());
        } else {
            foreach ($result as $name => $value) { ?>

                <div class="newsArticle">
                    <h2>
                        <?php echo $value["theme"]; ?>
                    </h2>
                    <p>
                        <?php
                        echo "<img class ='newsImage1' src='img/news/" . $value["photo"] . "'>";
                        echo "<b>" . date("d.m.Y H:i", strtotime($value["dateNews"])) . "</b><br>" . $value["description"];
                        ?>

                    </p>
                    <?php
                    echo "<a href='news/news.php#" . $value["id"] . "'>Больше...</a>"
                    ?>
                </div>

                <?php
            }
        }
        ?>
    </div>
    <a href="news/news.php">
        <button class="buttonTitle" style="vertical-align:middle"><span>Подробнее</span></button>
    </a>
</div>
<div class="about">
    <a name="about"></a>
    <h1>О нас</h1>
    <div class="aboutContent">
        <div class="aboutDataContent">
            <p><img class="aboutasImgLeft" src="img/about/aboutas.png">Lorem ipsum dolor sit amet, consectetuer
                adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.<br>
                <img class="aboutasImgRight" src="img/about/aboutas.jpg">
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem
                nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem
                nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem
                nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem
                nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.
                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh
                euismod tincidunt ut lacreet dolore magna aliguam erat volutpat. Ut wisis enim
                ad minim veniam, quis nostrud exerci tution ullamcorper suscipit lobortis nisl
                ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
    <a href="aboutas/aboutas.php">
        <button class="buttonTitle" style="vertical-align:middle"><span>Подробнее</span></button>
    </a>
</div>
<div class="reviews">
    <a name="reviews"></a>
    <div class="reviewsData">
        <h1>
            Отзывы
        </h1>
        <div class="reviewsContent">
            <?php
            $result = mysqli_query($conn, 'SELECT * FROM review  WHERE is_moderate = "1" ORDER BY id DESC LIMIT 3');
            if (!$result) {
                die('Неверный запрос: ' . mysqli_error());
            } else {
                $resultUser = mysqli_query($conn, 'SELECT * FROM user');
                foreach ($result as $name => $value) {
                    echo
                        "<div class='reviewsArticle" . $numberTable . "'>";
                    foreach ($resultUser as $nameUser => $valueUser) {
                        if ($valueUser["id"] == $value["idUser"]) {

                            echo " <h2>" . $valueUser["nameuser"] . " " . $valueUser["surname"] . "</h2>
                            <p>
                                <img class ='reviewsImage" . $numberReview . "' src='" . substr($valueUser["photo"], 3) . "'>
                               <b>" . $value["dateReview"] . "</b> " . $value["description"] . "
            
                            </p>
                            <a href='reviews/reviews.php'>Больше...</a>";
                            if ($numberReview < 3) {
                                $numberReview++;
                            } else {
                                $numberReview = 1;
                            }
                            if ($numberTable == 1) {
                                $numberTable++;
                            } else {
                                $numberTable = 1;
                            }
                        }
                    }
                    echo "</div>";
                }
            }
            ?>
        </div>
        <a href="reviews/reviews.php">
            <button class="buttonTitle" style="vertical-align:middle"><span>Подробнее</span></button>
        </a>
    </div>
</div>
<div class="feedback">
    <a name="feedback"></a>
    <h1>Обратная связь</h1>

    <div class="feedbackContent">
        <div class="feedbackDataContent">


            <form class="formMail" method="post" action="mail/mail.php" onSubmit="return checkForm(this)">

                <div class="left">
                    <label class="labelMail" for="name">Имя:</label>
                    <input class="inputMail" maxlength="30" type="text" name="name" placeholder="Ваше имя" required/>

                    <label class="labelMail" for="phone">Телефон:</label>
                    <input class="inputMail" type="number" id="shest" name="phone" placeholder="Ваш номер телефона"
                           required/>

                    <label class="labelMail" for="mail">Email:</label>
                    <input class="inputMail" maxlength="30" type="email" name="mail" placeholder="Ваш Email" required/>
                </div>

                <div class="right">
                    <label class="labelMail" for="message">Сообщение:</label>
                    <div class="aboutAs"><textarea rows="7" cols="70" name="message"
                                                   placeholder="Введите здесь Ваше сообщение!" required></textarea>
                    </div>

                    <input class="inputMail" type="submit" value="Отправить"/>
                </div>

            </form>

        </div>
    </div>
</div>

<div class="contact">
    <a name="contact"></a>
    <h1>Контакты</h1>

    <div class="contactContent">
        <div class="contactDataContent">
            <div>
                <h2>У Вас остались вопросы? Свжитесь с нами!</h2>
            </div>
            <div class="contectMapNmber">
                <div class="contactNumber">
                    <p>Тел.: +7 (999) 999 99 99</p>
                    <p>E-mail: site@mail.ru</p>
                    <p>Почта: индекс - 199999, г. Санкт-Петербург, ул. Ленинградская, д.1, кв.1</p>
                    <div class="socialGeneral">
                        <p>Социальные сети:</p>
                        <i class="fa fa-vk" aria-hidden="true"></i>
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-odnoklassniki" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="mapMe">
                    <p>Карта:</p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d66266.35121763953!2d29.81783682389964!3d58.732992103918576!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46be372b4e93debb%3A0xd62f08a1e98411ac!2z0JvRg9Cz0LAsINCb0LXQvdC40L3Qs9GA0LDQtNGB0LrQsNGPINC-0LHQuy4!5e0!3m2!1sru!2sru!4v1521722854078"
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="b-popup" id="popup1">

    <div class='container'>
        <img src='img/icons/user.png'>

        <form action="index.php" method="POST">
            <div class='auth-input'>
                <input type='text' name='login' placeholder='Введите логин' value="<?php echo @$data['login']; ?>">
            </div>

            <div class='auth-input'>
                <input type='password' name='password' placeholder='Введите пароль'>
            </div>
            <input class='auth-submit' type='submit' name='do_login' value='ВОЙТИ'>
            <div class='rememberReg'>
                <a href='login.php'>Восстановить пароль</a>
                <a href='auth/signup.php'>Регистрация</a>
            </div>
        </form>

        <div class='social'>
            <i class='fa fa-vk' aria-hidden='true'></i>
            <i class='fa fa-facebook' aria-hidden='true'></i>
            <i class='fa fa-instagram' aria-hidden='true'></i>
            <i class='fa fa-odnoklassniki' aria-hidden='true'></i>
        </div>
        <div class="rememberReg">
            <a href="javascript:PopUpHide()">Закрыть</a>
        </div>
    </div>
</div>


<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>


<script type = "text/javascript" >
    $(document).ready(function () {
        PopUpHide();
    });
function PopUpShow() {

    document.getElementById("popup1").style.margin = "0%";
    $("#popup1").show();
}
function PopUpHide() {
    document.getElementById("popup1").style.margin = "-100%";
    $("#popup1").hide();

}
</script>


<script src="js/jquery-1.7.2.min.js" type="text/javascript"></script>
<!-- easing plugin ( optional ) -->
<script src="js/easing.js" type="text/javascript"></script>
<!-- UItoTop plugin -->
<script src="js/jquery.ui.totop.js" type="text/javascript"></script>
<!-- Starting the plugin -->



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
<footer>
    <div class="footerText">
        <div class="copyright">
            <p>© <a href="#"> ешьТомат.ru</a>, 2018 </p>
        </div>
        <div class="copyrightText">
            <p> При перепечатке материала активная ссылка на сайт <a href="#"> ешьТомат.ru</a> обязательна.</p>
        </div>
    </div>
</footer>
</html>


