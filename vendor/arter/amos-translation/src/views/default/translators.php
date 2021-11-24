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
use arter\amos\core\icons\AmosIcons;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = AmosTranslation::t('amostranslation', 'Manage translators');
$this->params['breadcrumbs'][] = ['label' => AmosTranslation::t('amostranslation', 'Translate manager'), 'url' => ['/translation']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="professional-profiles-index"> 
    <?php //echo $this->render('_filter', ['model' => $model]); ?>

    <p>
        <?php /* echo         Html::a('Nuovo Professional Profiles'        , ['create'], ['class' => 'btn btn-amministration-primary']) */ ?>
    </p>

    <?php     
    echo arter\amos\core\views\AmosGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nome', 
            'cognome',
            'codice_fiscale',            
            [
                'attribute' => 'languages',
                'label' => AmosTranslation::t('amostranslation', 'Languages'),
                'format' => 'html',
                'value' => function ($model){
                    $languages = arter\amos\translation\models\TranslationUserLanguageMm::find()->andWhere(['user_id' => $model['user_id']]);
                    if($languages->count()){
                        $i = 0;
                        $lng = '';
                        foreach ($languages->all() as $l){
                        $lng .= ($i == 0? '' : '<br>') . $l->language;
                        $i++;
                        }                        
                        return $lng;
                    } else {
                        return AmosTranslation::t('amostranslation', 'Not set');
                    }
                },             
            ],           
               [
            'class' => \arter\amos\core\views\grid\ActionColumn::className(),
            'template' => '{custom}',
            'buttons' => [
                'custom' => function ($url, $model) {                      
                    $url = yii\helpers\Url::current();                    
                    $urlDestination = \Yii::$app->urlManager->createUrl(['/translation/default/user-language', 'user_id' => $model['user_id'] , 'url' => $url]);
                    return \yii\helpers\Html::a(AmosIcons::show('square-right', ['class' => 'btn btn-tool-secondary']), $urlDestination, [
                        'title' => AmosTranslation::t('app', 'Choose the language he can translate'),                        
                    ]);
                },

            ]
        ]
        ],
    ]);
    ?>

</div>
