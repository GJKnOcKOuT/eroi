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
 * @package    arter\amos\organizzazioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\icons\AmosIcons;
use arter\amos\organizzazioni\assets\OrganizzazioniAsset;
use arter\amos\organizzazioni\Module;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var arter\amos\organizzazioni\models\Profilo $model
 */

$moduleL = \Yii::$app->getModule('layout');
if (!empty($moduleL)) {
    OrganizzazioniAsset::register($this);
}

?>

<div class="card-container organization-card-container col-xs-12 nop">
    <div class="col-xs-12 nop icon-header">
        <?= ContextMenuWidget::widget([
            'model' => $model,
            'actionModify' => $model->getFullUpdateUrl(),
            'actionDelete' => $model->getFullDeleteUrl()
        ]) ?>
        <?php
        if (!is_null($model->logoOrganization)) {
            $url = $model->logoOrganization->getUrl('original', [
                'class' => 'img-responsive'
            ]);
            echo Html::img($url, ['alt' => $model->name, 'class' => 'img-responsive']);
        } else {
            echo AmosIcons::show('building', [], 'dash');
        }
        ?>
    </div>
    <div class="col-xs-12 nop icon-body">
        <h3 class="title">
            <?= Html::a($model->name, '/organizzazioni/profilo/view?id=' . $model->id, ['title' => $model->name]); ?>
        </h3>
        <div class="">
            <!-- COSA SONO LE ICONE NEL MOKUP? -->
        </div>
    </div>
    <div class="col-xs-12 nop icon-footer">
        <?= CreatedUpdatedWidget::widget(['model' => $model, 'isTooltip' => true]) ?> <!-- BISOGNA VISUALIZZARE LO STATO -->
        <?= Html::a(Module::t('amosorganizzazioni', '#icon_card_link') . AmosIcons::show('forward'), '#', ['class' => 'icon-footer-link']) ?>
    </div>
</div>
