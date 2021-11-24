<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\views\layouts\parts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;

/** @var bool|false $disablePlatformLinks  - if true all the links to dashboard, settings, etc are disabled */
$disablePlatformLinks = isset($this->params['disablePlatformLinks']) ? $this->params['disablePlatformLinks'] : false;

$logo = isset(Yii::$app->params['logo'])?
    Html::img( Yii::$app->params['logo'], [
        'class' => 'img-responsive logo-amos',
        'alt' => 'logo '. Yii::$app->name
    ])
    : '<p>'.Yii::$app->name.'</p>';
$logoUrl = $disablePlatformLinks ? null : Yii::$app->homeUrl;
$logoOptions = [];
$title = isset(Yii::$app->params['logo'])?  \arter\amos\core\module\BaseAmosModule::t('amoscore', 'vai alla home page') : Yii::$app->name;
$logoOptions['title'] = $title;
if(!isset(Yii::$app->params['logo'])){
    $logoOptions['class'] = 'title-text';
}
?>

<div class="container">

    <?= Html::a($logo, $logoUrl, $logoOptions); ?>

    <?php if (isset(Yii::$app->params['logo-text']) ): ?>
        
        <p class="title-text">  <?= Yii::$app->params['logo-text'] ?></p>
        
    <?php endif; ?>

    <?php if (isset(Yii::$app->params['logo-signature'])): ?>
        <?php
        $signature = Html::img(Yii::$app->params['logo-signature'], [
            'class' => 'img-responsive signature pull-right',
            'alt' => \arter\amos\core\module\BaseAmosModule::t('amoscore', 'logo firma')
        ]);
        ?>
        <?php if($disablePlatformLinks): ?>
            <?= $signature ?>
        <?php else: ?>
            <?=
            Html::a( $signature, [Yii::$app->homeUrl,],  ['title' => \arter\amos\core\module\BaseAmosModule::t('amoscore', 'vai alla home page')]);
            ?>
        <?php endif;?>
    <?php endif; ?>
</div>