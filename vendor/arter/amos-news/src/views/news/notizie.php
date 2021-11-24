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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\views\DataProviderView;
use arter\amos\news\AmosNews;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\news\models\search\NewsSearch $searchModel
 */
$this->title = AmosNews::t('amosnews', 'Notizie');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        'currentView' => $currentView,
        'gridView' => [
            //'filterModel' => $model,
            'columns' => [
                'titolo',
                'sottotitolo',
                'descrizione_breve',
                //'descrizione:ntext',
//            'metakey:ntext', 
//            'metadesc:ntext', 
//                'primo_piano:statosino', 
//            'hits', 
//            'abilita_pubblicazione:statosino', 
                'news_categorie_id' => [
                    'attribute' => 'newsCategorie.titolo',
                    'label' => 'Categoria'
                ],
                ['attribute' => 'data_pubblicazione', 'format' => ['date', (isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']],
                /*'condominio' => [
                    'label' => 'Pubblicata per',
                    'value' => function ($model) {
                        return $model->getNetworkPubblicazione();
                    }
                ],*/
//            ['attribute'=>'data_rimozione','format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 

                /*            'news_stati_id' => [
                  'attribute' => 'newsStati.nome',
                  'label' => 'Stato'
                  ], */
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                ],
            ],
        ],
        'listView' => [
            'itemView' => '_itemUtenti'
        ],
    ]);
    ?>

</div>
