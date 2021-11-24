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
 * @package    arter\amos\organizzazioni\views\profilo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\comuni\widgets\helpers\AmosComuniWidget;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var \arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\organizzazioni\models\ProfiloSedi $modelSedi
 * @var bool $isView
 */

?>

<div class="col-xs-10">
    <?= $form->field($modelSedi, 'address_text')->textInput(['maxlength' => true]) ?>
</div>
<div class="col-xs-2">
    <?= $form->field($modelSedi, 'cap_text')->textInput(['maxlength' => true]) ?>
</div>
<?= AmosComuniWidget::widget([
    'form' => $form,
    'model' => $modelSedi,
    // TODO COUNTRIES DISABLED decommentare la sezione della nazione se si devono abilitare le nazioni nell'indirizzo
//    'nazioneConfig' => [
//        'attribute' => 'country_id',
//        'class' => 'col-lg-4 col-sm-4'
//    ],
    'provinciaConfig' => [
        'attribute' => 'province_id',
        'class' => 'col-lg-4 col-sm-4'
    ],
    'comuneConfig' => [
        'attribute' => 'city_id',
        'class' => 'col-lg-4 col-sm-4'
    ]
]); ?>
