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
 * @package    arter\amos\search
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\helpers\Html;
?>
<div class="listview-container">
    <div class="post-horizontal">
        <?php
        $dataPubblicazione=null;
        if ($model->data_pubblicazione) {
            $dataPubblicazione = Yii::$app->getFormatter()->asDate($model->data_pubblicazione);
        }
        ?>
        <div class="col-md-2 col-sm-3 col-xs-12 ">
            <div class="box search-box">
                <?php if ($model->box_type == "file") { ?>
                    <?php $contentFile = '<span class="icon">' . AmosIcons::show('file-text-o', ['class' => 'am-4'], 'dash') . '</span>'; ?>
                    <?= Html::a($contentFile, $model->url, ['data-pjax' => '0']) ?>
                    <?php
                } elseif ($model->box_type == "image") {
                    $urlImage = '/img/img_default.jpg';

                    if (!is_null($model->immagine)) {
                        if(is_a($model->immagine , '\arter\amos\attachments\models\File')){
                            $urlImage = $model->immagine->getUrl('square_medium', false, true);
                        }else{
                            $urlImage = $model->immagine;
                        }
                    }
                    $contentImage = Html::img($urlImage, [
                                'class' => 'img-responsive'
                    ]);
                    ?>
                    <?= Html::a($contentImage, $model->url, ['data-pjax' => '0']) ?>

                    <?php
                }
                ?>

            </div>
        </div>

        <div class="col-md-9 col-sm-8 col-xs-12">
            <?php if($dataPubblicazione){ ?>
                <p class="publication-date"><?= BaseAmosModule::t('amoscore', 'Pubblicato il') ?> <?= $dataPubblicazione ?></p>
            <?php } ?>
            <div class="post-content col-xs-12 nop">
                <div class="post-title col-xs-12">
                    <a href="<?= $model->url ?>" data-pjax="0">
                        <h2><?= $model->titolo ?></h2>
                    </a>
                </div>
                <div class="clearfix"></div>
                <div class="row nom post-wrap">
                    <div class="post-text col-xs-12">
                        <?php
                        $contentText = substr(strip_tags($model->abstract),0,255);
                        if($contentText){
                            $contentText .= '...';
                        }
                        ?>
                        <p><?=  $contentText  ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1 col-sm-1 col-xs-12">
            <a class="pull-right" href="<?= $model->url ?>" data-pjax="0"><?= AmosIcons::show('chevron-right', [
                    'class' => 'am-4'
                ]) ?>
            </a>
        </div>
    </div>
</div>
