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
 * @package    arter\amos\search\views\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\widgets\Pjax;
use arter\amos\search\AmosSearch;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\documenti\models\search\DocumentiSearch $model
 * @var \arter\amos\dashboard\models\AmosUserDashboards $currentDashboard
 */

/** @var \arter\amos\documenti\controllers\DocumentiController $controller */



$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = AmosSearch::t('amossearch', '#search_title');

$queryString = \yii\helpers\HtmlPurifier::process(trim($queryString));
$queryString = strip_tags($queryString);
$queryString = addslashes($queryString);

$tagIds = \yii\helpers\HtmlPurifier::process(trim($tagIds));
$tagIds = strip_tags($tagIds);
$tagIds = addslashes($tagIds);



echo $this->render('_search', [
    'tagIds' => $tagIds,
    'queryString' => $queryString,
    'originAction' => Yii::$app->controller->action->id,
    'modelSearch' => $modelSearch
]);

?>
<div class="row">
    <div class="col-xs-12 results-info">
        <span id="results-info" data-i18n="<?= AmosSearch::t('amossearch','Sono stati trovati <strong>#NUMEL#</strong> elementi') ?>"></span>
    </div>
</div>
<div class="search-index">
    <div class="list_view">
    <?php
    foreach($searchModels as $moduleName => $moduleConfigs){
        Pjax::begin([
            'id' => 'pjax-'.$moduleName, // checked id on the inspect element
            'options' => ['class' => 'pjax-container clearfix'],
            'enablePushState' => false , // I would like the browser to change link
            'timeout' => 60000// Timeout needed
        ]);

        echo $this->render('_pjaxForm',[
            'moduleName' => $moduleName,
            'queryString' => $queryString,
            'tagIds' => $tagIds,
            'modelSearch' => $modelSearch,
            'originAction' => Yii::$app->controller->action->id
        ]);

        Pjax::end();
    }
    $js = <<<JS
   
JS;

    $this->registerJs($js);
    ?>
    </div>
</div>
