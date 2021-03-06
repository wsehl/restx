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
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Главная</title>
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css" />
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
  <section id="menu_hide" class="hero is-dark is-large pic">
    <div class="hero-body">
      <div class="container has-text-centered">
        <p class="title is-1">Попробуй эмоции</p>
        <p class="subtitle is-2">на вкус</p>
      </div>
    </div>
  </section>
  <section class="hero is-bold is-small is-light">
    <div class="hero-body">
      <div class="container">
        <h1 class="title">При заказе от 20 000 тенге и более – скидка 15%</h1>
        <h2 class="subtitle">
          при праздновании дня рождения – скидка 10%. <br />
          (скидка начисляется после проверки на месте)
        </h2>
      </div>
    </div>
  </section>
  <div class="container">
    <div class="hero-body">
      <div class="container has-text-centered">
        <p class="title is-1">Меню</p>
      </div>
    </div>
    <div class="columns is-multiline"></div>
  </div>
  <br><br>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="js/main.js"></script>
  <script src="js/list.js"></script>
</body>

</html>