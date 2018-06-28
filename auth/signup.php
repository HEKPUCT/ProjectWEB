<?php
require "../includes/db.php";
$data = $_POST;
if (isset($data['do_signup'])) {
    $errors = array();
    if (trim($data["login"]) == '') {
        $errors[] = 'Введите логин!';
    }

    if ($data["password"] == '') {
        $errors[] = 'Введите пароль!';
    }
    if ($data["password"] != $data["returnPassword"]) {
        $errors[] = 'Повторный пароль введен не верно!';
    }
    if (trim($data["email"]) == '') {
        $errors[] = 'Введите email!';
    }
    if (trim($data["surname"]) == '') {
        $errors[] = 'Введите фамилию!';
    }
    if (trim($data["nameuser"]) == '') {
        $errors[] = 'Введите имя!';
    }

    if (R::count('user', "login = ?", array($data['login'])) > 0) {
        $errors[] = 'Пользователь с таким логином уже существует!';
    }

    if (R::count('user', "email = ?", array($data['email'])) > 0) {
        $errors[] = 'Пользователь с таким Email уже существует!';
    }

    if (empty($errors)) {
        $user = R::dispense('user');
        $user->login = $data["login"];
        $user->password = password_hash($data["password"], PASSWORD_DEFAULT);
        $user->nameuser = $data["nameuser"];
        $user->surname = $data["surname"];
        $user->patronymic = $data["patronymic"];
        $user->email = $data["email"];
        R::store($user);
        echo '<div style="color:green">Вы успешно зарегистрированы!</div><hr>';
        header('Location:../');
    } else {
        echo '<div style="color:red">' . array_shift($errors) . '</div><hr>';
    }
}
?>
<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='../css/style.css' type='text/css'>
    <link rel='stylesheet' href='../css/font-awesome.css' type='text/css'>
    <title> Auth</title>
</head>


<div class="authBody" id="popup1">

    <div class='containerSugnup'>
        <img src='../img/icons/user.png'>

        <form action="signup.php" method="POST">


            <input type="text" name="login" placeholder='Введите логин'  value="<?php echo @$data["login"] ?>">

            <input type="password" placeholder='Введите пароль' name="password">

            <input type="password" placeholder='Повторите пароль' name="returnPassword">

            <input type="email" name="email" placeholder='Ваш email' value="<?php echo @$data["email"] ?>">
            <input type="text" name="surname" placeholder='Ваше фамилия' value="<?php echo @$data["surname"] ?>">

            <input type="text" name="nameuser" placeholder='Ваше имя' value="<?php echo @$data["nameuser"] ?>">

            <input type="text" name="patronymic" placeholder='Ваше отчество' value="<?php echo @$data["patronymic"] ?>">
            <input class='auth-submitReg' type="submit" name="do_signup" value='ЗАРЕГИСТРИРОВАТЬСЯ'>
            <div class="cancelButton">
                <a href="../">Отмена</a><br>
            </div>
        </form>
    </div>
</div>



