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
 * @package    arter\amos\core\forms\views\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\views\AmosGridView;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;

/**
 * @var \yii\web\View $this
 * @var \arter\amos\tag\models\Tag $root
 * @var \yii\base\View $this
 * @var array $allRootTags
 * @var array $allTags
 */

if ($viewFilesCounter) {
    $this->registerJs(<<<JS
    
    var filesQuantity = "$filesQuantity";
    
    var section_title = $("#section-tags").find("h2");

    section_title.append(" (" + filesQuantity + ")");
    
    if(filesQuantity == 0){
        section_title.addClass("section-disabled");
    }
    
JS
    );
}

$dataProvider->pagination->setPageSize($pageSize);
$searchModule = Yii::$app->getModule('search');
$currentModule = Yii::$app->controller->module->getUniqueId();

?>

<?php if ($filesQuantity == 0) { ?>
    <div class="no-items"><?= BaseAmosModule::t('amoscore', '#NO_INTEREST_AREA_TAGS'); ?></div>
    <div class="tags-list-all col-xs-12 nop">
    </div>
<?php } else { ?>

    <div class="tags-list-all col-xs-12 nop">
        <?php
        $columns = [
            [
                'value' => function ($model) use ($searchModule, $currentModule) {
                    if(!is_null($searchModule)){
                        $tagName = Html::a($model->nome , '/search/search/index?tagIds='.$model->id.'&moduleName='.$currentModule);
                    }else {
                        $tagName = $model->nome;
                    }
                    return "<div class=\"tags-list-single\" data-tag='".$model->id."'>
                                            <div>" . AmosIcons::show('label') . "</div>
                                            <div>
                                                <p class=\"tag-label\">" . $tagName . "</p>
                                                <small>" . $model->tagRoot->nome . ($model->path ? " / " . $model->path : "") . "</small>
                                            </div>
                                        </div>";
                },
                'format' => 'raw'
            ],
        ];

        ?>
        <?php echo AmosGridView::widget([
            'dataProvider' => $dataProvider,
            'showPageSummary' => false,
            'showPager' => false,
            'columns' => $columns
        ]); ?>
        <?php if ($filesQuantity > $pageSize) {
            echo Html::tag('div',
                Html::a(BaseAmosModule::t('amoscore', '#view_all'), 'javascript:void(0);', [
                    'data-toggle' => 'modal',
                    'data-target' => '#view-all-tags',
                ]),
                ['class' => 'col-xs-12 nop list-tags-view-all']);
        } ?>
    </div>


    <?php
    // -------------- MODAL VIEW ALL TAGS --------------------
    Modal::begin([
        'id' => 'view-all-tags',
        'header' => "<h3>" . BaseAmosModule::t('amoscore', 'Tag') . "</h3>",
    ]);
    Pjax::begin([
        'id' => 'pjax-container-view-all',
        'timeout' => 2000,
        'enablePushState' => false,
        'enableReplaceState' => false,
        'clientOptions' => ['data-pjax-container' => 'grid-view-all-tags', 'method' => 'POST']
    ]); ?>

    <?php
    $dataProviderModal = new ActiveDataProvider([
        'query' => $dataProvider->query
    ]);
    echo AmosGridView::widget([
        'dataProvider' => $dataProviderModal,
        'id' => 'grid-view-all-tags',
        'columns' => $columns
    ]); ?>

    <?php Pjax::end();

    Modal::end();
} ?>
