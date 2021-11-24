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

/*
 * @var yii\web\View $this
 */

use cornernote\workflow\manager\models\Workflow;
use yii\bootstrap\Nav;
use yii\helpers\Html;

$this->title = Yii::t('workflow', 'Workflow');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="workflow-default-index">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <?php
    $items = [
        [
            'label' => '<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('workflow', 'Create'),
            'url' => ['create'],
            'encode' => false,
        ],
    ];
    foreach (Workflow::find()->orderBy(['id' => SORT_ASC])->all() as $workflow) {
        /** @var Workflow $workflow */
        $items[] = [
            'label' => $workflow->id,
            'url' => ['view', 'id' => $workflow->id],
            'linkOptions' => ['style' => 'color:#fff;background:' . $workflow->getColor()],
        ];
    }
    echo Nav::widget([
        'items' => $items,
        'options' => ['class' => 'nav-pills'],
    ]);
    ?>

</div>
