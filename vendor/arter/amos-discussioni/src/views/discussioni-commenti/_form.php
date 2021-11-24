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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\discussioni\AmosDiscussioni;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniCommenti $model
 * @var yii\widgets\ActiveForm $form
 */


if (isset($_GET['DiscussioniCommenti'])) {
    
    if (isset($_GET['DiscussioniCommenti']['discussioni_risposte_id'])) {
        $model->discussioni_risposte_id = $_GET['DiscussioniCommenti']['discussioni_risposte_id'];
    }
}

$this->title = AmosDiscussioni::t('amosdiscussioni', 'Commenta la risposta di {rispostaCreatedUserProfile}', [
    'rispostaCreatedUserProfile' => $model->getDiscussioniRisposte()->one()->createdUserProfile,
]);

$this->params['breadcrumbs'][] = [
    'label' =>
        $model->getDiscussioniRisposte()->one()->getDiscussioniTopic()->one()->titolo,
    'url' => [
        '/discussioni/discussioni-topic/partecipa',
        'id' => $model->getDiscussioniRisposte()->one()->getDiscussioniTopic()->one()->id
    ]];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="discussioni-commenti-form col-xs-12">
    
    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>
    <?php $this->beginBlock('dettagli'); ?>

    <div class="col-xs-12 nop">
        
        <?= $form->field($model, 'testo')->textarea(['rows' => 6]) ?>
    </div>

    <div class="col-xs-12 nop" style="display: none">
        <?php
        if ($model->discussioni_risposte_id) {
            echo $form->field($model, 'discussioni_risposte_id')->hiddenInput();
        } else {
            echo $form->field($model, 'discussioni_risposte_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(arter\amos\discussioni\models\DiscussioniRisposte::find()->all(), 'id', 'testo'),
                ['prompt' => AmosDiscussioni::t('amosdiscussioni', 'Seleziona')]
            );
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('dettagli'); ?>
    
    <?php $itemsTab[] = [
        'label' => AmosDiscussioni::t('amosdiscussioni', 'Dettagli '),
        'content' => $this->blocks['dettagli'],
    ];
    ?>
    
    <?= Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
