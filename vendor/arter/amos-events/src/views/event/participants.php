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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\community\widgets\CommunityMembersWidget;
use yii\widgets\Pjax;

$this->title = \Yii::t('amoscommunity', 'Participants');
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscommunity', 'Community'), 'url' => ['join', 'id' => $model->community_id]];
$this->params['breadcrumbs'][] = $this->title;

$sendTicketsLabel = \arter\amos\events\AmosEvents::txt('Send tickets');

$this->registerJs(<<<JS
    $(document).on("pjax:timeout", function(event) {

    // Prevent default timeout redirection behavior

    event.preventDefault()

});
JS
    , \yii\web\View::POS_LOAD);

Pjax::begin(['timeout' => 10000, 'id' => 'pjax-participants-widget']);

echo \arter\amos\events\widgets\CommunityEventMembersWidget::widget([
    'model' => $model,
    'targetUrlParams' => [
        'viewM2MWidgetGenericSearch' => true,
    ],
    'checkManagerRole' => true,
    'pjaxId' => 'pjax-participants-widget',
    'pageUrl' => '/events/event/participants?communityId=' . $model->community_id,
    'showAdditionalAssociateButton' => $model->has_tickets,
    'enableAdditionalButtons' => true,
]);

Pjax::end();