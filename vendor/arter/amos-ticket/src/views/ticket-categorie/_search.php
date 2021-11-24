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
 * @package    arter\amos\ticket\views\ticket-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use kartik\select2\Select2;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\utility\TicketUtility;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\search\TicketCategorieSearch $model
 * @var yii\widgets\ActiveForm $form
 */

$enableAutoOpenSearchPanel = !isset(\Yii::$app->params['enableAutoOpenSearchPanel']) || \Yii::$app->params['enableAutoOpenSearchPanel'] === true;

?>

<div class="ticket-categorie-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><h2><?= AmosTicket::t('amosticket', 'Cerca per') ?>:</h2></div>
    <?php
    $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]);
    ?>
    <?= Html::hiddenInput("enableSearch", $enableAutoOpenSearchPanel); ?>
    <?= Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView')); ?>
    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'titolo') ?>
    </div>
    <div class="col-sm-6 col-lg-4">
        <?php
        $data = ArrayHelper::map(TicketUtility::getTicketCategories()->orderBy('titolo')->all(), 'id', 'nomeCompleto');
        echo $form->field($model, 'categoria_padre_id')->widget(Select2::className(), [
                'data' => $data,
                'options' => ['placeholder' => AmosTicket::t('amosticket', 'Cerca per categoria ...')],
                'pluginOptions' => [
                    'tags' => true,
                    'allowClear' => true,
                ],
            ]
        );
        ?>
    </div>

    <div class="col-xs-12">
        <div class="pull-right">
            <?php /*   <?= Html::resetButton(AmosTicket::t('amosticket', 'Annulla'), ['class' => 'btn btn-secondary']) ?> */ ?>
            <?= Html::a(AmosTicket::t('amosticket', 'Annulla'), [Yii::$app->controller->action->id, 'currentView' => Yii::$app->request->getQueryParam('currentView')], ['class' => 'btn btn-secondary'])
            ?>
            <?= Html::submitButton(AmosTicket::t('amosticket', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>

    <!--a><p class="text-center">Ricerca avanzata<br>
        < ?=AmosIcons::show('caret-down-circle');?>
    </p></a-->
    <?php ActiveForm::end(); ?>
</div>
