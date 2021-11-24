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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;

/**
 * @var yii\web\View $this
 * @var arter\amos\community\models\Community $model
 */

$this->title = strip_tags($model);
$this->params['breadcrumbs'][] = ['label' => AmosCommunity::t('amoscommunity', 'Community'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => strip_tags($model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosCommunity::t('amoscommunity', 'Update');
?>
<div class="community-update">

    <?= $this->render('_form', [
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
        'visibleOnEdit' => $visibleOnEdit,
        'tabActive' => $tabActive
    ]) ?>

</div>
