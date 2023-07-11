<div class="container">
        
        <div class="container-wripper">
        <div class="content">
 
<?php foreach ($productsGroups as $groupKey => $groupValue): ?>
    <?php if($groupValue['visibility'] == 1): ?>
        <h3><?php echo $groupValue['name'] ?></h3>

        <?php foreach ($products as $productKey => $productValue): ?>
            <?php if($productValue['groups_id'] == $groupValue['id']): ?>

                <div class="product">
                    <?php if($productValue['groups_id'] == $groupValue['id']):?>
                        <?php if(isset($productValue['image'])):?>
                            <?php echo ' <div class="product-img"><img src="/img/products/'.$productValue['image'].'"></div>' ?>
                        <?php endif ?>
                        <div class="product-about">
                            <h4><?php echo $productValue['name'] ?></h4>
                            <p><?php echo $productValue['description'] ?></p>
                            <div>
                                <div class="selectButton-wrapper">
                                    <button class="addButton" data-id="<?php echo $productValue['id'] ?>">Добавить в корзину</button>
                                    <div class="added-wrapper hidden" data-id="<?php echo $productValue['id'] ?>">
                                        <input class="product-count" type="number" size="2" name="num" min="0" max="50" value="0" data-id="<?php echo $productValue['id'] ?>" readonly>
                                        <button class="removeButton" data-id="<?php echo $productValue['id'] ?>">-</button>
                                    </div>
                                </div>
                                <div class="cartButton-wrapper">
                                    <button class="cartButton hidden">Перейти в корзину</button>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            <?php endif ?>
        <?php endforeach ?>

        <hr>
    <?php endif ?>
<?php endforeach ?>