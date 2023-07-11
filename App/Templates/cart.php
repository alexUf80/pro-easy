<div class="emptyCart hidden">В корзине нет продуктов</div>
<div class="orderDone hidden">Спасибо за заказ. Перейти на <a href="/">домашнюю страницу</a></div>
    <div class="cartProducts">
    <?php foreach ($products as $productKey => $productValue): ?>
        <div class="cartProduct hidden" data-id="<?php echo $productValue['id'] ?>">
            <?php if(isset($productValue['image'])):?>
                <?php echo '<img src="/img/products/'.$productValue['image'].'">' ?>
            <?php endif ?>
            <div class="cart-wrapper">
                <div><?php echo $productValue['name'] ?></div>
                <div class="selectButton-wrapper">
                    <button class="addButton" style="width: 30px;" data-id="<?php echo $productValue['id'] ?>">+</button>
                    <input class="product-count" type="number" size="2" name="num" min="0" max="50" value="0" data-id="<?php echo $productValue['id'] ?>" readonly>
                    <button class="removeButton" data-id="<?php echo $productValue['id'] ?>">-</button>
                </div>
            </div>
        </div>
    <?php endforeach ?>
    </div>
<form action="cart" method="post" class="popup hidden">
    <div class="popup-group">
        <div>Адрес доставки</div>
        <input class="popup-address" name="popup-address" type="text" placeholder="Введите адрес" >
        <span class="popup-address-span hidden">Введите адрес</span>
    </div>
    <!-- required -->
    <div class="popup-group">
        <div>Номер телефона</div>
        <input class="popup-tel" name="popup-tel" id="popup-tel" type="text" placeholder="Введите номер телефона" >
        <span class="popup-email-span hidden">Введите номер телефона</span>
    </div>
    <input class="popup-prod" name="popup-prod" type="hidden" value="">
    <input class="popup-cap" name="popup-cap" type="hidden" value="q123">
    <button class="popupButton">Оформить</button>
</form>
<script src="https://unpkg.com/imask"></script>