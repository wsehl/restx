<?php
session_start();
if ($_SESSION["admin"] == true) {
    function users()
    {
        require_once "core/config.php";
        $query = "SELECT * FROM `users` ORDER BY `id` ASC";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

        if ($result) {
            $rows = mysqli_num_rows($result);
            echo "<table class='uk-table borders'>
                            <tr class='borders'>
                                <th class='borders'>ID</th>
                                <th class='borders'>Логин</th>
                                <th class='borders'>Пароль</th>
                                <th class='borders'>Создан</th>
                            </tr>";
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result);
                echo "<tr class='borders'>";
                for ($j = 0; $j < 4; ++$j) echo "<td class='borders'>$row[$j]</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        }
        mysqli_close($link);
    }

    function orders()
    {
        require_once "core/mail_config.php";
        $query = "SELECT * FROM `orders` ORDER BY `id` ASC";
        $result = mysqli_query($conn, $query) or die("Ошибка " . mysqli_error($conn));

        if ($result) {
            $rows = mysqli_num_rows($result);
            echo "<table class='uk-table'>
                        <tr class='borders'>
                            <th class='borders'>ID</th>
                            <th class='borders'>Заказ</th>
                        </tr>";
            for ($i = 0; $i < $rows; ++$i) {
                $row = mysqli_fetch_row($result);
                echo "<tr class='borders'>";
                for ($j = 0; $j < 2; ++$j) echo "<td class='borders'>$row[$j]</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        }
        mysqli_close($conn);
    }
} else {
    header("location: login.php");
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Админка</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.1/dist/css/uikit.min.css" />
    <style>
        body {
            color: #666;
            font: 14px/24px "Open Sans", "HelveticaNeue-Light",
                "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial,
                "Lucida Grande", Sans-Serif;
        }

        .borders {
            border: 1px solid #CECFD5;
        }

        .tabs-nav li {
            float: left;
            width: 50%;
        }

        .tabs-nav li:first-child a {
            border-right: 0;
            border-top-left-radius: 6px;
        }

        .tabs-nav li:last-child a {
            border-top-right-radius: 6px;
        }

        a {
            background: #eaeaed;
            border: 1px solid #cecfd5;
            color: #0087cc;
            display: block;
            font-weight: 600;
            padding: 10px 0;
            text-align: center;
            text-decoration: none;
        }

        a:hover {
            color: #ff7b29;
            text-decoration: none;
        }

        .tab-active a {
            background: #fff;
            border-bottom-color: transparent;
            color: #2db34a;
            cursor: default;
        }

        .tabs-stage {
            border: 1px solid #cecfd5;
            border-radius: 0 0 6px 6px;
            border-top: 0;
            clear: both;
            padding: 24px 30px;
            position: relative;
            top: -1px;
        }
    </style>
</head>

<body>
    <div class="uk-container">
        <article class="uk-article">
            <h1 class="uk-article-title">
                <a class="uk-link-reset" style="cursor:default;">Админ панель</a>
            </h1>
            <a class="uk-button uk-button-danger uk-width-1-1" href="logout.php">Выйти</a>
        </article>
        <div class="tabs">
            <ul class="tabs-nav" style="width: 100%; margin-left: -30px;">
                <li><a href="#tab-1">Заказы</a></li>
                <li><a href="#tab-2">Пользователи</a></li>
            </ul>
            <div class="tabs-stage">
                <div id="tab-1">
                    <p>
                        <?php
                        orders();
                        ?>
                    </p>
                </div>
                <div id="tab-2">
                    <p>
                        <?php
                        users();
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".tabs-stage div").hide();
        $(".tabs-stage div:first").show();
        $(".tabs-nav li:first").addClass("tab-active");
        $(".tabs-nav a").on("click", function(event) {
            event.preventDefault();
            $(".tabs-nav li").removeClass("tab-active");
            $(this).parent().addClass("tab-active");
            $(".tabs-stage div").hide();
            $($(this).attr("href")).show();
        });
    </script>
</body>

</html>