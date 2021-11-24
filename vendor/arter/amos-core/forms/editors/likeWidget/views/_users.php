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

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\widgets\ConnectToUserWidget;
use arter\amos\admin\widgets\SendMessageToUserWidget;
use arter\amos\admin\models\UserContact;
use arter\amos\core\helpers\Html;

use yii\helpers\ArrayHelper;

$adminModule = AmosAdmin::instance();
$moduleChat = \Yii::$app->getModule('chat');
$uid = \Yii::$app->user->id;

\yii\widgets\Pjax::begin([
  'id' => 'pjax-container-content-like',
  'timeout' => 2000,
  'enablePushState' => false,
  'enableReplaceState' => false,
  'clientOptions' => ['data-pjax-container' => 'grid-content-like']]);

echo \arter\amos\core\views\AmosGridView::widget([
  'id' => 'grid-content-like',
  'dataProvider' => $dataProvider,
  'columns' => [
    'Photo' => [
      'headerOptions' => [
        'id' => \Yii::t('amoscore', 'Photo'),
      ],
      'contentOptions' => [
        'headers' => \Yii::t('amoscore', 'Photo'),
      ],
      'label' => \Yii::t('amoscore', 'Photo'),
      'format' => 'raw',
      'value' => function ($model) {
        /** @var \arter\amos\admin\models\UserProfile $userProfile */
        $userProfile = $model->user->getProfile();
        return \arter\amos\admin\widgets\UserCardWidget::widget(['model' => $userProfile]);
      }
    ],
    'nomeCognome',
    [
      'class' => arter\amos\core\views\grid\ActionColumn::class,
      'template' => '{connect}',
      'buttons' => [
        'connect' => function($url, $model) use ($adminModule, $userNetwork, $uid, $moduleChat) {
          if ($model->user_id != $uid) {
            if (ArrayHelper::isIn($model->user_id, $userNetwork) === false) {
              
              $status = UserContact::find()
                ->where(['contact_id' => $uid])
                ->andWhere(['user_id' => $model->user_id])
                ->andWhere(['deleted_at' => null])
                ->one();
              
              if (($status) && ($status->status == UserContact::STATUS_INVITED)) {
                return 
                Html::a(\Yii::t('amoscore', 'Rifiuta invito'), 
                ['/admin/user-contact/connect', 'contactId' => $uid, 'userId' => $model->user_id, 'accept' => 0], 
                ['class' => 'btn btn-navigation-primary']
                )
                . Html::a(\Yii::t('amoscore', 'Accetta invito'), 
                ['/admin/user-contact/connect', 'contactId' => $uid, 'userId' => $model->user_id, 'accept' => 1], 
                ['class' => 'btn btn-navigation-primary']
                );
              }
              
              $status = UserContact::find()
                ->where(['user_id' => $uid])
                ->andWhere(['contact_id' => $model->user_id])
                ->one();
                  
              if (($status) && ($status->status == UserContact::STATUS_INVITED)) {
                return Html::tag('em', \Yii::t('amoscore', 'In attesa di accettazione della richiesta'));                        }
              
              return Html::a(\Yii::t('amoscore', 'collegati'), 
                ['/admin/user-contact/connect', 'contactId' => $model->user_id], 
                ['class' => 'btn btn-navigation-primary', 'data-confirm' => Yii::t('amoscore', 'Vuoi collegarti?')]
                );
            } else {
              if(!empty($moduleChat)) {
                return Html::a(
                  \Yii::t('amoscore', 'Invia messaggio'),
                  ['/messages', 'contactId' => $model->user_id],
                  ['class' => 'btn btn-navigation-primary', 'data-confirm' => Yii::t('amoscore', 'Vuoi inviare un messaggio?')]);
              }
            }
          }
        }
      ]
    ],
  ]
]);
\yii\widgets\Pjax::end();