<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile
 * @category   CategoryName
 */

use arter\amos\admin\AmosAdmin;
use yii\bootstrap\Button;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use backend\models\Settings;
use kartik\form\ActiveForm;

/**
 * @var yii\web\View $this
 * @var Settings $model
 */

$this->title = ucfirst($model->name);
$this->params['breadcrumbs'][] = ['label' => AmosAdmin::t('amosplatform', 'Platform Configurator'), 'url' => ['/admin/settings']];
$this->params['breadcrumbs'][] = AmosAdmin::t('amosplatform', 'Update');
/**
 * @param $model
 * @param ActiveForm $form
 * @return string
 */
function actionsBar($model, $form)
{
    return '
    <div class="details_card">
        <div class="profile row nom">
            <div class="col-xs-12">
                ' . \arter\amos\core\helpers\Html::a(\arter\amos\core\icons\AmosIcons::show('check') .
            ' ' .
            AmosAdmin::t('amosplatform', 'Add Value'),
            Yii::$app->urlManager->createUrl(['/settings/add-value', 'id' => $model->id]),
            ['class' => 'btn btn-primary pull-right']
        ) .
        $form->field($model, "[{$model->id}]enabled")->widget(\kartik\widgets\SwitchInput::classname())->label(false) .
        '
            </div>
        </div>
    </div>';
}

/**
 * @param $model
 * @param ActiveForm $form
 * @return string
 */
function getSubs($model, $form, $enabled = true)
{
    $result = "";

    if ($model->type == 'array') {
        $subs = Settings::findAll([
            'route' => $model->route . $model->name . '/'
        ]);
        $result .= '<h4>' . ucfirst($model->name) . '</h4>';
        $result .= actionsBar($model, $form);
        $result .= '<hr>';

        foreach ($subs as $sub) {
            $result .= Html::tag('div', getSubs($sub, $form, $enabled), ['class' => 'col-sm-offset-1']);
        }
    } else {
        $result .= '<h5><b>' . ucfirst($model->name) . '</b></h5>';

        $result .= '<div class="col-sm-4">';
        $result .= $form->field($model, "[{$model->id}]value")->textInput();
        $result .= '</div>';

        $result .= '<div class="col-sm-4">';
        $result .= $form->field($model, "[{$model->id}]type")->dropDownList([
            'boolean' => 'Boolean',
            'integer' => 'Integer',
            'double' => 'Double',
            'float' => 'Float',
            'string' => 'String',
            'array' => 'Array',
            'NULL' => 'NULL',
        ]);
        $result .= '</div>';

        $result .= '<div class="col-sm-4">';
        $result .= $form->field($model, "[{$model->id}]enabled")->widget(\kartik\widgets\SwitchInput::classname());
        $result .= '</div>';

        $result = Html::tag('div', $result, ['class' => 'col-sm-12']);
    }

    return $result;
}

?>
    <hr>
    <h3><?= AmosAdmin::t('amosplatform', ucfirst($model->name) . ' Node Update'); ?></h3>
    <hr>
<?php
$form = ActiveForm::begin([
    'options' => [
        'class' => 'default-form col-xs-12 nop',
    ]
]);

echo getSubs($model, $form, $model->enabled);

echo \arter\amos\core\forms\CloseSaveButtonWidget::widget();

ActiveForm::end(); ?>