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
 * @package    arter\amos\myactivities\widgets\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\myactivities\AmosMyActivities;

/**
 * @var yii\web\View $this
 * @var \arter\amos\admin\models\UserProfile $userProfile
 * @var \arter\amos\core\record\Record $model
 * @var string $validationRequestTime
 * @var string $labelKey
 */

?>

<div class="col-md-3 col-xs-5 wrap-user">
    <?= UserCardWidget::widget(['model' => $userProfile]) ?>
    <span class="user"><?= $userProfile->getNomeCognome() ?></span>
    <br>
    <?= AmosAdmin::t('amosadmin', $userProfile->workflowStatus->label) ?>
</div>
<div class="col-md-5 col-xs-5 wrap-report">
    <div class="col-lg-12 col-xs-12">
        <strong><?= $labelKey ?></strong>
    </div>
    <div class="col-lg-12 col-xs-12">
        <?= Yii::$app->formatter->asDatetime($requestTime) ?>
    </div>
    <div class="col-lg-12 col-xs-12">
        <?= AmosMyActivities::t('amosmyactivities', ' asks connection for:'); ?>
        <?php /** @var \arter\amos\core\interfaces\ContentModelInterface $model */ ?><br>
        <?= $model->getSearchString() ?>
    </div>
    <div class="col-lg-12 col-xs-12">
        <?php /** @var \arter\amos\core\interfaces\ViewModelInterface $model */ ?>
        <?= Html::a(AmosIcons::show('search', [], 'dash') . ' <span>' . AmosMyActivities::t('amosmyactivities',
                'View card') . '</span>', $model->getFullViewUrl()
//            Yii::$app->urlManager->createUrl([
//                '/community/community/view',
//                'id' => $model->id
//            ])
        ) ?>
    </div>
</div>
