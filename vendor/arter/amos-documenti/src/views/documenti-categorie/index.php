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
 * @package    arter\amos\documenti\views\documenti-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\views\AmosGridView;
use arter\amos\documenti\AmosDocumenti;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\documenti\models\search\DocumentiCategorieSearch $searchModel
 */

$this->title = AmosDocumenti::t('amosdocumenti', '#page_title_documents_categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documenti-categorie-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php echo AmosGridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            'filemanager_mediafile_id' => [
                'label' => AmosDocumenti::t('amosdocumenti', 'Icona'),
                'format' => 'html',
                'value' => function ($model) {
                    $url = '/img/img_default.jpg';
                    if (!is_null($model->documentCategoryImage)) {
                        $url = $model->documentCategoryImage->getUrl('square_small', false, true);
                    }
                    return Html::img($url, ['class' => 'gridview-image', 'alt' => AmosDocumenti::t('amosdocumenti', 'Immagine della categoria')]);
                }
            ],
            'titolo',
            'sottotitolo',
            'descrizione_breve',
            'descrizione:ntext',
            [
                'class' => 'arter\amos\core\views\grid\ActionColumn',
            ],
        ],
    ]); ?>
</div>
