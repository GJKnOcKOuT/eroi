<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\news\AmosNews;
?>
<?php /** @var $model \arter\amos\news\models\base\News */?>

    <div class="col-xs-12">
        <div class="col-xs-12 news-image">
            <?php
            $url = '/img/img_default.jpg';
            if (!is_null($model->newsImage)) {
                $url = $model->newsImage->getWebUrl('square_medium', false, true);
            }
            $contentImage = Html::img($url, [
                'class' => 'img-responsive',
                'alt' => 'image'
            ]);
            ?>
            <?= $contentImage ?>
        </div>
        <div class="col-xs-12 news-title">
            <h1><?= $model->titolo?></h1>
        </div>
        <div class="col-xs-12 news-subtitle">
            <h2><?= $model->sottotitolo?></h2>
        </div>
        <div class="col-xs-12 news-abstract">
            <p><?= $model->descrizione_breve?></p>
        </div>
        <div class="col-xs-12 news-description">
            <p><?= $model->descrizione?></p>
        </div>
        <?php if(\Yii::$app->getModule('sitemanagement') ){
            $url = \amos\sitemanagement\widgets\SMContainerWidget::getUrlContentModel($model)?>
            <div class="col-xs-12 news-read-all">
                <p><?= Html::a(AmosNews::t('amosnews', 'Leggi tutto'), $url) ?></p>
            </div>
        <?php } else { ?>
            <div class="col-xs-12 news-read-all">
                <p><?= Html::a(AmosNews::t('amosnews', 'Leggi tutto'), $model->getFullViewUrl()) ?></p>
            </div>
        <?php } ?>
    </div>
