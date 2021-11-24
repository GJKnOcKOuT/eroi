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
 * @package    arter\amos\admin\views\first-access-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \arter\amos\admin\models\UserProfile $model
 */

?>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <h4><?= AmosAdmin::tHtml('amosadmin', "#faw_finish_text_1", [
                    'name' => $model->nome,
                    'lastname' => $model->cognome,
                ]) ?></h4>
            <h4><?= AmosAdmin::tHtml('amosadmin', "#faw_finish_text_2", [
                    'appName' => Yii::$app->name,
                ]) ?></h4>
            <h4><?= AmosAdmin::tHtml('amosadmin', "#faw_finish_text_3", [
                    'textBtn' => AmosAdmin::tHtml('amosadmin', 'Enter'),
                    'appName' => Yii::$app->name,
                ]) ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::a(AmosAdmin::tHtml('amosadmin', 'Enter'), ['/dashboard'], ['class' => 'btn btn-primary pull-right']) ?>
        </div>
    </div>
</div>
