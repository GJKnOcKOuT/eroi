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
 * @package    arter\amos\partnershipprofiles\views\expressions-of-interest\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\partnershipprofiles\models\PartnershipProfiles;
use arter\amos\partnershipprofiles\Module;

/**
 * @var \arter\amos\partnershipprofiles\models\base\PartnershipProfiles $partnershipProfile
 * @var integer[] $listOfArchived
 * @var integer[] $errorIds
 * @var string $dateStartScript
 */

/** @var Module $partnerProfModule */
$partnerProfModule = Module::instance();

?>
<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;">

    <div>
        <div style="margin-top: 20px;color:#000000;margin-left: 10px;">
            <h2 style="font-size:1.5em;line-height: 1;"><?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'List of partnership profiles filed at') . ' ' . $dateStartScript ?></h2>
        </div>
    </div>

    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000;">
        <table border="1" width="100%">
            <tr>
                <th>
                    <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Title') ?>
                </th>
                <th>
                    <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Name Surname') ?>
                </th>
                <th>
                    <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Expiry date') ?>
                </th>
                <th>
                    <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Created at') ?>
                </th>
            </tr>
            <?php
            foreach ($listOfArchived as $id):
                /** @var PartnershipProfiles $partnershipProfilesModel */
                $partnershipProfilesModel = $partnerProfModule->createModel('PartnershipProfiles');
                $partnershipProfile = $partnershipProfilesModel::findOne($id);
                ?>
                <tr>
                    <td>
                        <?= \yii\helpers\StringHelper::truncate($partnershipProfile->title, 50, '...'); ?>
                    </td>
                    <td>
                        <?= $partnershipProfile->createdUserProfile->getNomeCognome(); ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDate($partnershipProfile->calculateExpiryDate()); ?>
                    </td>
                    <td>
                        <?= Yii::$app->formatter->asDatetime($partnershipProfile->created_at); ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>

    <?php
    if (count($errorIds) > 0):
        ?>
        <div>
            <div style="margin-top: 20px;color:#000000;margin-left: 10px;">
                <h2 style="font-size:1.5em;line-height: 1;"><?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Items not stored for error occurred') . ' ' . $dateStartScript ?></h2>
            </div>
        </div>

        <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000;">
            <table border="1" width="100%">
                <tr>
                    <th>
                        <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Title') ?>
                    </th>
                    <th>
                        <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Name Surname') ?>
                    </th>
                    <th>
                        <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Expiry date') ?>
                    </th>
                    <th>
                        <?= \arter\amos\partnershipprofiles\Module::t('amospartnershipprofiles', 'Created at') ?>
                    </th>
                </tr>
                <?php
                foreach ($errorIds as $id):
                    /** @var PartnershipProfiles $partnershipProfilesModel */
                    $partnershipProfilesModel = $partnerProfModule->createModel('PartnershipProfiles');
                    $partnershipProfile = $partnershipProfilesModel::findOne($id);
                    ?>
                    <tr>
                        <td>
                            <?= \yii\helpers\StringHelper::truncate($partnershipProfile->title, 50, '...'); ?>
                        </td>
                        <td>
                            <?= $partnershipProfile->createdUserProfile->getNomeCognome(); ?>
                        </td>
                        <td>
                            <?= Yii::$app->formatter->asDate($partnershipProfile->calculateExpiryDate()); ?>
                        </td>
                        <td>
                            <?= Yii::$app->formatter->asDatetime($partnershipProfile->created_at); ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </table>
        </div>
    <?php
    endif;
    ?>
</div>