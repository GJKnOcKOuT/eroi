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
 * @package    arter\amos\core\giiamos\crud\default\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/**
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

/** @var \yii\db\ActiveRecord $model */
$model = new $generator->modelClass;
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

$itemsTab = [];


echo "<?php\n";

?>

use arter\amos\core\helpers\Html;
use arter\amos\core\forms\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/**
* @var yii\web\View $this
* @var <?= ltrim($generator->modelClass, '\\') ?> $model
* @var yii\widgets\ActiveForm $form
*/


?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form col-xs-12 nop">

    <?= "<?php " ?>$form = ActiveForm::begin(); <?= " ?>" ?>       


    <?php foreach ($generator->getFormTabsAsArray() as $tabName) { ?>

        <?php $tabNameSanitize = Inflector::slug($tabName); ?>

        <?= "<?php " ?> $this->beginBlock('<?= $tabNameSanitize ?>');<?= " ?>" ?>

        <?php foreach ($generator->getAttributesTab($tabName) as $attribute) { ?>

            <?php
            $column = $model->getTableSchema()->getColumn($attribute);
            if (!get_class($column) || $column == null) {
                continue;
            }
            ?>
            <div class="col-lg-6 col-sm-6">
                <?php
                $prepend = $generator->prependActiveField($attribute, $model);
                $field = $generator->activeField($attribute, $model);
                $append = $generator->appendActiveField($attribute, $model);
                if ($prepend) {
                    echo "\n\t\t\t<?php " . $prepend . " ?>";
                }
                if ($field) {
                    echo "\n\t\t\t<?= " . $field . " ?>";
                }
                if ($append) {
                    echo "\n\t\t\t<?php " . $append . " ?>";
                }
                ?>

            </div>
        <?php } ?>
        <div class="clearfix"></div>
        <?= "<?php " ?> $this->endBlock('<?= $tabNameSanitize ?>');<?= " ?>" ?>


        <?= "<?php " ?>  $itemsTab[] = [
        'label' => Yii::t('<?= $generator->messageCategory ?>', '<?= $tabName ?>'),
        'content' => $this->blocks['<?= $tabNameSanitize ?>'],
        ];
        <?= " ?>" ?>
    <?php } ?>


    <?= "<?= " ?> Tabs::widget(
    [
    'encodeLabels' => false,
    'items' => $itemsTab
    ]
    );
    <?= " ?>" ?>

    <?= "<?= " ?> CloseSaveButtonWidget::widget(['model' => $model]); <?= " ?>" ?>

    <?= "<?php " ?> ActiveForm::end(); <?= " ?>" ?>

</div>
