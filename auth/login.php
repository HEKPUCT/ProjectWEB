<?php
require "../includes/db.php";

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
if (isset($_SESSION['logged_user'])):?>
    Авторизован!
    Привет, <?php echo $_SESSION['logged_user']->login; ?>
    <hr>
    <a href="logout.php">Выйти!</a>


<?php else: ?>
    <a href='javascript:PopUpShow()'>
        <span class='button'>Быстрый просмотр</span>
    </a>
<?php endif; ?>

<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='../css/style.css' type='text/css'>
    <link rel='stylesheet' href='../css/font-awesome.css' type='text/css'>
    <title> Auth</title>
</head>


<div class="b-popup" id="popup1">

    <div class='container'>
        <img src='../img/icons/user.png'>

        <form action="auth.php" method="POST">
            <div class='auth-input'>
                <input type='text' name='login' placeholder='Введите логин' value="<?php echo @$data['login']; ?>">
            </div>

            <div class='auth-input'>
                <input type='password' name='password' placeholder='Введите пароль'>
            </div>
            <input class='auth-submit' type='submit' name='do_login' value='ВОЙТИ'>
            <div class='rememberReg'>
                <a href='login.php'>Восстановить пароль</a>
                <a href='signup.php'>Регистрация</a>
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

</script>

<script type="text/javascript"> $(document).ready(function () {
        PopUpHide();
    });
    function PopUpShow() {
        document.getElementById("popup1").style.margin = "10em";
        $("#popup1").show();

    }
    function PopUpHide() {
        document.getElementsByClassName('.b-popup')[0].style= "margin: 20%";
        $("#popup1").hide();
    }
</script>




