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
    <title>Корзина</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
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
                    <a class="navbar-item" href="contact.php"><span>Контакты</span></a>
                    <a class="navbar-item active" href="cart.php"><span>Корзина&nbsp;<span style="opacity:0;" class="tag is-success is-small" id="all">0</span></span></a>
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
    <div class="container">
        <section class="hero is-bold is-medium">
            <div class="hero-body">
                <div class="columns">
                    <div class="column is-3">
                        <div class="email-field">
                            <div class="field">
                                <label class="label">Имя</label>
                                <div class="control"><input class="input" type="text" id="ename" placeholder="нп-р Иван Иванов" onkeypress="validateText(event)" required></div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control"><input class="input" type="email" id="email" placeholder="нп-р alexsmith@gmail.com" required></div>
                            </div>
                            <div class="field">
                                <label class="label">Телефон</label>
                                <div class="control"><input class="input" type="text" id="ephone" placeholder="нп-р 87052284455" maxlength="11" onkeypress="validateNum(event)" required></div>
                            </div>
                            <div class="field">
                                <label class="label">Адрес</label>
                                <div class="control"><input class="input" type="text" id="eaddr" placeholder="нп-р г.Нур-Султан ул.Желтоксан-1 кв.15" required></div>
                            </div>
                            <br>
                            <br>
                            <div class="field is-grouped">
                                <div class="control">
                                    <button class="send-email button is-link">Заказать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-5">
                        <div class="main-cart"></div>
                    </div>
                    <div class="column is-5">
                        <section class="section" style="padding: 2rem;">
                            <div class="container">
                                <h2 class="subtitle">При заказе от 5000тг и больше доставка <strong>бесплатная</strong></h2>
                                <h2 class="subtitle">Для заказов от 20000тг - скидка <strong>15%</strong></h2>
                                <h2 class="subtitle">Празднование дня рождения - скидка <strong>10% </strong><br>(проверка на месте)</h2>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>