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
use arter\amos\videoconference\assets\VideoconferenceAsset;

/**
* @var yii\web\View $this
* @var arter\amos\videoconference\models\Videoconf $model
*/


VideoconferenceAsset::register($this);

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Videoconferenza'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="videoconf-view col-xs-12">
    <span id="videoconf-id" style="display:none"><?=$model->id?></span>
  <div id="meet" style="height: 600px;"></div>

    <div class="btnViewContainer pull-right">
        <?= Html::a(Yii::t('amoscore', 'Chiudi'), ['/videoconference/videoconf/index'], ['class' => 'btn btn-secondary','id' => "meeting-end"]); ?>    </div>

</div>
