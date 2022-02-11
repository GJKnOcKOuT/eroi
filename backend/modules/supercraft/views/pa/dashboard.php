<?php
/**
 * @User GJKnOcKOuT
 * @Project eroi
 * @Date 10/02/2022
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $controller backend\modules\supercraft\controllers\PaController */
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\supercraft\models\PaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $this yii\web\View */
/* @var $model backend\modules\supercraft\models\ProcessoAziendale */
/* @var $dashboard backend\modules\supercraft\models\dashboard */

$this->title = 'Processo Aziendale';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="processo-aziendale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('I Miei progetti', ['dashboard', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Opportunità', ['opportunita', 'id_processo_aziendale' => $model->id_processo_aziendale], ['class' => 'btn btn-danger']) ?>

    </p>
    <p>
        <?= Html::button("In Corso", $controller->inCorso()) ?>
        <?= Html::button("Archiviati", $controller->archiviati()) ?>
    </p>
    <aside><?= Html::a('Crea Processo Aziendale', ['create'], ['class' => 'btn btn-success']) ?></aside>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=

    $dashboard->grid($dataProvider, $searchModel);
    ?>


</div>
