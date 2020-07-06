<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $log = 1;
    header("location: index.php");
    exit;
} else {
    $log = 0;
}
require_once "core/config.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Пожалуйста, введите имя полльзователя.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Аккаунт с таким логином уже есть";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Что-то пошло не так";
            }
        }
        mysqli_stmt_close($stmt);
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Введите пароль";
    } elseif (strlen(trim($_POST["password"])) < 3) {
        $password_err = "В пароле должно быть больше 3 символов";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Подтвердите пароль";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Пароли не совпадают";
        }
    }
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Что-то пошло не так";
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
    <title>Регистрация</title>
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
                                <input class="input" type="password" name="password" value="<?php echo $password; ?>">
                                <span class="help is-danger"><?php echo $password_err; ?></span>
                            </div>
                            <div class="field">
                                <label class="label">Подтверждение пароля</label>
                                <input class="input" type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                                <span class="help is-danger"><?php echo $confirm_password_err; ?></span>
                            </div>
                            <div class="field">
                                <input class="button is-link" type="submit" value="Зарегистрироваться">
                            </div>
                            <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
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