<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */
use luya\helpers\Url;
?>
<!-- BREADCRUMB -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li><a href="<?= Yii::$app->menu->getHome()->link ?>" title="home page"><span class="sr-only"><?= Yii::$app->menu->getHome()->title?> </span><span class="glyphicon glyphicon-home"></span></a></li>
        <?php foreach (Yii::$app->menu->current->teardown as $item): /* @var $item \luya\cms\menu\Item */ ?>
            <li class="breadcrumb-item">
                <a href="<?= $item->link; ?>"><?= $item->title; ?></a>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
<!-- END: BREADCRUMB -->