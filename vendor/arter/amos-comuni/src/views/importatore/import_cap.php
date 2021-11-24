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
use arter\amos\core\forms\ActiveForm;
use kartik\builder\Form;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;


$this->title = Yii::t('cruds', 'Aggiorna CAP');
$this->params['breadcrumbs'][] = ['label'=>'comuni', 'url'=>'/comuni'];
$this->params['breadcrumbs'][] = $this->title;
?>



<?php $form = ActiveForm::begin(); ?>
<?php $this->beginBlock('principale'); ?>

<?php $this->endBlock('principale'); ?>
<?php $itemsTab[] = [
    'label' => '',
    'content' => $this->blocks['principale'],
];
?>

<?= Tabs::widget(
    [
        'encodeLabels' => false,
        'items' => $itemsTab
    ]
);
?>



<legend>Dati che andrebbero aggiornati: (totale comuni: <?= count($dati);?>)</legend>

<div class="row">
    <div class="col-xs-4"><strong>Comune Nome</strong></div>
    <div class="col-xs-8"><strong>CAP da inserire</strong></div>
</div>


<?php
if( empty($dati)): ?>
    <div class="row"><div class="col-xs-4">Nessun comune da aggiornare</div></div>
<?php
else:

    foreach ( $dati as $k => $array_data ): ?>
        <div class="row">
            <div class="col-xs-4"><?= $array_data['comuneArray']['nome']; ?></div>
            <div class="col-xs-8"><?= implode(', ', $array_data['new_caps']); ?></div>
        </div>

    <?php endforeach; ?>
<?php endif; ?>

<div class="floatclear"></div>
<?php echo Html::input('hidden', 'confirm', true); ?>


<div class="m-t-30">

    <?php
    if( !empty($dati)):
        echo Html::submitButton('Genera', ['name'=> 'submit', 'value'=> true, 'class' => 'btn btn-primary'] );
    endif; ?>
<?php ActiveForm::end(); ?>

</div>


