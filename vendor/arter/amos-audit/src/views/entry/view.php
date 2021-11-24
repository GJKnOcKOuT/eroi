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


/** @var View $this */
/** @var Panel[] $panels */
/** @var Panel $activePanel */
/** @var AuditEntry $model */

use arter\amos\audit\Audit;
use arter\amos\audit\components\panels\Panel;
use arter\amos\audit\models\AuditEntry;

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

foreach ($panels as $panel) {
    $panel->registerAssets($this);
}

$this->title = Yii::t('audit', 'Entry #{id}', ['id' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Audit'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('audit', 'Entries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = '#' . $model->id;

echo Html::tag('h1', $this->title);
?>
    <div class="row">
        <div class="col-md-6">
            <?php
            echo Html::tag('h2', Yii::t('audit', 'Request'), ['id' => 'entry', 'class' => 'hashtag']);

            if ($model->request_method == 'CLI') {
                $attributes = [
                    'route',
                    'request_method',
                ];
            } else {
                $attributes = [
                    [
                        'label' => $model->getAttributeLabel('user_id'),
                        'value' => Audit::getInstance()->getUserIdentifier($model->user_id),
                        'format' => 'raw',
                    ],
                    'ip',
                    'route',
                    'request_method',
                    [
                        'label' => $model->getAttributeLabel('ajax'),
                        'value' => $model->ajax ? Yii::t('audit', 'Yes') : Yii::t('audit', 'No'),
                    ],
                ];
            }

            echo DetailView::widget([
                'model' => $model,
                'attributes' => $attributes
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?php
            echo Html::tag('h2', Yii::t('audit', 'Profiling'), ['id' => 'entry', 'class' => 'hashtag']);

            $attributes = [
                ['attribute' => 'duration', 'format' => 'decimal'],
                ['attribute' => 'memory_max', 'format' => 'shortsize'],
                'created',
            ];

            echo DetailView::widget([
                'model' => $model,
                'attributes' => $attributes
            ]);
            ?>
        </div>
    </div>

<?php Pjax::begin(['id' => 'audit-panels', 'timeout' => 0]); ?>
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                <?php
                foreach ($panels as $id => $panel) {
                    $label = '<i class="glyphicon glyphicon-chevron-right"></i>' . $panel->getLabel();
                    echo Html::a($label, ['view', 'id' => $model->id, 'panel' => $id], [
                        'class' => $panel === $activePanel ? 'list-group-item active' : 'list-group-item',
                    ]);
                }
                ?>
            </div>
        </div>
        <div class="col-md-10">
            <?php if ($activePanel) { ?>
                <?= $activePanel->getDetail(); ?>
                <input type="hidden" name="panel" value="<?= $activePanel->id ?>"/>
            <?php } ?>
        </div>
    </div>
<?php Pjax::end(); ?>