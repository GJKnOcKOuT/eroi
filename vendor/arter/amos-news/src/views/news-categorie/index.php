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
 * @package    arter\amos\news\views\news-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\AmosGridView;
use arter\amos\news\AmosNews;
use arter\amos\news\models\NewsCategorie;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\news\models\search\NewsCategorieSearch $searchModel
 */

$this->title = AmosNews::t('amosnews', 'Categorie notizie');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/news'];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="news-categorie-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
        //'filterModel' => $model,
        'columns' => [
            [
                'label' => $model->getAttributeLabel('categoryIcon'),
                'format' => 'html',
                'value' => function ($model) {
                    /** @var NewsCategorie $model */
                    $url = $model->getCategoryIconUrl();
                    $contentImage = Html::img($url, ['class' => 'gridview-image', 'alt' => $model->getAttributeLabel('categoryIcon')]);
                    return $contentImage;
                }
            ],
            'titolo',
            'sottotitolo',
            'descrizione_breve',
            'descrizione:html',
            [
                'class' => 'arter\amos\core\views\grid\ActionColumn'
            ]
        ]
    ]); ?>
</div>
