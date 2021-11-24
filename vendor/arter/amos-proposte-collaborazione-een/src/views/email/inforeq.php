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

use arter\amos\een\AmosEen;

?>
<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;">

    <div style="box-sizing:border-box;color:#000000;">
        <div style="padding:5px 10px;background-color: #F2F2F2;text-align:center;">
            <h1 style="color:#297A38;font-size:1.5em;margin:0;">
                <?php
                echo $model->getGrammar()->getModelSingularLabel();
                ?>
            </h1>
        </div>
    </div>
    <div style=""><?php echo AmosEen::t('amoseen', '#signal',[\Yii::$app->user->getIdentity()->getProfile()->getNomeCognome()])?></div>
    <div style="padding:0;margin:0">
        <h3 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">
            <?php
            echo $model->getTitle();
            ?>
        </h3>
    </div>
    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000; margin-top: 10px;">

        <?php
        echo $model->getDescription(true);
        ?>
    </div>
    <div style="box-sizing:border-box;padding-bottom: 5px;">
        <div style="margin-top: 15px;">
            <div style="font-weight: bold"><?php echo AmosEen::t('amoseen', '#moredata') ?></div>
        </div>
        <div style="margin-top:20px; padding: 10px;">
            <div style="">
                <?php echo "<p>". AmosEen::t('amoseen', '#region') . " ";?>
                <?php echo $inforeq->region  . "</p>";?>
            </div>
            <div style="">
                <?php echo "<p>". AmosEen::t('amoseen', '#enterprisenetwork') . " ";?>
                <?php echo ($inforeq->ent ?  AmosEen::t('amoseen', '#yes') : AmosEen::t('amoseen', '#no')) . "</p>";?>
            </div>
        </div>
    </div>
</div>