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
 * @package    arter\amos\documenti\views\documenti
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\utility\DocumentsUtility;
use yii\helpers\Html;

/**
 * @var \arter\amos\documenti\models\Documenti $model
 * @var \arter\amos\documenti\widgets\DocumentsOwlCarouselWidget $widget
 */

$documentIcon = DocumentsUtility::getDocumentIcon($model);
$titleUrl = [Yii::$app->controller->action->id, 'parentId' => $model->id];
$iconUrl = $titleUrl;
if (!$model->is_folder) {
    $titleUrl = $model->getFullViewUrl();
    $iconUrl = $model->getDocumentMainFileUrl();
}

?>

<div class="owl-item-content">
    <div class="col-xs-3 col-md-3 nop">
        <span class="date"><?= AmosDocumenti::t('amosdocumenti', '#carousel_update_at') ?></span>
        <span class="date"><?= \Yii::$app->formatter->asDate($model->data_pubblicazione) ?></span>
        <div>
            <?= Html::a($documentIcon, $iconUrl, [
                'title' => AmosDocumenti::t('amosdocumenti', '#carousel_download'),
                'class' => ($model->is_folder) ? 'is-folder' : 'is-file'
            ]); ?>
            <?php if (!$model->is_folder): ?>
                <?= Html::a(AmosDocumenti::t('amosdocumenti', '#carousel_download'), $iconUrl, [
                    'title' => AmosDocumenti::t('amosdocumenti', '#carousel_download'),
                    'class' => 'download-file',
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-xs-9 col-md-9 nop">
        <?= ItemAndCardHeaderWidget::widget([
            'model' => $model,
            'publicationDateNotPresent' => true,
            'showPrevalentPartnershipAndTargets' => true,
            'truncateLongWords' => true,
        ]) ?>
        <div class="col-xs-12 nop title">
            <?= Html::a($model->titolo, $titleUrl); ?>
        </div>
        <?php if (!is_null($model->parent)): ?>
            <div class="col-xs-12 nop directory">
                <?= AmosDocumenti::t('amosdocumenti', 'in') . ' "' . $model->parent->titolo . '"'; ?>
            </div>
        <?php endif; ?>
        <div class="col-xs-12 nop read-more">
            <?= Html::a(AmosDocumenti::t('amosdocumenti', '#carousel_details') . AmosIcons::show('chevron-right'), $titleUrl); ?>
        </div>
    </div>
</div>
