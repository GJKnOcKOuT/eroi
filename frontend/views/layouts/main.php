<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */
use app\assets\ResourcesAsset;
use luya\helpers\Url;
use app\modules\seo\frontend\behaviors\LuyaSeoBehavior;
use luya\cms\widgets\LangSwitcher;

$assetBundle = ResourcesAsset::register($this);

/* @var $this luya\web\View */
/* @var $content string */
$this->attachBehavior('seo', LuyaSeoBehavior::className());
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->composition->language; ?>">
    <!-- HEAD -->
    <?= $this->render('parts/_head', [
        'assetBundle' => $assetBundle,
        'title' => $this->title,
        'head' => $this->head()
    ]) ?>
    <body class="layout-main">
    <?php $this->beginBody() ?>

    <!-- NAVBAR -->
    <?= $this->render('parts/_navbar', [
        'assetBundle' => $assetBundle
    ]) ?>
    <!-- END: NAVBAR -->

    <div class="container">
        <!-- BREADCRUMB -->
<!--        < ?= $this->render('parts/_breadcrumb') ?>-->
        <!-- END: BREADCRUMB -->
    </div>

    <div class="content">
        <?= $content; ?>
    </div>

    <!-- FOOTER -->
    <?= $this->render('parts/_footer', [
        'assetBundle' => $assetBundle
    ]) ?>
    <!-- END: FOOTER -->

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
