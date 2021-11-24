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


use arter\amos\core\helpers\Html;
use arter\amos\core\views\DataProviderView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use arter\amos\translation\AmosTranslation;
use arter\amos\translation\models\TranslationConf;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var backend\modules\registry\models\search\ProfessionalProfilesSearch $model
 */
$url = filter_input(INPUT_GET, 'url');
$namespace = filter_input(INPUT_GET, 'namespace');
if (!$url) {    
    $url = '/translation/default/contents';
}
$this->title = "$classname: " . AmosTranslation::t('amostranslation', 'translate into') . " $lang";
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate manager'), 'url' => ['/translation']];
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate contents'), 'url' => [$url]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professional-profiles-index">
    <?php  echo $this->render('search_records', ['model' => $modelSearch,'namespace' => $namespace]);  ?>

    <p>
        <?php /* echo         Html::a('Nuovo Professional Profiles'        , ['create'], ['class' => 'btn btn-amministration-primary']) */ ?>
    </p>

    <?php
    echo arter\amos\core\views\AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $columns
//            [
//                'attribute' => 'plugin',
//                'label' => AmosTranslation::t('amostranslation', 'Plugin'),
//                'value' => function ($model){
//                    return ucfirst($model['plugin']);
//                },
//              'group' => true,
//            ],
//            [
//                'attribute' => 'id_translate', 
//                'label' => AmosTranslation::t('amostranslation', 'Models'),
//                'value' => function ($model) {
//                    return Inflector::camel2words(StringHelper::basename($model['namespace']));
//                }
//            ],         
//            [
//                'attribute' => 'language_id',
//                'label' => AmosTranslation::t('amostranslation', 'Language'),      
//                'value' => function($model){                  
//                    return strtoupper($model['language']) . ' - ' . $model['name'];
//                }
//            ],
//                    [
//            'attribute' => 'progress_bar',
//            'label' => AmosTranslation::t('amostranslation', 'Translation progress'),
//            'format' => 'raw',
//            'value' => function($model) {
//                $conf = new TranslationConf();
//                $bars = $conf->getProgress($model['namespace'], $model['language_id']);
//                return \yii\bootstrap\Progress::widget($bars);
//            }
//        ],
//               [
//            'class' => \arter\amos\core\views\grid\ActionColumn::className(),
//            'template' => '{custom}',
//            'buttons' => [
//                'custom' => function ($url, $model) {
//                    $urlDestinazione = \Yii::$app->urlManager->createUrl(['/site/translation-view', 'id' => $model['namespace'] , 'language' => $model['language_id'] ]);
//                    return \yii\helpers\Html::a(\arter\amos\core\icons\AmosIcons::show('square-right', ['class' => 'btn btn-tool-secondary']), $urlDestinazione, [
//                        'title' => Yii::t('app', 'Detail'),
//                        'model' => $model
//                    ]);
//                },
//
//            ]
//        ]
//        ],
    ]);
    ?>

</div>
