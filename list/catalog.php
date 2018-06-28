<?php
$user = "root";
$password = "root";
$db = "seeds";
$conn = new mysqli("localhost", $user, $password, $db) or die ("You are not connected");
$result = mysqli_query($conn, 'SELECT * FROM product');
$catalogGroup = mysqli_query($conn, 'SELECT * FROM cataloggroup');
if (!isset($_GET['id'])) {
    exit('Страница не найдена!');
}
$idCatalogGroup = $_GET['id'];
$idProduct = 0;
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
<div class="productCatalog">
    <a name="catalog"></a>
    <div class="productCatalogContent">

        <div class="catalogH">
            <h1>
                Каталог
            </h1>
        </div>

        <div class="catalogDataContent">
            <?php
            if (!$catalogGroup) {
                die('Неверный запрос: ' . mysqli_error());
            } else {
                foreach ($catalogGroup as $nameGroup => $valueGroup) {
                    if ($valueGroup["id"] == $idCatalogGroup) {
                        echo
                            "
                            <div class='groupProduct'>
                                <div class='imgGroup'>
                                    <img src='" . $valueGroup["photo"] . "' alt=''>                                    
                                </div>                
                                <div class='textGroup'>
                                    <h2>" . $valueGroup["nameGroupProduct"] . "</h2>
                                    <p>" . $valueGroup["description"] . " </p>	                                            
                                </div>								
                            </div>	
                            			
                                   ";
                    }
                }
            }
            ?>


            <?php
            if (!$result) {
                die('Неверный запрос: ' . mysqli_error());
            } else {
                foreach ($result as $name => $value) {
                    if ($value["idCtalogGroup"] == $idCatalogGroup) {
                        echo
                            "<ul class='table-layout clearfix'>
                                    <li class='product-wrapper'>
                                         <div class='product'>
                                            
                                                <div class='product-main'>
                                                    <div class='product-photo b-container'>
                                                    <img src='" . $value["photo"] . "' alt=''>
                                                        <a href='javascript:PopUpShow()'>
                                                            <div class='product-preview'>
                                                                <span class='button'>Быстрый просмотр</span>
                                                            </div>
                                                        </a>
                                                    </div>                
                                                    <div class='product-text'>
                                                        <h2 class='product-name'>" . $value["nameProduct"] . "</h2>
                                                        <p>" . $value["description"] . " </p>	                                            
                                                    </div>								
                                                </div>	
                                            
                                            <div class='product-details-wrap'>	                                    
                                                <div class='product-details'>";
                        if ($value["productCount"] > 0) {
                            echo "
                                            <div class='product-availability'>
                                                <span class='icon icon-check'>      
                                                    В наличии
                                                </span>
                                            </div>";
                        } else {
                            echo "
                                            <div class='available-no'>
                                                <span class='icon'>
                                                    Нет в наличии
                                                </span>
                                            </div>";
                        }
                        if ($value["pricePerShare"] > 0 && $value["pricePerShare"] > $value["price"]) {
                            echo "
                                            <span class='product-price product-price-old' >
                                                <b >" . $value["price"] . "</b >
                                                <small > руб.</small >
                                            </span >
                                            <span class='product-price'>
                                                <b >" . $value["pricePerShare"] . "</b >
                                                <small>руб.</small>
                                            </span>";
                        } else {
                            echo "
                                            <span class='product-price'>
                                                 <b >" . $value["price"] . "</b >
                                                <small>руб.</small>
                                            </span>";
                        }

                        echo "
                                            </div>
                                            <form class='product-buttons-wrap'>
                                            
                                                <form class='productCatalogContent' method='POST' enctype='multipart/form-data' action ='buyProduct.php?id=" . $value["id"] . "'>   
                                                     <button name='id' class='button to-cart' type='submit' value='" . $value["id"] . "'>В корзину</button>                          
                                                    <button name='id' class='button to-cart' type='submit' value='" . $value["id"] . "'>Купить в 1 клик</button>
                                                </form>
                                            </div>                                    
                                        </div>		
                                        <div></div>
                                        <div class='bord'>      
                                             <form class='addNews' action='updateProduct.php?id=" . $value["id"] . "&idCatalog=" . $idCatalogGroup . "' method='POST'>
                                                <div class='submit'>
                                                    <input type='submit' value='Редактировать продукт'>
                                                </div>
                                             </form>
                                             
                                             <form class='addNews' action='deleteProduct.php?id=" . $value["id"] . "' method='POST'>
                                                <div class='submit'>
                                                    <input type='submit' value='Удалить продукт'>
                                                 </div>
                                             </form>
                                        </div>	
                                    </div>
                                </li>								
                          </ul>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <div class="buttonAddNews">


        <a href='addListProduct.php?idCatalog=<?php echo $idCatalogGroup; ?>'>
            <button>Добавить продукт</button>
        </a>
        <a href='updateCatalog.php?idCatalog=<?php echo $idCatalogGroup; ?>'>
            <button>Редактировать каталог</button>
        </a>
    </div>
</div>
<div class="b-popup" id="popup1">
    <div class="b-popup-content">
        <h1>
            Tomato
        </h1>
        <p>
            <img class="newsImage1" src="../img/catalog/redTomat2.jpg">
            Test
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
    }
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
	