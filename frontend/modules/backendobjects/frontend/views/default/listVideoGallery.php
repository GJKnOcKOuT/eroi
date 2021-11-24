<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use app\modules\backendobjects\frontend\Module;
use kartik\datecontrol\DateControl;
use luya\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="<?= $cssClass ?>">
    <?php if (!$withoutSearch) { ?>
        <?php
        $form = ActiveForm::begin([
            'action' => Url::toRoute(['/backendobjects']),
            'method' => 'get',
            'options' => [
                'id' => 'element_form_' . $model->id,
                'class' => 'form wrap-search',
                'enctype' => 'multipart/form-data',
            ]
        ]);
        ?>

        <?php
        foreach ($searchFields as $field) {
            switch ($field->type) {
                case "TEXT":
        ?>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <?= $form->field($model, $field->name) ?>
                    </div>
                <?php
                    break;
                case "DATE":
                ?>
                    <div class="col-xs-12 col-sm-6 col-lg-4">
                        <?=
                            $form->field($model, $field->name)->widget(DateControl::className(), [
                                'type' => DateControl::FORMAT_DATE
                            ])
                        ?>
                    </div>
        <?php
                    break;
            }
        }
        ?>

        <div class="col-xs-12 wrap-btn">
            <?= Html::a(Module::t('Annulla'), [Yii::$app->controller->action->id, 'currentView' => Yii::$app->request->getQueryParam('currentView')], ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton(Module::t('Cerca'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    <?php } // !$withoutSearch 
    ?>

    <div class="clearfix"></div>

    <?php
    if(!is_null($dataProvider)){
        if ($dataProvider->getTotalCount() > 0) {

            //echo $dataProvider->getModels();
            $models = $dataProvider->getModels();

            $firstVideo = $models[0];
            $i = 0;
    ?>

        <div class="wrap-playlist">
            <div class="wrap-active-video">
                <iframe src="<?= $firstVideo->getUrlEmbeddedVideo() ?>?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="wrap-youtbe-thumbs">
                <?php foreach ($models as $model) : ?>
                    <?php
                    $match = [];
                    $idVideo = '';
                    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $model->url_video, $match);
                    $idVideo = $match[1];
                    ?>
                    <a class="wrap-video">
                        <img src="https://img.youtube.com/vi/<?= $idVideo ?>/mqdefault.jpg" alt="<?= $model->title ?>" data-video="<?= $idVideo ?>"/>
                        <div class="text-part">
                            <p class="title"><?= $model->title ?></p>
                            
                            <!--da aggiungere num visualizzazioni e canale-->
                           
                            <p class="sub-title">Canale <br>Num views</p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php } ?>
    <?php } ?>
</div>