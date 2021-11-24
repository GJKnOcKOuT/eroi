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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;
use backend\components\views\AmosGridView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\upload\models\FilemanagerMediafileSearch $searchModel
*/

$this->title = Yii::t('amosupload', 'Filemanager Mediafiles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filemanager-mediafile-index">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?php /* echo         Html::a(Yii::t('amosupload', 'Nuovo {modelClass}', [
    'modelClass' => 'Filemanager Mediafile',
])        , ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

            <?php Pjax::begin(); echo AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'filename',
            'type',
            'url:ntext',
            'alt:ntext',
//            'size', 
//            'description:ntext', 
//            'thumbs:ntext', 
//            'created_at', 
//            'updated_at', 

        [
        'class' => 'backend\components\views\grid\ActionColumn',
        ],
        ],
        ]); Pjax::end(); ?>
    
</div>
