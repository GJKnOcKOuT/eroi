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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\core\helpers\Html;

/** @var \arter\amos\community\utilities\EmailUtil $util */
if(!empty($profile)) {
    $this->params['profile'] = $profile;
}
?>


<div>
    <div style="box-sizing:border-box;">
        <div style="padding:5px 10px;background-color: #F2F2F2;">
            <h1 style="color:#297A38;text-align:center;font-size:1.5em;margin:0;"><?= AmosCommunity::t('amoscommunity', '#change_role_mail_title') ?></h1>
        </div>
        <div
            style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff; margin-top: 20px;">
            <h2 style="color:#000000;font-size:2em;line-height: 1;"><?= AmosCommunity::t('amoscommunity', '#change_role_mail_text_1') . $util->contextLabel ?></h2>

            <div style="color:#000000;display: flex; padding: 10px;">
                <?php if ($util->isCommunityContext): ?>
                    <div
                        style="width: 50px; height: 50px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                        <?= \arter\amos\community\widgets\CommunityCardWidget::widget([
                            'model' => $util->community,
                            'onlyLogo' => true,
                            'absoluteUrl' => true,
                            'inEmail' => true
                        ]) ?>
                    </div>
                <?php endif; ?>
                <?php
                $divOptions = $util->isCommunityContext ? ['style' => 'margin: 0 0 0 20px;'] : [];
                echo Html::tag('div', '<p style="font-weight: 900">' . $util->community->name . '</p>
                <p>' . $util->community->getDescription(true) . '</p>', $divOptions)
                ?>
            </div>
            <div style="color:#000000;width:100%;margin-top:30px">
                <p>
                    <?= AmosCommunity::t('amoscommunity', "You are now:") . " " ?>
                    <span style="font-weight: 900"><?= AmosCommunity::t('amoscommunity', $util->role) . "." ?></span>
                </p>
            </div>
            <p style="color:#000000;"><?= Html::a(AmosCommunity::t('amoscommunity', 'Sign into the platflorm'), $util->url, ['style' => 'color: green;']) . ' ' .
                AmosCommunity::t('amoscommunity', "to start working within") . " " . $util->community->name
                ?>
            </p>
            <?php if ($util->isCommunityContext): ?>
                <p style="color:#000000;">
                    <?= AmosCommunity::t('amoscommunity', "#mail_network_community_1") ?>
                    <?= Html::a(' ' . AmosCommunity::t('amoscommunity', '#mail_network_community_2'),
                        Yii::$app->urlManager->createAbsoluteUrl('dashboard'),
                        ['style' => 'color: green;']
                    ) ?>
                    <?= ' ' . AmosCommunity::t('amoscommunity', '#mail_network_community_3') . ' ' ?>
                    <span
                        style="color:#000000;font-weight: 900; font-style: italic;"><?= AmosCommunity::t('amoscommunity', '#mail_network_community_4') ?> </span>
                    <?= AmosCommunity::t('amoscommunity', '#mail_network_community_5') ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>
