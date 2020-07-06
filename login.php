<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $log = 1;
    header("location: welcome.php");
    exit;
} else {
    $log = 0;
}
require_once "core/config.php";
$username = $password = "";
$username_err = $password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Пожалуйста, введите имя полльзователя.";
    } else {
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Пожалуйста, введите пароль.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (trim($_POST["username"]) == "admin" && trim($_POST["password"]) == "admin") {
        header("location: admin.php");
        session_start();
        $_SESSION["admin"] = true;
    }
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            header("location: welcome.php");
                        } else {
                            $password_err = "Неверный пароль.";
                        }
                    }
                } else {
                    $username_err = "Такого аккаунта не существует";
                }
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Авторизация</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css" />
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
    <div class="container">
        <section class="hero is-large">
            <div class="hero-body">
                <div class="columns">
                    <div class="column"></div>
                    <div class="column">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="field">
                                <label class="label">Логин</label>
                                <input class="input" type="text" name="username" value="<?php echo $username; ?>">
                                <span class="help is-danger"><?php echo $username_err; ?></span>
                            </div>
                            <div class="field">
                                <label class="label">Пароль</label>
                                <input class="input" type="password" name="password">
                                <span class="help is-danger"><?php echo $password_err; ?></span>
                            </div>
                            <div class="field">
                                <input class="button is-link" type="submit" value="Войти">
                            </div>
                            <p>Нет аккаунта? <a href="register.php">Зарагестрироваться</a></p>
                        </form>
                    </div>
                    <div class="column"></div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
</body>

</html>