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
        <li class="navbar__item"><a href="#" class="navbar__link active">Товары</a></li>
        <li class="navbar__item"><a href="orders" class="navbar__link">Продажи</a></li>
        <li class="navbar__item"><a href="users" class="navbar__link">Пользователи</a></li>
      </ul>
    </div>
    <div class="wrapper__content content">
      <ul class="content__list">
        <?php foreach($products as $product): ?>
          <li class="content__item product" onclick="ShowModal(this);">
            <div class="product__title"><?php echo $product['product_name'] . '[' . $product['id'] . ']' ?></div>
            <div class="product__count"><?php echo $product['in_stock']; ?></div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="modal" style="display: none; opacity: 0;">
    <div class="modal__wrapper">
      <div class="modal__close" onclick="HideModal();">
        <span></span>
        <span></span>
      </div>
      <div class="modal__product modal-product">
        <div class="modal-product__left">
          <img src="/media/product.jpg" alt="" class="modal-product__image" onclick="SelectImage(this);">
          <input type="file" class="modal-product__image-upload" style="display: none;" onchange="SendImage(this);">
        </div>
        <div class="modal-product__right">
          <div class="modal-product__name">
            <input style="font-size: 32px" oninput="UpdateInputLength(this); UpdateData(this, 'name');" size="6" class="modal-product__title" value="Продукт">
            <span class="modal-product__id">[1]</span>
          </div>
          <textarea oninput="UpdateTextAreaLength(this); UpdateData(this, 'description')" class="modal-product__description" rows="1">Описание продукта</textarea>
          <div class="modal-product__buy-price">
            <span class="modal-product__price-description">Цена покупки: </span>
            <input style="font-size: 24px;" oninput="UpdateInputLength(this); UpdateProfit(); UpdateData(this, 'buy_price');" size="2" class="modal-product__price red" value="300">
            <span class="modal-product__price-currency red">₽</span>
          </div>
          <div class="modal-product__sell-price">
            <span class="modal-product__price-description">Цена продажи: </span>
            <input style="font-size: 24px;" oninput="UpdateInputLength(this); UpdateProfit(); UpdateData(this, 'sell_price');" size="2" class="modal-product__price green" value="400">
            <span class="modal-product__price-currency green">₽</span>
          </div>
          <div class="modal-product__profit">
            <span class="modal-product__price-description">Прибыль: </span>
            <input style="font-size: 24px;" oninput="UpdateInputLength(this);" size="2" class="modal-product__price green" value="100" readonly>
            <span class="modal-product__price-currency green">₽</span>
          </div>
          <div class="modal-product__count">
            <span class="modal-product__span">Осталось: </span>
            <span class="modal-product__less" onclick="DecreaseCounter(this);">
              <span></span>
            </span>
            <input class="modal-product__number" size="1" oninput="UpdateInputLength(this); UpdateData(this, 'count');" value="5" style="width: 12px; font-size: 24px;">
            <span class="modal-product__more" onclick="IncreaseCounter(this);">
              <span></span>
              <span></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo $view_url; ?>/js/jquery.js"></script>
  <script src="<?php echo $view_url; ?>/js/admin.js"></script>
</body>
</html>