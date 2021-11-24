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


use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;
use arter\amos\videoconference\models\Videoconf;

/**
 * @var yii\web\View $this
 * @var arter\amos\videoconference\models\Videoconf $model
 */
$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Videoconferenza'), 'url' => ['index']];
$this->params['breadcrumbs'] []= '';
?>
<div class="videoconf-view col-xs-12">


    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:html',
            [
                'label' => 'Num. Partecipanti',
                'value' => function ($model) {
                    return count($model->videoconfUsersMms);
                }
            ],
            [
                'attribute' => 'begin_date_hour',
                'format' => [
                    'date',
                    (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'php:d-m-Y H:i'
                ],
                'visible' => ($model->status == Videoconf::STATUS_FUTURE),
            ],
            [
                'attribute' => 'end_date_hour',
                'format' => ['date', (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A'],
                'visible' => ($model->status == Videoconf::STATUS_FUTURE),
            ],
            [
                'attribute' => 'notification_before_conference',
                'visible' => ($model->status == Videoconf::STATUS_FUTURE),
            ],
          
            [
                'label' => \Yii::t('app', 'Utenti partecipanti'),
                'format' => 'html',
                'value' => function($model) {
                            $participants = "";
                            foreach ($model->videoconfUsersMms as $user) {
                                $participants .= $user->userProfile . "<br>";
                            }
                            return $participants;
                        }
            ],
        ],
    ])
    ?>

    <div class="btnViewContainer pull-right">
<?= Html::a(Yii::t('amoscore', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?>    </div>

</div>
