<?php
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $log = 0;
} else {
    $log = 1;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>О компании</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
</head>

<body>
    <nav id="navbar" class="bd-navbar navbar is-spaced is-fixed-top">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php"><img src="images/logo.png" alt="Restaurant X" width="112" height="28"></a>
                <div id="navbarBurger" class="navbar-burger burger" data-target="navMenuDocumentation">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <div id="navMenuDocumentation" class="navbar-menu">
                <div class="navbar-end">
                    <a class="navbar-item" href="about.php"><span>О компании</span></a>
                    <a class="navbar-item active" href="contact.php"><span>Контакты</span></a>
                    <a class="navbar-item" href="cart.php"><span>Корзина&nbsp;</span><span class="tag is-success is-small" id="all">0</span></a>
                </div>
                <div class="navbar-end">
                    <div class="navbar-item">
                        <div class="buttons">
                            <?php
                            if ($log == 0) {
                            ?>
                                <a href="login.php" class="button is-small">Войти</a>
                                <a href="register.php" class="button is-success is-small"><strong>Регистрация</strong></a>
                            <?php
                            } else if ($log == 1) {
                            ?>
                                <a href="welcome.php" class="button is-small">Профиль</a>
                                <a href="logout.php" class="button is-danger is-small">Выйти</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <section class="hero is-bold is-medium">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">Почта</h1>
                <h2 class="subtitle">restaurantx@gmail.com<br></h2>
                <br>
                <h1 class="title">Телефон</h1>
                <h2 class="subtitle">+7 (777) 228 14 88<br></h2>
                <br>
                <h1 class="title">Адрес</h1>
                <div class="map">
                    <div id="map" style="width:100%; height:600px"></div>
                    <div class="container">
                        <div class="plate">
                            <h3 class="title">Наш адрес</h3>
                            <h1>пр. Нурсултана Назарбаева, 54 <br />г. Усть-Каменогорск</h1>
                            <a href="mailto:restaurantx@gmail.com">restaurantx@gmail.com</a>
                            <a href="tel:+77772281488">+7 (777) 228 14 88</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src="https://maps.api.2gis.ru/2.0/loader.js?pkg=full"></script>
    <script type="text/javascript">
        var map;
        DG.then(function() {
            map = DG.map('map', {
                center: [49.970109, 82.593998],
                zoom: 16
            });
            DG.marker([49.970109, 82.593998]).addTo(map);
        });
    </script>
</body>

</html>