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
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

/**
* @var yii\web\View $this
* @var arter\amos\upload\models\FilemanagerOwners $model
*/

$this->title = $model->mediafile_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amosupload', 'Filemanager Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filemanager-owners-view">

    <?= DetailView::widget([
    'model' => $model,
    'condensed'=>false,
    'hover'=>true,
    'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
    'panel'=>[
    'heading'=>$this->title,
    'type'=>DetailView::TYPE_INFO,
    ],
    'attributes' => [
                'mediafile_id',
            'owner_id',
            'owner',
            'owner_attribute',
    ],
    'deleteOptions'=>[
    'url'=>['delete', 'id' => $model->mediafile_id],
    'data'=>[
    'confirm'=>Yii::t('amosupload', 'Are you sure you want to delete this item?'),
    'method'=>'post',
    ],
    ],
    'enableEditMode'=>true,
    ]) ?>

</div>
