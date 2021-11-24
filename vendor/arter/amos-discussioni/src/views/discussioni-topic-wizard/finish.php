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
 * @package    arter\amos\discussioni\views\discussioni-topic-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\WizardPrevAndContinueButtonWidget;
use arter\amos\discussioni\AmosDiscussioni;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniTopic $model
 * @var string $finishMessage
 */

$this->title = $model;

?>

<div class="row m-b-30">
    <div class="col-xs-12">
        <div class="pull-left">
            <div class="like-widget-img color-primary ">
                <?= \arter\amos\core\icons\AmosIcons::show('comment', [], 'dash'); ?>
            </div>
        </div>
        <div class="text-wrapper">
            <h3><?= $finishMessage ?></h3>
            <h4><?= AmosDiscussioni::tHtml('amosdiscussioni', "Click on 'back to discussions' to finish.") ?></h4>
        </div>
    </div>
</div>

<?= WizardPrevAndContinueButtonWidget::widget([
    'model' => $model,
    'previousUrl' => Yii::$app->getUrlManager()->createUrl(['/discussioni/discussioni-topic-wizard/summary', 'id' => $model->id]),
    'viewPreviousBtn' => false,
    'continueLabel' => AmosDiscussioni::tHtml('amosdiscussioni', 'Back to discussions'),
    'finishUrl' => Yii::$app->session->get(AmosDiscussioni::beginCreateNewSessionKey())
]) ?>
