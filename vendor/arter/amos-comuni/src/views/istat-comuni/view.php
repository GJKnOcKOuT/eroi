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
use arter\amos\comuni\AmosComuni;

/**
 * @var yii\web\View $this
 * @var arter\amos\comuni\models\IstatComuni $model
 */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Comuni', 'url' => ['/comuni/dashboard/index']];
$this->params['breadcrumbs'][] = ['label' => 'Elenco comuni', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="istat-comuni-view col-xs-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            'progressivo',
            'nome_tedesco',
            'cod_ripartizione_geografica',
            'ripartizione_geografica',
            'comune_capoluogo_provincia:statosino',
            'cod_istat_alfanumerico',
            'codice_2006_2009',
            'codice_1995_2005',
            'codice_catastale',
            'popolazione_20111009',
            'codice_nuts1_2010',
            'codice_nuts2_2010',
            'codice_nuts3_2010',
            'codice_nuts1_2006',
            'codice_nuts2_2006',
            'codice_nuts3_2006',
            'soppresso:statosino',
            'istatUnioneDeiComuni.nome',
            'istatRegioni.nome',
            'istatProvince.nome',
        ],
    ]) ?>

    <div class="btnViewContainer pull-right">
        <?= Html::a(AmosComuni::t('amoscomuni', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?>    </div>

</div>
