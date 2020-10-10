<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<body>
    <nav class="navbar" role="navigation" >
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
                <input type="text" name="search" id="search" placeholder="Найти пиццу" class="input" />
            </a>
            <div class="navbar-dropdown">
                <div id="result"></div>
            </div>
        </div>
    </nav>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                cache: false
            });
            $('#search').keyup(function() {
                $('#result').html('');
                $('#state').val('');
                var searchField = $('#search').val();
                var expression = new RegExp(searchField, "i");
                $.getJSON('data.json', function(data) {
                    $.each(data, function(key, value) {
                        if (value.name.search(expression) != -1 || value.description.search(expression) != -1) {
                            $('#result').append('<a class="navbar-item is-small"><img src="' + value.img + '" height="40" width="40" class="img-thumbnail" /> ' + value.name + ' | <span class="text-muted">' + value.description + '</span> ' + value.cost + '</a><hr class="navbar-divider">');
                        }
                    });
                });
            });
            $('#result').on('click', 'li', function() {
                var click_text = $(this).text().split('|');
                $('#search').val($.trim(click_text[0]));
                $("#result").html('');
            });
        });
    </script>
</body>

</html>