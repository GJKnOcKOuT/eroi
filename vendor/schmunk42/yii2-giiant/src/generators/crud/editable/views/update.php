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


use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/*
 * @var yii\web\View $this
 * @var yii\gii\generators\crud\Generator $generator
 */

$urlParams = $generator->generateUrlParams();
$model = new $generator->modelClass();
$model->setScenario('crud');
$className = $model::className();
$modelName = StringHelper::basename($model::className());

echo "<?php\n";
?>

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var <?= ltrim($generator->modelClass, '\\') ?> $model
* @var string $relAttributes relation fields names for disabling
*/
if(!isset($relAttributes)){
    $relAttributes = false;
}

$this->title = Yii::t('<?= $generator->messageCategory ?>', '<?= StringHelper::basename($className) ?>') . $model-><?= $generator->getNameAttribute(
) ?> . ', ' . <?= $generator->generateString('Edit') ?>;
$this->params['breadcrumbs'][] = ['label' => Yii::t('<?= $generator->messageCategory ?>', '<?=Inflector::pluralize(StringHelper::basename($className)) ?>'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model-><?= $generator->getNameAttribute(
) ?>, 'url' => ['view', <?= $urlParams ?>]];
$this->params['breadcrumbs'][] = <?= $generator->generateString('Edit') ?>;
?>
<div class="giiant-crud <?= Inflector::camel2id(StringHelper::basename($generator->modelClass), '-', true) ?>-update">

    <h1>
        <?= "<?= Yii::t('{$generator->messageCategory}', '{$modelName}') ?>" ?>

        <small>
            <?php $label = StringHelper::basename($generator->modelClass); ?>
            <?= '<?= $model->'.$generator->getModelNameAttribute($generator->modelClass).' ?>' ?>
        </small>
    </h1>

    <div class="crud-navigation">
        <?= '<?= ' ?>Html::a('<span class="glyphicon glyphicon-eye-open"></span> ' . <?= $generator->generateString(
            'View'
        ) ?>, ['view', <?= $urlParams ?>], ['class' => 'btn btn-default']) ?>
    </div>

    <hr />

    <?= '<?php ' ?>echo $this->render('_form', [
        'model' => $model,
        'relAttributes' => $relAttributes,
    ]); ?>

</div>
