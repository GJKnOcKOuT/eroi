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

/**
* @var yii\web\View $this
* @var backend\models\EenExprOfInterest $model
*/

$this->title = Yii::t('cruds', 'Aggiorna {modelClass}', [
    'modelClass' => 'Een Expr Of Interest',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Een Expr Of Interest'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Aggiorna');
?>
<div class="een-expr-of-interest-update">

    <?= $this->render('_form', [
        'model' => $model,
        'modelEenPartenership' => $modelEenPartenership
    ]) ?>

</div>
