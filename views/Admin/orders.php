<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo $view_url; ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo $view_url; ?>/fonts/fonts.css">
  <title>Admin Panel</title>
</head>
<body>
  <div class="wrapper">
    <div class="wrapper__header header">
      <ul class="header__navbar navbar">
        <li class="navbar__item"><a href="products" class="navbar__link">Товары</a></li>
        <li class="navbar__item"><a href="#" class="navbar__link active">Продажи</a></li>
        <li class="navbar__item"><a href="users" class="navbar__link">Пользователи</a></li>
      </ul>
    </div>
    <div class="wrapper__content content"></div>
  </div>
</body>
</html>