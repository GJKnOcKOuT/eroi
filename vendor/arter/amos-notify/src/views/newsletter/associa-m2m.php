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

use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\interfaces\NewsletterInterface;
use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;
use arter\amos\notificationmanager\controllers\NewsletterController;

/**
 * @var yii\web\View $this
 * @var \arter\amos\notificationmanager\models\Newsletter $model
 */

/** @var NewsletterController $appController */
$appController = Yii::$app->controller;

$newsletterConf = $appController->getNewsletterConf();
$confClassname = $newsletterConf->classname;

/** @var Record|NewsletterInterface $contentConfModel */
$contentConfModel = $newsletterConf->getContentConfModel();

$this->title = $appController->makeManageContentsTitle($contentConfModel);
$this->params['breadcrumbs'][] = $this->title;

?>

<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $model->getNewsletterContentsByContentConfIdQuery($newsletterConf->id), // query degli elementi selezionati
    'modelDataArrFromTo' => [
        'from' => 'content_id',
        'to' => 'content_id'
    ],
    'modelTargetSearch' => [
        'class' => $confClassname,
        'query' => $appController->getAssociaM2mQuery($contentConfModel), // query generale di tutti gli elementi
    ],
    'gridId' => 'newsletter-grid',
    'viewSearch' => (isset($viewM2MWidgetGenericSearch) ? $viewM2MWidgetGenericSearch : false),
    'targetUrlController' => 'newsletter',
    'moduleClassName' => AmosNotify::className(),
    'targetColumnsToView' => $contentConfModel->newsletterSelectContentsGridViewColumns(),
]);
