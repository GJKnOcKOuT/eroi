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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var yii\web\View $this
 * @var string $widgetClass
 * @var string $resetButton
 * @var array $buttons
 * @var string $hiddenActions
 * @var string $notificationInput
 * @var string $renderStatusError
 */

?>

<div class="workflow-transition-button-widget col-xs-12">
    <div class="workflow-buttons-container col-lg-10 col-lg-push-2 col-xs-12 nop">
        <?php foreach ($buttons as $button) : ?>
            <div class="workflow-form-actions workflow-button-container">
                <?= $button['button']; ?>
                <p><?= $button['stateDescriptor'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="workflow-button-container col-lg-2 col-lg-pull-10 col-xs-12 nop">
        <?= $resetButton ?>
    </div>
    <div class="field-workflow-status_id required has-error">
        <div class="row">
            <div class="col-xs-12">
                <div class="tooltip-error-field">
                    <?= $renderStatusError; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $hiddenActions; ?>
<?= $notificationInput ?>
