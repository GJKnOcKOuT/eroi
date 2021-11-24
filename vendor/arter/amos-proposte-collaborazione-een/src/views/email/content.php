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
 * @package    arter\amos\een\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var arter\amos\een\models\EenPartnershipProposal $model
 */

?>
<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;">

    <div>
        <!-- getImage universal code-->
    </div>

    <!--    <div style="padding:0;margin:0">-->
    <!--        <h3 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">-->
    <!--            < ?= Html::a($model->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #297A38;']) ?>-->
    <!--        </h3>-->
    <!--    </div>-->

    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000;">
        <?php
        echo $model->getDescription(true);
        ?>
    </div>
    <div style="box-sizing:border-box;padding-bottom: 5px;">
        <div style="margin-top:20px; display: flex; padding: 10px;">
            <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                <?php $content ?>
            </div>
        </div>
    </div>
</div>