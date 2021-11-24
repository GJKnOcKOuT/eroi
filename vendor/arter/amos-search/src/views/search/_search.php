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
 * @package    arter\amos\documenti
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\search\AmosSearch;
use yii\helpers\Html;

$js = <<<JS
     $('#showadvsearch').on('click', function(e){
        if(typeof $('#container-tag-search').attr('hidden') !== "undefined"){
            $('#container-tag-search').removeAttr('hidden');
            $('#container-tag-search').show();
            $('#search-chevron').attr('class', 'am am-chevron-up');
        } else {
            $('#container-tag-search').attr('hidden','hidden');
            $('#container-tag-search').hide();
            $('#search-chevron').attr('class', 'am am-chevron-down');

        }
    });
JS;
$this->registerJs($js);

if ($tagIds) {
    $arrayTagIds = explode(',', $tagIds);
    $dataProvider = new \yii\data\ActiveDataProvider([
        'query' => \arter\amos\tag\models\Tag::find()->andWhere(['id' => $arrayTagIds])
    ]);
    $columns = [
        [
            'value' => function ($model) {
                $tagName = Html::a($model->nome, '/search/search/index?tagIds=' . $model->id);
                return "<div class=\"tags-list-single\" data-tag='" . $model->id . "'>
                                        <div>" . \arter\amos\core\icons\AmosIcons::show('label') . "</div>
                                        <div>
                                            <p class=\"tag-label\">" . $tagName . "</p>
                                            <small>" . $model->tagRoot->nome . ($model->path ? " / " . $model->path : "") . "</small>
                                        </div>
                                    </div>";
            },
            'format' => 'raw'
        ],
    ];
}

$moduleLayout = Yii::$app->getModule('layout');
if (!is_null($moduleLayout)) {
    \arter\amos\layout\assets\SpinnerWaitAsset::register($this);
}
?>

<div class="loading" id="loader" hidden></div>

<?php $form = \arter\amos\core\forms\ActiveForm::begin([
        'method' => 'get', 'id' => 'formSearch',
        'action' => '/'
]); ?>

<div class="toolbar-search">
    <?php if (!$tagIds) { ?>
        <p id="query-info" class="result_key"
           data-i18n="<?= AmosSearch::t('amossearch', 'Risultati della ricerca che contengono la parola: <strong>{queryString}</strong>') ?>">
            <?php if ($queryString) {
                echo AmosSearch::t('amossearch', 'Risultati della ricerca che contengono la parola: <strong>{queryString}</strong>', ['queryString' => $queryString]);
            }

            ?>
        </p>
    <?php } else { ?>
        <p id="query-info" class="result_key"
           data-i18n="<?= AmosSearch::t('amossearch', 'Risultati della ricerca che contengono i tag:') ?>">
            <?= AmosSearch::t('amossearch', 'Risultati della ricerca che contengono i tag:') ?>
        </p>
        <?php echo \arter\amos\core\views\AmosGridView::widget([
            'dataProvider' => $dataProvider,
            'showPageSummary' => false,
            'showPager' => false,
            'columns' => $columns
        ]);
    } ?>

    <div class="row container-searchBar <?= $tagIds ? 'hidden' : '' ?>">
        <!--         <form id="formSearch">-->
        <?php echo Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView')); ?>
        <div class="col-sm-3"><p class="label-search"><?= AmosSearch::tHtml('amossearch', 'CERCA') ?></p></div>

        <div class="col-sm-6">
            <div class="form-group">
                <?php echo Html::input("text", "queryString", $queryString, [
                    'class' => "form-control",
                    'id' => "queryString"
                ]);
                ?>
                <?php echo Html::input("hidden", "tagIds", $tagIds, [
                    'class' => "form-control hidden",
                    'id' => "tagIds"
                ]);
                ?>
                <div class="help-block"><?= AmosSearch::tHtml('amossearch', 'Inserisci una o più parole chiave per affinare ulteriormente la ricerca') ?></div>
                <div class="help-block">
                    <?= \arter\amos\core\icons\AmosIcons::show('chevron-down', ['id' => 'search-chevron']) ?>
                    <a href='javascript:void(0)'
                       id="showadvsearch"><?= AmosSearch::t('amossearch', 'Ricerca avanzata') ?></a>
                </div>

            </div>
        </div>

        <div class="col-sm-3">
            <div>
                <?= Html::submitButton(AmosSearch::tHtml('amossearch', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>
            </div>
        </div>

        <!--        </form>-->
    </div>
</div>
<div id='container-tag-search'
     class="col-xs-12 <?= $tagIds ? 'hidden' : '' ?>" <?= \Yii::$app->request->get('advancedSearch') ? '' : 'hidden' ?>>
    <?php
    $moduleTag = \Yii::$app->getModule('tag');
    if (isset($moduleTag) && $moduleTag->behaviors && class_exists('\arter\amos\tag\widgets\TagGeneralSearchWidget')): ?>
        <div class="col-xs-12">
            <h3><?= AmosSearch::t('amossearch', 'Tag aree di interesse') ?> </h3>

            <?php
            $params = \Yii::$app->request->getQueryParams();
            echo \arter\amos\tag\widgets\TagGeneralSearchWidget::widget([
                'model' => $modelSearch,
                'attribute' => 'tagValues',
                'hideHeader' => true,
                'form' => $form,
                'form_values' => !empty($modelSearch->tagValues) ? $modelSearch->tagValues : []
            ]);

            ?>

        </div>
        <div class="col-sm-12 nop">
            <div>
                <?= Html::submitButton(AmosSearch::tHtml('amossearch', 'Cerca'), ['class' => 'btn btn-navigation-primary pull-right']) ?>
            </div>
        </div>

    <?php endif; ?>
    <?php \arter\amos\core\forms\ActiveForm::end(); ?>

</div>
