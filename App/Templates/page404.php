<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404</title>
    <link rel="stylesheet" href="<?php echo $path ?>css/main.css" type="text/css" />
</head>

<body>
    <div class="container">
        
        <div class="container-wripper">

            <header class="header">
                <div class="logo">LOGO</div>
                <a href="<?php echo $homePath?>">Домой</a>
            </header>

            <div class="page404">
                Нет такой страницы. Перейти на &nbsp;<a href="<?php echo $homePath?>"> Домашнюю страницу</a>
            </div>

        </div>

        <?php echo $footer ?>
    </div>

</body>
<script>
    const view = 'page404';
</script>
<script src="<?php echo $path ?>js/main.js" type="text/javascript"></script>       
</html>