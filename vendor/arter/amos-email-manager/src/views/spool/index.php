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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\emailmanager\AmosEmail;
use arter\amos\core\views\DataProviderView;
use arter\amos\core\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmailSpoolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = AmosEmail::t('amosemail', 'Email Spools');
$this->params['breadcrumbs'][] = ['label' => AmosEmail::t('amosemail', 'Email Manager'), 'url' => ['/email']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-spool-index">
    <?php echo $this->render('_search', ['model' => $model]); ?>
    <?php echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'transport',
                //'template',
                //'priority',
                [
                    'attribute' => 'status',
                    'headerOptions' => ['style' => 'width:80px'],
                ],
                // 'model_name',
                // 'model_id',
                [
                    'attribute' => 'to_address',
                    'headerOptions' => ['style' => 'width:250px'],
                ],
                [
                    'attribute' => 'from_address',
                    'headerOptions' => ['style' => 'width:250px'],
                ],
                'subject',
                /*[
                    'attribute' => 'message',
                    'format' => 'ntext',
                    'headerOptions' => ['style' => 'width:300px'],
                ],*/
                // 'bcc:ntext',
                // 'files:ntext',
                // 'sent',
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d/m/Y H:i:s'],
                ],
                // 'updated_at',

                ['class' => 'arter\amos\core\views\grid\ActionColumn',
                    'headerOptions' => ['style' => 'width:100px'],
                ],
            ],
        ],

    ]); ?>
</div>
