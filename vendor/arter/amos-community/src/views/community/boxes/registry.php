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
 * @package    arter\amos\community\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\core\icons\AmosIcons;

$moduleCommunity = Yii::$app->getModule('community');
$bypassWorkflow = $moduleCommunity->forceWorkflow($model);
$fixedCommunityType = !is_null($moduleCommunity->communityType);

?>

<section class="section-data">
    <h2>
        <?= AmosIcons::show('account'); ?>
        <?= AmosCommunity::tHtml('amoscommunity', 'Base information') ?>
    </h2>
    <dl>
        <dt><?= $model->name; ?></dt>
    </dl>
    <?= $model->description; ?>
</section>

<?php if (!$fixedCommunityType || !$bypassWorkflow || !is_null($model->parent_id)): ?>
    <section class="section-data">
        <h2>
            <?= AmosIcons::show('info'); ?>
            <?= AmosCommunity::tHtml('amoscommunity', 'Additional information') ?>
        </h2>
        <?php if (!$fixedCommunityType): ?>
            <dl>
                <dt><?= $model->getAttributeLabel('communityType'); ?></dt>
                <dd><?= isset($model->communityType) ?  AmosCommunity::t('amoscommunity', $model->communityType->name ) : '-' ?></dd>
            </dl>
        <?php endif; ?>
        <?php if (!$bypassWorkflow): ?>
        <dl>
            <dt><?= $model->getAttributeLabel('status'); ?></dt>
            <dd><?= $model->hasWorkflowStatus() ? AmosCommunity::t('amoscommunity', $model->getWorkflowStatus()->getLabel()) : '-' ?></dd>
        </dl>
        <?php endif; ?>
        <?php if($model->parent_id != null): ?>
            <dl>
                <dt><?= AmosCommunity::t('amoscommunity', "Created under the scope of community/organization:") ?></dt>
                <dd><?= Community::findOne($model->parent_id)->name ?></dd>
            </dl>
        <?php endif; ?>
    </section>
<?php endif; ?>

<section class="section-data">
    <h2>
        <?= AmosIcons::show('info'); ?>
        <?= AmosCommunity::tHtml('amoscommunity', 'Updates') ?>
    </h2>
    <p>
        <?php
        $creatorName = '';
        if(!is_null($model->createdByUser)) {
            /** @var \arter\amos\admin\models\UserProfile $createUserProfile */
            $createUserProfile = $model->createdByUser->getProfile();
            if (!is_null($createUserProfile)) {
                $creatorName = $createUserProfile->getNomeCognome();
            }
        }
        ?>
        <label><?= $model->getAttributeLabel('created_by') ?></label>
        <span><?= $creatorName ?></span>

        <label><?= AmosCommunity::tHtml('amoscommunity', 'at') ?></label>
        <span><?= Yii::$app->getFormatter()->asDatetime($model->created_at) ?></span>
    </p>
    <p>
        <?php
        $updatedByName = '';
        /** @var \arter\amos\admin\models\UserProfile $updateUserProfile */
        $updateUserProfile = $model->updatedByUser->getProfile();
        if (!is_null($updateUserProfile)) {
            $updatedByName = $updateUserProfile->getNomeCognome();
        }
        ?>
        <label><?= $model->getAttributeLabel('updated_by') ?></label>
        <span><?= $updatedByName ?></span>

        <label><?= AmosCommunity::tHtml('amoscommunity', 'at') ?></label>
        <span><?= Yii::$app->getFormatter()->asDatetime($model->updated_at) ?></span>
    </p>
</section>
