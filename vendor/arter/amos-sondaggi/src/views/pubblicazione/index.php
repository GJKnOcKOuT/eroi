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
 * @package    arter\amos\sondaggi\views\pubblicazione
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\DataProviderView;
use arter\amos\sondaggi\AmosSondaggi;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\sondaggi\models\search\SondaggiSearch $searchModel
 */

?>
<div class="sondaggi-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?php /* echo         Html::a(AmosSondaggi::t('amossondaggi', 'Nuovo {modelClass}', [
          'modelClass' => 'Sondaggi',
          ])        , ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>

    <?php
    echo DataProviderView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $model,
        'currentView' => $currentView,
        'gridView' => [
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'id',
                'filemanager_mediafile_id' => [
                    'label' => AmosSondaggi::t('amossondaggi', 'Immagine'),
                    'format' => 'html',
                    'value' => function ($model) {
                        /** @var \arter\amos\sondaggi\models\search\SondaggiSearch $model */
                        $mediafile = \pendalf89\filemanager\models\Mediafile::findOne($model->filemanager_mediafile_id);
                        $url = '/img/img_default.jpg';
                        if ($mediafile) {
                            $url = $model->getAvatarUrl('medium');
                        }
                        return Html::img($url, [
                            'class' => 'gridview-image'
                        ]);
                    }
                ],
                'titolo:ntext',
                'descrizione:ntext',
                'compilazioni' => [
                    'label' => AmosSondaggi::t('amossondaggi', 'Partecipanti'),
                    'value' => function ($model) {
                        /** @var \arter\amos\sondaggi\models\search\SondaggiSearch $model */
                        return ($model->getNumeroPartecipazioni()) ? $model->getNumeroPartecipazioni() : AmosSondaggi::t('amossondaggi', 'Nessuno');
                    }
                ],
                //['attribute'=>'created_at','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],
//            ['attribute'=>'updated_at','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],
//            ['attribute'=>'deleted_at','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s A']],
//            'created_by',
//            'updated_by',
//            'deleted_by',
//            'version',
                [
                    'class' => 'arter\amos\core\views\grid\ActionColumn',
                    'template' => '{compila}',
                    'buttons' => [
                        'anteprima' => function ($url, $model) {
                            /** @var \arter\amos\sondaggi\models\search\SondaggiSearch $model */
                            $url = \yii\helpers\Url::current();
                            if (\Yii::$app->getUser()->can('AMMINISTRAZIONE_SONDAGGI') || \Yii::$app->getUser()->can('SONDAGGI_READ', ['model' => $model])) {
                                return Html::a(AmosIcons::show('eye'), Yii::$app->urlManager->createUrl([
                                    '/' . $this->context->module->id . '/sondaggi/view',
                                    'id' => $model->id,
                                    'url' => $url,
                                ]), [
                                    'title' => AmosSondaggi::t('amossondaggi', 'Visualizza anteprima'),
                                    'class' => 'btn btn-tool-secondary'
                                ]);
                            } else {
                                return '';
                            }
                        },
                        'compila' => function ($url, $model) {
                            /** @var \arter\amos\sondaggi\models\search\SondaggiSearch $model */
                            $url = \yii\helpers\Url::current();
                            //if (\Yii::$app->getUser()->can('PARTECIPANTE') || TRUE) {
                            if (!$model->hasCompilazioniSuperate()) {
                                return Html::a(AmosIcons::show('spellcheck'), Yii::$app->urlManager->createUrl([
                                    '/' . $this->context->module->id . '/pubblicazione/compila',
                                    'id' => $model->id,
                                    'url' => $url
                                ]), [
                                    'title' => AmosSondaggi::t('amossondaggi', 'Compila sondaggio'),
                                    'class' => 'btn btn-tool-secondary'
                                ]);
                            } else {
                                return '';
                            }
                        }
                    ]
                ],
            ],
        ],
        'listView' => [
            'itemView' => '_item'
        ],/*
          'iconView' => [
          'itemView' => '_icon'
          ],
          'mapView' => [
          'itemView' => '_map',
          'markerConfig' => [
          'lat' => 'domicilio_lat',
          'lng' => 'domicilio_lon',
          ]
          ],
          'calendarView' => [
          'itemView' => '_calendar',
          'clientOptions' => [
          //'lang'=> 'de'
          ],
          'eventConfig' => [
          //'title' => 'titoloEvento',
          //'start' => 'data_inizio',
          //'end' => 'data_fine',
          //'color' => 'coloreEvento',
          //'url' => 'urlEvento'
          ],
          ] */
    ]);
    ?>
</div>
