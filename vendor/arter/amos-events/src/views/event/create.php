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
 * @package    arter\amos\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\events\AmosEvents;
use arter\amos\events\models\EventInvitationsUpload;

/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\Event $model
 */

$this->title = AmosEvents::t('amosevents', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = $this->title;

/** @var EventInvitationsUpload $eventInvitationUploadModel */
$eventInvitationUploadModel = AmosEvents::instance()->createModel('EventInvitationsUpload');

?>
<div class="event-create">
<?= $this->render(
    '_form', 
    [
        'model' => $model,
        'upload' => $eventInvitationUploadModel,
        'fid' => null,
        'dataField' => null,
        'dataEntity' => null,
        'moduleCwh' => $moduleCwh,
        'scope' => $scope
    ]) 
?>
</div>
