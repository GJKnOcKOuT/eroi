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
 * @package    arter\amos\partnershipprofiles\views\partnership-profiles
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\views\AmosGridView;
use arter\amos\partnershipprofiles\Module;

/**
 * @var \yii\web\View $this
 * @var yii\data\ArrayDataProvider $dataProvider
 * @var string $currentView
 */

$this->title = Module::t('amospartnershipprofiles', 'Create project group');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::beginForm('', 'post'); ?>
<div class="<?= Yii::$app->controller->id ?>-create-project-group">
    <?= AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'name' => 'selectedUsers',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    $checkboxOptions = [
                        'value' => $model['id'],
                        'checked' => true,
                    ];
                    return $checkboxOptions;
                }
            ],
            'userProfile.nomeCognome'
        ]
    ]);
    ?>
    <div class="m-t-30 italic">
        <?= Module::t('amospartnershipprofiles', '#create_project_group_end') ?>
    </div>
    <div class="bk-btnFormContainer">
        <?= Html::submitButton(Module::t('amospartnershipprofiles', 'Create work group'), ['class' => 'btn btn-navigation-primary']); ?>
    </div>
</div>
<?= Html::endForm(); ?>
