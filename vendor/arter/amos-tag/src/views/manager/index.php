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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\tag\models\Tag;
use kartik\tree\TreeView;
use kartik\tree\Module;
use arter\amos\tag\AmosTag;

$this->title = AmosTag::t('amostag', 'Gestione Tag');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /**
        @todo Add all AM ICONS to iconEditSettings listData property
    */
    .field-tag-icon {
        display: none;
    }
</style>
<div class="tag-form">

    <?= TreeView::widget([
        'headerTemplate' => '<div class="row">
                                    <div class="col-sm-12">
                                        {heading}
                                        {search}
                                    </div>
                                </div>',
        'query' => Tag::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => AmosTag::tHtml('amostag', 'Liste tag')],
        'rootOptions' => ['label' => '<span class="text-primary">' . AmosTag::t('amostag', 'Radice tag') . '</span>'],
        'fontAwesome' => false,
        'isAdmin' => Yii::$app->user->can('AMMINISTRATORE_TAG')? true: false,
        'displayValue' => 1,
        'iconEditSettings' => [
            'show' => 'list',
            /*'listData' => [
                'home' => 'Appartamento',
                'building-o' => 'Condominio',
            ]*/
        ],
        'softDelete' => false,
        'cacheSettings' => ['enableCache' => true],
        'nodeAddlViews' => [
//            Module::VIEW_PART_1 => '',
            Module::VIEW_PART_2 => '@vendor/arter/amos-tag/src/views/manager/custom_fields',
//            Module::VIEW_PART_3 => '',
            Module::VIEW_PART_4 => '@vendor/arter/amos-tag/src/views/manager/roots_advanced',
            //\yii\helpers\Url::to(['rootsAdvanced']),
//            Module::VIEW_PART_5 => '',
        ],
//        'nodeActions' => [
//            \kartik\tree\Module::NODE_SAVE => Url::to(['/tag/amos-node/save']),
//        ]
    ]);
    ?>
</div>