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


use arter\amos\core\views\ListView;
use arter\amos\core\icons\AmosIcons;
use arter\amos\search\AmosSearch;
use yii\widgets\Pjax;

Pjax::begin([
    'id' => 'pjax-'.$moduleName
]);

$queryString = \yii\helpers\HtmlPurifier::process(trim($queryString));
$tagIds = \yii\helpers\HtmlPurifier::process(trim($tagIds));


$queryString = strip_tags($queryString);
$queryString = addslashes($queryString);
$tagIds = strip_tags($tagIds);
$tagIds = addslashes($tagIds);

/*
pr($queryString);
die();
*/

echo $this->render('_pjaxForm', [
    'moduleName' => $moduleName,
    'tagIds' => $tagIds,
    'queryString' => $queryString,
    'originAction' => Yii::$app->controller->action->id,
    'modelSearch' => $modelSearch
]);

if ($dataProvider->getTotalCount() > 0) {
    ?>
    <div class="row search-row-buffer">
        <div class="col-md-12">
            <div class="search-title" data-result-count="<?= $dataProvider->getTotalCount() ?>">
                <?= AmosIcons::show(Yii::$app->getModule($moduleName)->getModuleIconName(), ['class' => 'search-section-icon h3'], 'dash') ?><span class="h3"><?= strtoupper($modelLabel) ?></span> <span class="h4">(<?= AmosSearch::t('amossearch', '{0} di {1}', [$dataProvider->getCount(), $dataProvider->getTotalCount()]) ?>)</span>
            </div>
        </div>
    </div>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
    ]);
}

Pjax::end();
