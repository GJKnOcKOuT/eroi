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
 * @package    @vendor/arter/amos-community/src/views 
 * @author     Elite Division S.r.l.
 */
/**
* @var yii\web\View $this
* @var arter\amos\community\models\CommunityUserFieldDefaultVal $model
*/

$this->title = Yii::t('amoscore', 'Crea', [
    'modelClass' => 'Community User Field Default Val',
]);
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/community']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Community User Field Default Val'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="community-user-field-default-val-create">
    <?= $this->render('_form', [
    'model' => $model,
    'fid' => NULL,
    'dataField' => NULL,
    'dataEntity' => NULL,
    ]) ?>

</div>
