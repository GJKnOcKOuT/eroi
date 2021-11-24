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
 * @package    @backend/modules/aster_een/views 
 * @author     Elite Division S.r.l.
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\datecontrol\DateControl;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var arter\amos\een\models\EenTagS3TagEenMm $model
*/

$this->title = strip_tags($model);
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/modules']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Gestione tabella di conversione TAG EEN in TAG S3 RER'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="een-tag-s3-tag-een-mm-view">

    <?= DetailView::widget([
    'model' => $model,    
    'attributes' => [
            'een_tag_een_id',
            'tag_s3_id',
            'description',
    ],    
    ]) ?>

</div>

<div id="form-actions" class="bk-btnFormContainer pull-right">
    <?= Html::a(Yii::t('amoscore', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?></div>
