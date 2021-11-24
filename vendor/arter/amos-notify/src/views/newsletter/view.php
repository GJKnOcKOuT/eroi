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

use arter\amos\core\forms\CloseButtonWidget;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\core\interfaces\ModelLabelsInterface;
use arter\amos\core\interfaces\NewsletterInterface;
use arter\amos\core\record\Record;
use arter\amos\core\views\AmosGridView;
use arter\amos\notificationmanager\controllers\NewsletterController;
use arter\amos\notificationmanager\models\Newsletter;
use arter\amos\notificationmanager\models\NewsletterContents;
use arter\amos\notificationmanager\models\NewsletterContentsConf;
use yii\base\NotSupportedException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * @var yii\web\View $this
 * @var \arter\amos\notificationmanager\models\Newsletter $model
 */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = $this->title;

/** @var NewsletterController $appController */
$appController = Yii::$app->controller;

/** @var NewsletterContentsConf $newsletterContentsConfModel */
$newsletterContentsConfModel = $appController->notifyModule->createModel('NewsletterContentsConf');
$newsletterContentsConfs = $newsletterContentsConfModel::find()->orderBy(['order' => SORT_ASC])->all();

?>
<div class="event-room-view col-xs-12 m-t-5">
    <div class="row">
        <div class="col-xs-12 m-b-5">
            <?= ContextMenuWidget::widget([
                'model' => $model,
                'actionModify' => $model->getFullUpdateUrl(),
                'actionDelete' => $model->getFullDeleteUrl()
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="header col-xs-12 nop">
            <div class="title col-xs-12">
                <h2 class="title-text"><?= $model->subject ?></h2>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($newsletterContentsConfs as $conf): ?>
            <?php
            /** @var NewsletterContentsConf $conf */
            /** @var Record $contentConfModel */
            $contentConfModel = Yii::createObject($conf->classname);
            if (!($contentConfModel instanceof NewsletterInterface)) {
                throw new NotSupportedException("La classe " . get_class($contentConfModel) . " non implementa la NewsletterInterface");
            }
            $contentConfModelTable = $contentConfModel::tableName();
            $modelLabel = '';
            if (($contentConfModel instanceof ModelLabelsInterface) && (($modelGrammar = $contentConfModel->getGrammar()) instanceof ModelGrammarInterface)) {
                $modelLabel = $modelGrammar->getModelLabel();
            }
            
            /** @var Newsletter $newsletterModel */
            $newsletterModel = $appController->notifyModule->createModel('Newsletter');
            $newsletterTable = $newsletterModel::tableName();
            
            /** @var NewsletterContents $newsletterContentsModel */
            $newsletterContentsModel = $appController->notifyModule->createModel('NewsletterContents');
            $newsletterContentsTable = $newsletterContentsModel::tableName();
            
            /** @var ActiveQuery $queryContent */
            $queryContent = $contentConfModel::find();
            $queryContent->innerJoin($newsletterContentsTable, $newsletterContentsTable . '.content_id = ' . $contentConfModelTable . '.id');
            $queryContent->innerJoin($newsletterTable, $newsletterTable . '.id = ' . $newsletterContentsTable . '.newsletter_id');
            $queryContent->andWhere([$newsletterContentsTable . '.deleted_at' => null]);
            $queryContent->andWhere([$newsletterTable . '.deleted_at' => null]);
            $queryContent->andWhere([$newsletterContentsTable . '.newsletter_contents_conf_id' => $conf->id]);
            $queryContent->andWhere([$newsletterContentsTable . '.newsletter_id' => $model->id]);
            $queryContent->orderBy([$newsletterContentsTable . '.order' => SORT_ASC]);
            $dataProvider = new ActiveDataProvider(['query' => $queryContent, 'sort' => false]);
            ?>
            <div class="col-xs-12 m-b-20">
                <hr>
                <h3><?= ucfirst(strtolower($modelLabel)) ?></h3>
                <?= AmosGridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $contentConfModel->newsletterContentGridViewColumns()
                ]) ?>
            </div>
            <?php
            unset($queryContent);
            ?>
        <?php endforeach; ?>
    </div>
    <?= CloseButtonWidget::widget([
        'urlClose' => $appController->getUrlClose()
    ]); ?>
</div>
