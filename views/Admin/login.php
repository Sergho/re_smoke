<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $view_url; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo $view_url; ?>/fonts/fonts.css">
    <title>Admin login page</title>
</head>
<body>
    <div class="wrapper">
        <form class="wrapper__form form" action="<?php echo $config['host']; ?>/admin/auth" success="<?php echo $config['host']; ?>/admin">
            <h1 class="form__heading">Войти в личный кабинет</h1>
            <p class="form__description">Введите логин и пароль администратора, чтобы войти в систему</p>
            <input type="text" name="name" class="form__input" placeholder="Имя" autocomplete="off">
            <input type="password" name="password" class="form__input" placeholder="Пароль" autocomplete="off">
            <button class="form__submit" type="button">Войти</button>
        </form>
    </div>
    <script src="<?php echo $view_url; ?>/js/jquery.js"></script>
    <script src="<?php echo $view_url; ?>/js/login.js"></script>
</body>
</html>