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
 * @package    arter\amos\best\practice\views\best-practice
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\notificationmanager\forms\NewsWidget;
use arter\amos\best\practice\Module;

/**
 * @var yii\web\View $this
 * @var \arter\amos\best\practice\models\BestPractice $model
 */

?>
<div class="listview-container">
    <div class="<?= Yii::$app->controller->id ?> post-horizonatal">
        <div class="post-header media nop col-xs-12 col-sm-7">
            <?= ItemAndCardHeaderWidget::widget([
                'model' => $model,
                'publicationDateField' => 'created_at'
            ]) ?>
        </div>
        <div class="col-xs-12 nop">
            <div class="post-content col-xs-12 nop">
                <div class="post-title col-xs-10">
                    <h2><?= Html::a($model->getTitle(), $model->getFullViewUrl()); ?></h2>
</div>
<!--                <div class=" widget-body-content  nop ">-->
                    <?= NewsWidget::widget(['model' => $model]); ?>
                    <?= ContextMenuWidget::widget([
                        'model' => $model,
                        'actionModify' => $model->getFullUpdateUrl(),
                        'actionDelete' => $model->getFullDeleteUrl(),
                        'labelDeleteConfirm' => Module::t('amosbestpractice', 'Sei sicuro di voler cancellare questa best practice?'),
                    ]) ?>
<!--                    --><?php
//                    $reportModule = \Yii::$app->getModule('report');
//                    if (isset($reportModule) && in_array($model->className(), $reportModule->modelsEnabled)) {
//                        echo \arter\amos\report\widgets\ReportDropdownWidget::widget([
//                            'model' => $model,
//                        ]);
//                    }
//                    ?>
<!--                </div>-->
                <div class="clearfix"></div>
                <div class="row nom post-wrap">
                    <div class="post-text col-xs-12">
                        <p>
                            <?= $model->synthesis ?>
                            <?= Html::a(Module::tHtml('amospartnershipprofiles', 'Read all'), $model->getFullViewUrl(), [
                                'class' => 'underline',
                                'title' => Module::t('amospartnershipprofiles', 'Read the partnership profile')
                            ]) ?>
                        </p>
                    </div>
                </div>
                <!--
                <div class="post-footer col-xs-12 nop">
                    <div class="post-info">
                        <?= PublishedByWidget::widget([
                            'model' => $model,
                            'layout' => '{status}'
                        ]) ?>
                    </div>
                    <?php if (isset($statsToolbar) && $statsToolbar): ?>
                        <?= StatsToolbar::widget(['model' => $model]); ?>
                    <?php endif; ?>

                </div>
                -->
            </div>
        </div>
    </div>
</div>
