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
 * @package    arter\amos\organizzazioni\views\profilo-sedi
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\organizzazioni\models\ProfiloSedi $model
 */

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => Module::t('amosorganizzazioni', 'Profilo Sedi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="profilo-sedi-view col-xs-12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            [
                'attribute' => 'profiloSediType.name',
                'label' => $model->getAttributeLabel('profiloSediType')
            ],
            'addressField:raw',
            'phone',
            'fax',
            'email:email',
            'pec:email',
            [
                'attribute' => 'profilo.name',
                'label' => $model->getAttributeLabel('profilo')
            ],
        ],
    ]) ?>

    <div class="btnViewContainer pull-right">
        <?= Html::a(Module::t('amoscore', 'Chiudi'), Yii::$app->getUser()->getReturnUrl(), ['class' => 'btn btn-secondary']); ?>
    </div>
</div>
