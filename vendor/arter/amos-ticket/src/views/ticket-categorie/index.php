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
 * @package    arter\amos\ticket\views\ticket-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\AmosGridView;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\TicketCategorie;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\ticket\models\search\TicketCategorieSearch $searchModel
 */

$this->title = AmosTicket::t('amosticket', 'Categorie');
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => '/ticket/ticket-categorie/index'];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="news-categorie-index">
    <?php echo $this->render('_search', ['model' => $model]); ?>
    <?php
    echo AmosGridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'columns' => [
            [
                'label' => $model->getAttributeLabel('categoryIcon'),
                'format' => 'html',
                'value' => function ($model) {
                    /** @var TicketCategorie $model */
                    $url = $model->getCategoryIconUrl();
                    $contentImage = Html::img($url, ['class' => 'gridview-image', 'alt' => $model->getAttributeLabel('categoryIcon')]);
                    return $contentImage;
                }
            ],
            'titolo',
            'descrizione:html',
            'categoria_padre_id' => [
                'attribute' => 'categoriaPadre.nomeCompleto',
                'label' => AmosTicket::t('amosticket', 'Categoria padre')
            ],
            'tecnica:boolean',
            [
                'class' => 'arter\amos\core\views\grid\ActionColumn'
            ]
        ]
    ]);
    ?>
</div>
