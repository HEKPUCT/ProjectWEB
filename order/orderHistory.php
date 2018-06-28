<?php
require "../includes/db.php";
$data = $_POST;

if (isset($data['do_login'])) {
    $errors = array();
     $user= R::findOne('user', 'login = ?', array($data['login']));
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
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" media="screen,projection" href="../css/ui.totop.css"/>
    <link rel="stylesheet" href="../css/font-awesome.css" type="text/css">
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
                            <input type="search" name="" placeholder="Поиск" class="input"/>
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
                                                    <img src="<?php echo "../" . $_SESSION['logged_user']->photo; ?>">
                                                </div>
                                            </div>
                                            <li>
                                                <a href="#">История заказов</a>
                                            </li>
                                            <li>
                                                <a href="#">Редактировать</a>
                                            </li>
                                            <li>
                                                <a href="../auth/logout.php">Выйти</a>
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
    </div>
    <?php ?>

</header>
<body>
<div class="orderHistoryBackgroundorderHistoryBackground">
    <a name="news"></a>
    <h1>
        История заказов
    </h1>
    <div class="moreNewsContentAdd">

        <?php



        if (isset($_SESSION['logged_user'])) {
            $orders = R::find('historypurchase', "WHERE iduser = ? ORDER BY 'id IS NOT NULL'DESC", array($_SESSION['logged_user']->id));
            if (!isset($orders->array)) {
                foreach ($orders as $order) {

                    echo "
                    <div class='moreNewsArticleAdd'>
						       <div class='infoOrder'>
                                    <table>                                    
                                        <caption>Заказ №" . $order->id . "</caption>
                                        <tr>
                                            <th>Дата заказа</th>
                                            
                                            <th>Количество товаров в заказе</th>
                                            <th>Стоимость доставки, руб</th>
                                            <th>Стоимость заказа, руб</th>
                                            
                                            <th>Итого</th>
                                            <th>Статус заказа</th>
                                            <td rowspan='2'>
                                                <div class='orderButtonTable'>
                                                <input type='button' class='buttonOrder' value='Отслеживание заказа'> 
                                                <input type='button' class='buttonOrder' value='Удалить заказ'> 
                                                
                                                </div>
                                             </td>
                                        </tr>
                                        <tr>
                                            <td> $order->date </td>
                                            <td> $order->countproduct</td>
                                            <td> $order->deliveryprice </td>
                                            <td>$order->orderprice</td>
                                            <td> " . ($order->deliveryprice + $order->orderprice) . "</td>";
                    $statusOrder = R::findOne('orderstatus', "id = ? ", array($order->idstatusorder));
                    echo "
                                            <td>$statusOrder->namestatus</td>
                                            
                                        </tr>                                       
                                    </table>                                    
                              </div>                
					</div>";
                }
            } else
                echo "		
					<div class='moreNewsArticleAdd'>
                        <div class='infoOrder'>
                            <p>У вас нет доступных заказов</p>
                        </div>
			        </div>";
        } else {
            echo "
        <div class='moreNewsArticleAdd'>
                        <div class='infoOrder'>
                            <p>У вас нет доступных заказов</p>
                        </div>
			        </div>";
        }
        ?>
    </div>
</div>

<div class="b-popup" id="popup1">

    <div class='container'>
        <img src='../img/icons/user.png'>

        <form action="orderHistory.php" method="POST">
            <div class='auth-input'>
                <input type='text' name='login' placeholder='Введите логин' value="<?php echo @$data['login']; ?>">
            </div>

            <div class='auth-input'>
                <input type='password' name='password' placeholder='Введите пароль'>
            </div>
            <input class='auth-submit' type='submit' name='do_login' value='ВОЙТИ'>
            <div class='rememberReg'>
                <a href='../auth/login.php'>Восстановить пароль</a>
                <a href='../auth/signup.php'>Регистрация</a>
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


<script src="../js/jquery-1.7.2.min.js" type="text/javascript">

</script>


<script type="text/javascript">
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


<script src="../js/jquery-1.7.2.min.js" type="text/javascript"></script>
<!-- easing plugin ( optional ) -->
<script src="../js/easing.js" type="text/javascript"></script>
<!-- UItoTop plugin -->
<script src="../js/jquery.ui.totop.js" type="text/javascript"></script>
<!-- Starting the plugin -->
<script type="text/javascript">

</script>


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
            <p>© <a href="../index.php"> ешьТомат.ru</a>, 2018 </p>
        </div>
        <div class="copyrightText">
            <p> При перепечатке материала активная ссылка на сайт <a href="../index.php"> ешьТомат.ru</a> обязательна.
            </p>
        </div>
    </div>
</footer>
</html>










