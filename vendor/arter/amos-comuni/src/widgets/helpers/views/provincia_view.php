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

use arter\amos\comuni\AmosComuni;

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

//id del campo: se specificato nelle option uso quello, altrimenti sarà nel formato 'campo_db-id'
$provinciaAttribute = $provinciaConfig['attribute'];
$id = isset($provinciaConfig['options']['id']) ? $provinciaConfig['options']['id'] : $widget->generateFieldId($model, $provinciaAttribute);

?>

<div class="<?= isset($provinciaConfig['class']) ? $provinciaConfig['class'] : 'col-md-' . $colMdRow; ?>">
    <?= $form->field($model, $provinciaAttribute)->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\arter\amos\comuni\models\IstatProvince::find()->orderBy('nome')->asArray()->all(), 'id', 'nome'),
        'options' => array_merge(
            [
                'placeholder' => AmosComuni::t('amoscomuni', '#select_province_placeholder'),
                'id' => $id,
            ], !empty($provinciaConfig['options']) ? $provinciaConfig['options'] : []
        ),
        'pluginOptions' => array_merge(
            [
                'allowClear' => true
            ], !empty($provinciaConfig['pluginOptions']) ? $provinciaConfig['pluginOptions'] : []
        ),
    ]);
    ?>
</div>
