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
 * @package    @vendor/arter/amos-email-manager/src/views
 * @author     Elite Division S.r.l.
 */
/**
 * @var yii\web\View $this
 * @var arter\amos\emailmanager\models\EmailView $model
 */

$this->title = Yii::t('amoscore', 'Aggiorna {type} di {module}', [
    'type' => $model->type,
    'module' => $model->module
]);
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/emailmanager']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Email View'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => strip_tags($model), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('amoscore', 'Aggiorna');
?>
<div class="email-view-update">

    <?= $this->render('_form', [
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
    ]) ?>

</div>
