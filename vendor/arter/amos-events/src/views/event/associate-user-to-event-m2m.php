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

use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\helpers\Html;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\Event;
use arter\amos\events\models\search\EventSearch;
use arter\amos\events\widgets\JoinEventWidget;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * @var yii\web\View $this
 * @var \arter\amos\events\models\Event $model
 */

$this->title = AmosEvents::t('amosevents', '#add_to_event');
$this->params['breadcrumbs'][] = $this->title;

$userId = Yii::$app->request->get("id");
$communityTable = Community::tableName();
$communityUserMmTable = CommunityUserMm::tableName();
$eventTable = Event::tableName();

/** @var AmosEvents $eventsModule */
$eventsModule = AmosEvents::instance();
/** @var Event $eventModel */
$eventModel = $eventsModule->createModel('Event');
/** @var EventSearch $eventSearchModel */
$eventSearchModel = $eventsModule->createModel('EventSearch');

/** @var ActiveQuery $queryJoined */
$queryJoined = $eventModel::find();
$queryJoined->select([$eventTable . '.id']);
$queryJoined->innerJoin($communityTable, new Expression('`' . $communityTable . '`.`id` = `' . $eventTable . '`.`community_id` AND `' . $communityTable . '`.`deleted_at` IS NULL'));
$queryJoined->innerJoin($communityUserMmTable, '`' . $communityTable . '`.`id` = `' . $communityUserMmTable . '`.`community_id` AND `' . $communityUserMmTable . '`.`deleted_at` IS NULL');
$queryJoined->andWhere([$communityUserMmTable . '.user_id' => $userId]);
//pr($queryJoined->createCommand()->getRawSql());
$alreadyJoinedEventIds = $queryJoined->column();

/** @var ActiveQuery $query */
$query = $eventSearchModel->searchAllQuery([]);
$query->andWhere(new Expression('`' . $eventTable . '`.`community_id` IS NOT NULL'));
$query->andWhere(['not in', $eventTable . '.id', $alreadyJoinedEventIds]);
//pr($query->createCommand()->getRawSql());

$post = Yii::$app->request->post();
if (isset($post['genericSearch'])) {
    $query->andFilterWhere(['like', Event::tableName() . '.title', $post['genericSearch']]);
}
//pr($query->createCommand()->getRawSql());die();
$eventLogoLabel = $eventModel->getAttributeLabel('eventLogo');

?>
<?= M2MWidget::widget([
    'model' => $model,
    'modelId' => $model->id,
    'modelData' => $query,
    'modelDataArrFromTo' => [
        'from' => 'id',
        'to' => 'id'
    ],
    'modelTargetSearch' => [
        'class' => $eventsModule->model('Event'),
        'query' => $query,
    ],
    'targetFooterButtons' => Html::a(AmosEvents::t('amosevents', 'Close'), Yii::$app->urlManager->createUrl([
        '/events/event/annulla-m2m',
        'id' => $userId
    ]), ['class' => 'btn btn-secondary', 'AmosOrganizzazioni' => AmosEvents::t('amosevents', 'Close')]),
    'renderTargetCheckbox' => false,
    'viewSearch' => (isset($viewM2MWidgetGenericSearch) ? $viewM2MWidgetGenericSearch : false),
    'targetUrlController' => 'event',
    'targetActionColumnsTemplate' => '{joinOrganization}',
    'moduleClassName' => AmosEvents::className(),
    'postName' => 'Event',
    'postKey' => 'event',
    'targetColumnsToView' => [
        [
            'label' => $eventLogoLabel,
            'format' => 'html',
            'value' => function ($model) use ($eventLogoLabel) {
                /** @var Event $model */
                $url = $model->getEventsImageUrl('square_large');
                $contentImage = Html::img($url, ['class' => 'gridview-image', 'alt' => $eventLogoLabel]);
                return $contentImage;
            }
        ],
        'title',
        [
            'class' => 'arter\amos\core\views\grid\ActionColumn',
            'template' => '{info}{view}{joinEvent}',
            'buttons' => [
                'joinEvent' => function ($url, $model) use ($userId) {
                    return JoinEventWidget::widget(['model' => $model, 'userId' => $userId, 'isGridView' => true]);
                }
            ]
        ]
    ]
]);
?>
