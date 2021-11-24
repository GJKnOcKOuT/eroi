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
 * @package    arter\amos\notificationmanager\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\interfaces\ContentModelInterface;
use arter\amos\core\interfaces\ViewModelInterface;
use arter\amos\core\record\Record;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\events\AmosEvents;

/**
 * @var Record|ContentModelInterface|ViewModelInterface $model
 * @var \arter\amos\admin\models\UserProfile $profile
 * @var Record[] $arrayModels
 */
if (!empty($profile)) {
    $this->params['profile'] = $profile;
}

/** @var AmosEvents $eventsModule */
$eventsModule = AmosEvents::instance();
/** @var \arter\amos\events\models\Event $eventModel */
$eventModel = $eventsModule->createModel('Event');

$closestEvent = $eventModel::find()
    ->andWhere(['>', 'begin_date_hour', date('Y-m-d h:s:i')])
    ->orderBy('begin_date_hour ASC')->one();


?>

<div style="box-sizing:border-box;color:#000000;background-color: #414149;width: 100%;">
    <table border="0" cellspacing="0" style="padding:5px 0;background-color: #414149;" align="center">
        <tr>
            <td width="600px">
                <h1 style="color:#ffffff;font-size:1.2em;margin:0;padding: 10px 0;">
                    <?= 'Eventi'?>
                </h1>
            </td>
        </tr>
    </table>
</div>

<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;">

    <div style="padding:0;margin:0">
        <h3 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">
            <?= Html::a($closestEvent->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($closestEvent->getFullViewUrl()), ['style' => 'color: #297A38;']) . ' PROSSIMO'?>
        </h3>
    </div>
    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000;">
        <?= $closestEvent->getDescription(true); ?>
    </div>
    <div style="box-sizing:border-box;padding-bottom: 5px;">
        <div style="margin-top:20px; display: flex; padding: 10px;">
            <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                <?php
                $layout = '{publisher}';
                if ($closestEvent instanceof  arter\amos\cwh\base\ModelContentInterface) {
                    $layout = '{publisher}{publishingRules}{targetAdv}';
                }
                $user = $closestEvent->createdUserProfile;
                ?>

                <?php if (!is_null($user)): ?>
                    <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                        'model' => $user,
                        'onlyAvatar' => true,
                        'absoluteUrl' => true
                    ])
                    ?>
                <?php endif; ?>
            </div>

            <div style="margin-left: 20px; max-width: 430px;">
                <?= \arter\amos\core\forms\PublishedByWidget::widget([
                    'model' => $closestEvent,
                    'layout' => $layout,
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php foreach ($arrayModels as $model){
    if($model->id != $closestEvent->id) {  ?>
    <div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;">

        <div style="padding:0;margin:0">
            <h3 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">
                <?= Html::a($model->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #297A38;']) ?>
            </h3>
        </div>
        <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000;">
            <?= $model->getDescription(true); ?>
        </div>
        <div style="box-sizing:border-box;padding-bottom: 5px;">
            <div style="margin-top:20px; display: flex; padding: 10px;">
                <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                    <?php
                    $layout = '{publisher}';
                    if ($model instanceof  arter\amos\cwh\base\ModelContentInterface) {
                        $layout = '{publisher}{publishingRules}{targetAdv}';
                    }
                    $user = $model->createdUserProfile;
                    ?>

                    <?php if (!is_null($user)): ?>
                        <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                            'model' => $user,
                            'onlyAvatar' => true,
                            'absoluteUrl' => true
                        ])
                        ?>
                    <?php endif; ?>
                </div>

                <div style="margin-left: 20px; max-width: 430px;">
                    <?= \arter\amos\core\forms\PublishedByWidget::widget([
                        'model' => $model,
                        'layout' => $layout,
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<?php } ?>
