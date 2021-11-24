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
 * @package    arter\amos\notificationmanager\views\newsletter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\forms\SortModelsWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\interfaces\NewsletterInterface;
use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;
use arter\amos\notificationmanager\controllers\NewsletterController;
use arter\amos\notificationmanager\models\NewsletterContents;
use arter\amos\notificationmanager\models\NewsletterContentsConf;
use kartik\alert\Alert;
use yii\base\NotSupportedException;
use yii\db\ActiveQuery;

/**
 * @var yii\web\View $this
 * @var arter\amos\notificationmanager\models\Newsletter $model
 * @var yii\widgets\ActiveForm $form
 */

/** @var NewsletterController $appController */
$appController = Yii::$app->controller;

?>

<div class="newsletter-form col-xs-12 nop">
    <?php
    $form = ActiveForm::begin([
        'options' => [
            'id' => 'newsletter_form_id',
            'enctype' => 'multipart/form-data', // important
        ]
    ]);
    ?>
    
    <?php $this->beginBlock('general'); ?>
    <div class="row">
        <div class="col-md-10 col xs-12">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <?php if ($model->isNewRecord): ?>
            <div class="col-xs-12">
                <?= Alert::widget([
                    'type' => Alert::TYPE_WARNING,
                    'body' => AmosNotify::t('amosnotify', '#alert_new_newsletter'),
                    'closeButton' => false
                ]); ?>
            </div>
        <?php else: ?>
            <?php
            $newsletterContentsConfs = $appController->getAllNewsletterContentsConfs();
            $btnAssociaLabelPrefix = AmosNotify::t('amosnotify', '#manage');
            $newsletterId = $model->id;
            ?>
            <?php foreach ($newsletterContentsConfs as $conf): ?>
                <?php
                /** @var NewsletterContentsConf $conf */
                $confId = $conf->id;
                
                /** @var Record $contentConfModel */
                $contentConfModel = Yii::createObject($conf->classname);
                if (!($contentConfModel instanceof NewsletterInterface)) {
                    throw new NotSupportedException("La classe " . $conf->classname . " non implementa la NewsletterInterface");
                }
                $contentConfModelTable = $contentConfModel::tableName();
                
                /** @var NewsletterContents $newsletterContentsModel */
                $newsletterContentsModel = $appController->notifyModule->createModel('NewsletterContents');
                $newsletterContentsTable = $newsletterContentsModel::tableName();
                
                $queryContent = $model->getContentsModelsByConfQuery($conf);
                
                /** @var ActiveQuery $queryIndexes */
                $queryIndexes = clone $queryContent;
                $queryIndexes->select([$contentConfModelTable . '.id']);
                $queryIndexes->indexBy($newsletterContentsTable . '.order');
                $indexes = $queryIndexes->column();
                $firstItem = reset($indexes);
                $lastItem = end($indexes);
                
                $modelLabel = $appController->makeModelLabel($contentConfModel);
                $btnAssociaLabel = $appController->makeManageContentsTitle($contentConfModel, $btnAssociaLabelPrefix, $modelLabel);
                
                $actionColumnButtons = [
                    'sortButtons' => function ($url, $model, $key) use ($firstItem, $lastItem, $confId, $newsletterId) {
                        /** @var Record $model */
                        $isFirst = ($key == $firstItem);
                        $isLast = ($key == $lastItem);
                        return SortModelsWidget::widget([
                            'model' => $model,
                            'sortUrl' => [
                                '/notify/newsletter/order-content',
                                'newsletterId' => $newsletterId,
                                'confId' => $confId
                            ],
                            'sortPermissionToCheck' => 'NEWSLETTER_UPDATE',
                            'isFirst' => $isFirst,
                            'isLast' => $isLast
                        ]);
                    }
                ];
                ?>
                <div class="col-xs-12 m-b-20">
                    <h3><?= ucfirst(strtolower($modelLabel)) ?></h3>
                    <?= M2MWidget::widget([
                        'model' => $model,
                        'modelId' => $newsletterId,
                        'modelData' => $queryContent,
                        'overrideModelDataArr' => true,
                        'targetUrlParams' => [
                            'viewM2MWidgetGenericSearch' => true,
                            'confId' => $confId,
                        ],
                        'gridId' => 'm2m-grid-' . $contentConfModelTable,
                        'btnAssociaLabel' => $btnAssociaLabel,
                        'targetUrl' => '/notify/newsletter/associa-m2m',
                        'moduleClassName' => AmosNotify::className(),
                        'targetUrlController' => 'newsletter',
                        'permissions' => [
                            'add' => 'NEWSLETTER_MANAGER',
                        ],
                        'actionColumnsTemplate' => '{sortButtons}{deleteRelation}',
                        'actionColumnsButtons' => $actionColumnButtons,
                        'itemsMittente' => $contentConfModel->newsletterContentGridViewColumns(),
                        'itemMittenteDisableColumnsOrder' => true
                    ]); ?>
                </div>
                <?php
                unset($queryContent);
                ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock(); ?>
    
    <?php
    $itemsTab[] = [
        'label' => AmosNotify::t('amosnotify', 'General'),
        'content' => $this->blocks['general'],
    ];
    ?>
    
    <?= Tabs::widget([
        'encodeLabels' => false,
        'items' => $itemsTab
    ]); ?>
    
    <?= RequiredFieldsTipWidget::widget() ?>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget([
        'model' => $model
    ]); ?>
    <?php ActiveForm::end(); ?>
</div>
