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
 * @package    arter\amos\admin\views\layouts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**@var $this \yii\web\View */
/**@var $content string */

use arter\amos\core\helpers\Html;
use yii\widgets\Breadcrumbs;

AmosRapidAsset::register($this);

?>


<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>

    <?php $this->beginBody() ?>

    <div class="container">
        <?php if (isset($this->params['breadcrumbs'])) { ?>
            <div class="breadcrumbs">
                <?= Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'],
                ]) ?>
            </div>
        <?php } ?>

        <h1><?= $this->title ?></h1>

        <?= $content ?>

        <div class="clearfix"></div>

    </div>


    <div class="clearfix"></div>

    <footer class="text-center">
        <hr>
        <?= date('Y-m-d H:i:s'); ?>

    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>