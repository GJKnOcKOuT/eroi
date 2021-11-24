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

use arter\amos\core\forms\CreateNewButtonWidget;
use arter\amos\core\views\AmosGridView;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\organizzazioni\Module;
use kartik\alert\Alert;
use yii\data\ActiveDataProvider;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\organizzazioni\models\Profilo $model
 * @var bool $isView
 */

/** @var ProfiloSedi $emptyProfiloSede */
$emptyProfiloSede = Module::instance()->createModel('ProfiloSedi');
$createBtnId = 'create-other-headquarter-btn-id';
$defaultDataConfirm = Module::t('amosorganizzazioni', '#create_profilo_sede_data_confirm_msg');
$deleteMsg = Module::t('amosorganizzazioni', '#delete_headquarter_from_profilo_form_msg');

$js = <<<JS
    $('#$createBtnId').on('click', function(event) {
        event.preventDefault();
        var ok = confirm('$defaultDataConfirm');
        if (ok) {
            window.location.href = $(this).attr('href');
        }
        return false;
    });
    $('.view-headquarter-btn').on('click', function(event) {
        event.preventDefault();
        var ok = confirm('$defaultDataConfirm');
        if (ok) {
            window.location.href = $(this).attr('href');
        }
        return false;
    });
    $('.update-headquarter-btn').on('click', function(event) {
        event.preventDefault();
        var ok = confirm('$defaultDataConfirm');
        if (ok) {
            window.location.href = $(this).attr('href');
        }
        return false;
    });
    $('.delete-headquarter-btn').on('click', function(event) {
        event.preventDefault();
        var ok = confirm("$deleteMsg");
        if (ok) {
            window.location.href = $(this).attr('href');
        }
        return false;
    });
JS;
$this->registerJs($js, View::POS_READY);

?>

<?php if ($model->isNewRecord): ?>
    <?= Alert::widget([
        'type' => Alert::TYPE_WARNING,
        'body' => Module::t('amosorganizzazioni', '#alert_new_headquarters'),
        'closeButton' => false
    ]); ?>
<?php else: ?>
    <?php if (!$isView && \Yii::$app->user->can('PROFILOSEDI_CREATE')): ?>
        <?php
        $createLink = ['/organizzazioni/profilo-sedi/create', 'profiloId' => $model->id];
        ?>
        <div>
            <?= CreateNewButtonWidget::widget([
                'createButtonId' => $createBtnId,
                'urlCreateNew' => $createLink,
                'createNewBtnLabel' => Module::t('amosorganizzazioni', '#create_other_headquarter'),
                'otherBtnClasses' => 'create-other-headquarter-btn-selector'
            ]); ?>
        </div>
    <?php endif; ?>
    <div>
        <?= AmosGridView::widget([
            'dataProvider' => new ActiveDataProvider([
                'query' => $model->getOtherHeadquarters()
            ]),
            'columns' => $emptyProfiloSede->getGridViewColumns(!$isView)
        ]); ?>
    </div>
<?php endif; ?>
