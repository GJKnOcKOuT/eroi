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

/**
 * @var yii\web\View $this
 * @var cornernote\workflow\manager\models\form\StatusForm $model
 */

use yii\helpers\Html;

$this->title = $model->status->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('workflow', 'Workflow'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => $model->status->workflow->id, 'url' => ['default/view', 'id' => $model->status->workflow->id]];
$this->params['breadcrumbs'][] = $model->status->id;
?>
<div class="workflow-status-update">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
