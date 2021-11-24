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


use arter\amos\core\forms\ActiveForm;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\AmosGridView;
use arter\amos\core\views\DataProviderView;
use arter\amos\dashboard\AmosDashboard;
use yii\helpers\Html;

/* * @var \arter\amos\dashboard\models\AmosUserDashboards $currentDashboard * */
/* * @var \arter\amos\dashboard\models\AmosWidgets $widgetIconSelectable * */
/* * @var \arter\amos\dashboard\models\AmosWidgets $widgetGraphicSelectable * */
/* * @var array $widgetSelected * */

/* * @var \yii\web\View $this * */
AmosIcons::map($this);
$this->params['widgetSelected'] = $widgetSelected;
$this->params['checkedByDefault'] = true;

?>
<div class="dashboard-default-index">

    <div class="col-xs-12">
        <!--<h2>< ?= AmosDashboard::tHtml('amosdashboard', 'Plugins'); ?></h2>-->
        <?= Html::tag('h2', AmosDashboard::t('amosdashboard', 'Plugins'), ['class' => 'subtitle-form']) ?>
    </div>

    <div class="plugin-list dashboard-content">
        <?= \arter\amos\core\views\ListView::widget( [
                'dataProvider' => $providerIcon,
                'itemOptions' => ['class' => 'col-xs-12 col-sm-6 col-md-2 col-lg-2 flex-column-item'],
                'itemView' => '@vendor/arter/amos-community/src/views/configure-dashboard/_icon',
            ]
        )?>

        <div class="col-xs-12">
            <!--<h2>< ?= AmosDashboard::tHtml('amosdashboard', 'Widget'); ?></h2>-->
            <?= Html::tag('h2', AmosDashboard::t('amosdashboard', 'Widget'), ['class' => 'subtitle-form']) ?>
        </div>

        <?=
        AmosGridView::widget([
            'dataProvider' => $providerGraphic,
            'summary' => false,
            'columns' => [
//                [
//                    'attribute' => 'module',
//                    'label' => 'Plugin',
//                ],
                [
                    'class' => 'arter\amos\core\views\grid\CheckboxColumn',
                    'name' => 'amosWidgetsIds[]',
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        return [
                            'id' => \yii\helpers\StringHelper::basename($model['classname']),
                            'value' => $model['id'],
                            'checked' => empty($this->params['widgetSelected']) ? true : in_array($model['id'], $this->params['widgetSelected'])
                        ];
                    }
                ],
                [
                    'label' => 'Icona',
                    'contentOptions' => ['class' => 'icona'],
                    'format' => 'html',
                    'value' => function ($model) {
                        $backgrounColor = 'color-border-mediumBase';
                        return '<p class="'.$backgrounColor.'">'.AmosIcons::show('view-web').'</p>';
                    }
                ],
                [
                    'label' => 'Nome',
                    'format' => 'html',
                    'attribute' => 'classname',
                    'value' => function ($model) {
                        $object = \Yii::createObject($model['classname']);
                        return $object->getLabel();
                    }
                ],
                [
                    'label' => 'Descrizione',
                    'value' => function ($model) {
                        $object = \Yii::createObject($model['classname']);
                        return $object->getDescription();
                    }
                ],
            ]
        ]);
        ?>
    </div>
</div>




