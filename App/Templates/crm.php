<?php if (isset($in)): ?>
    <?php header("Refresh: 1"); ?>
<?php endif ?>
<?php if (isset($_COOKIE["uid_all"]) && $_COOKIE["uid_all"] == 'lkfOhpodifh8ldjhf8er9fjhksfwi'): ?>
    <div class="allProducts">
        <?php foreach ($orders as $orderKey => $orderValue): ?>
            <div class="allcartProduct" data-id="<?php echo $productValue['id'] ?>">
                <div><?php echo '<u>' . date("d.m.Y H:i:s", strtotime($orderValue['timestamp'])) . '</u> / <b>' . $orderValue['tel'] . '</b> / <i>' . $orderValue['address'] . '</i>' ?></div>
                <?php foreach(json_decode($orderValue['products']) as $key => $value): ?>
                    <?php echo $products[$key]['name'] . ' - <b>' . $value . ' шт</b><br>'?>
                <?php endforeach ?>
                <?php echo '<hr>'?>
            </div>
        <?php endforeach ?>
    </div>
<?php else: ?>
    <form action="crm" method="post">
        Введите пароль
        <input name="allPwd" type="text">
    </form>
<?php endif ?>
    
