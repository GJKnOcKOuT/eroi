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
use arter\amos\comuni\models\IstatComuni;
use arter\amos\core\forms\editors\Select;
use yii\helpers\ArrayHelper;

//id del campo: se specificato nelle option uso quello, altrimenti sarà nel formato 'campo_db-id'
$comuneAttribute = $comuneConfig['attribute'];
$id = isset($comuneConfig['options']['id']) ? $comuneConfig['options']['id'] : $comuneAttribute.'-id';

?>

<div class="<?= isset($comuneConfig['class']) ? $comuneConfig['class'] : 'col-md-' . $colMdRow;?>">
    <?= $form->field($model, 'commune_id')->widget(Select::classname(), [
        'options' =>  array_merge(
            [
                'id' => $id,
                'placeholder' => AmosComuni::t('amoscomuni', '#select_commune_placeholder'),
            ], !empty($comuneConfig['options']) ? $comuneConfig['options'] : []
        ),
        'pluginOptions' => array_merge(
            [
                'allowClear' => true
            ], !empty($comuneConfig['pluginOptions']) ? $comuneConfig['pluginOptions'] : []
        ),
        'data' => ArrayHelper::map(IstatComuni::find()->orderBy('nome')->asArray()->all(), 'id', 'nome')
    ]); ?>
</div>


