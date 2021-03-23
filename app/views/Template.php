<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <title>Чатики</title>
    <link href='../../js/style.css' rel='stylesheet'>
</head>

<body>

<div class="header">
</div>

<div class="main">
    <div class="leftColomn">
        <div class="link"><a href="index.php">Main</a></div>
        <div class="link"><a href="index.php?page=jira">Jira</a></div>
        <div class="link"><a href="index.php?page=pact">Pact</a></div>
        <div class="link"><a href="index.php?page=errorCode">Errors</a></div>
    </div>

    <div class="center">
        <?php
            app\core\Route::buildRoute($_GET);
        ?>
    </div>

    <div class="rightColomn">
        right
    </div>
</div>

</body>
</html>