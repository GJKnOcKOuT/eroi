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
 * @package    arter\amos\comuni\widgets\helpers\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\comuni\models\IstatNazioni;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/**
 * @var \arter\amos\comuni\widgets\helpers\AmosComuniWidget $widget
 * @var \arter\amos\core\forms\ActiveForm $form
 * @var \arter\amos\core\record\Record $model
 * @var array $nazioneConfig
 * @var array $provinciaConfig
 * @var array $comuneConfig
 * @var array $capConfig
 * @var string $colMdRow
 */

$nazioneAttribute = $nazioneConfig['attribute'];
$provinciaAttribute = $provinciaConfig['attribute'];
$comuneAttribute = $comuneConfig['attribute'];
$capAttribute = $capConfig['attribute'];

//id del campo: se specificato nelle option uso quello, altrimenti sarà nel formato 'campo_db-id'
$id = isset($nazioneConfig['options']['id']) ? $nazioneConfig['options']['id'] : $widget->generateFieldId($model, $nazioneAttribute);
$provincia_id = isset($provinciaConfig['options']['id']) ? $provinciaConfig['options']['id'] : $widget->generateFieldId($model, $provinciaAttribute);
$comune_id = isset($comuneConfig['options']['id']) ? $comuneConfig['options']['id'] : $widget->generateFieldId($model, $comuneAttribute);
$cap_id = isset($capConfig['options']['id']) ? $capConfig['options']['id'] : $widget->generateFieldId($model, $capAttribute);

?>

<div class="<?= isset($nazioneConfig['class']) ? $nazioneConfig['class'] : 'col-md-' . $colMdRow; ?>">
    <!-- nazione italia attiva la provincia -->
    <?= $form->field($model, $nazioneAttribute)->widget(Select2::classname(), [
        'data' => ArrayHelper::map(IstatNazioni::find()->orderBy('nome')->asArray()->all(), 'id', 'nome'),
        'options' => array_merge(
            [
                'placeholder' => Yii::t('app', 'Digita il nome della nazione'),
                'id' => $id,
            ], !empty($nazioneConfig['options']) ? $nazioneConfig['options'] : []
        ),
        'pluginOptions' => array_merge(
            [
                'allowClear' => true
            ], !empty($nazioneConfig['pluginOptions']) ? $nazioneConfig['pluginOptions'] : []
        ),
    ]); ?>
    <?php
    $script = <<< JS
    setTimeout( function(){
        cleanSelectByNazione( $("#{$id}").val(), "{$provincia_id}", "{$comune_id}", "{$cap_id}"  );
        
        $("#{$id}").on('change', function(){
            cleanSelectByNazione( $(this).val(), "{$provincia_id}", "{$comune_id}", "{$cap_id}"  );
        });
        
    }, 150);
JS;
    $this->registerJs($script);
    ?>
</div>
