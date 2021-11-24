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
 * @package    arter\amos\seo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\seo\assets\SeoAsset;
use arter\amos\seo\AmosSeo;


//SeoAsset::register($this);

?>

<div class="seo-data">

    <?php //pr($contentModel->className(), 'contentModel - seo-dataaa');pr($modelClass, 'model - seo-data'); pr($model->toArray(), 'il model');exit;

    $moduleSeo  = \Yii::$app->getModule(AmosSeo::getModuleName());
    if (isset($moduleSeo) && $moduleSeo->behaviors) {
        //print 'seo-data: Hello world!';exit;
        echo arter\amos\seo\widgets\MetaWidget::widget([
            'form' => \yii\base\Widget::$stack[0],
            'contentModel' => $contentModel,
            'modelClass' => $modelClass,
            'model' => $model,
        ]);
        echo arter\amos\seo\widgets\SocialWidget::widget([
            'form' => \yii\base\Widget::$stack[0],
            'contentModel' => $contentModel,
            'modelClass' => $modelClass,
            'model' => $model,
        ]);
        echo arter\amos\seo\widgets\RobotWidget::widget([
            'form' => \yii\base\Widget::$stack[0],
            'contentModel' => $contentModel,
            'modelClass' => $modelClass,
            'model' => $model,
        ]);
        /*
         * 
         */
    }

    ?>

</div>

