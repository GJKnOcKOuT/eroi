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
 * @package    arter\amos\notificationmanager\views\newsletter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\notificationmanager\AmosNotify;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\notificationmanager\models\search\NewsletterSearch $model
 * @var yii\widgets\ActiveForm $form
 */


?>
<div class="newsletter-search element-to-toggle" data-toggle-element="form-search">
    <?php
    $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id,
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);
    ?>
    
    <?= Html::hiddenInput("enableSearch", "1") ?>

    <div class="col-xs-12">
        <h2 class="title">
            <?= AmosNotify::txt('Search'); ?>:
        </h2>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'subject')->textInput() ?>
    </div>

    <div class="col-xs-12">
        <div class="pull-right">
            <?= Html::resetButton(AmosNotify::txt('Reset'), ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(AmosNotify::txt('Search'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
