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
 * @package    arter\amos\core\forms\editors\m2mwidget\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\utilities\JsUtility;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var \yii\db\ActiveRecord $model
 * @var \arter\amos\core\forms\editors\m2mWidget\M2MWidget $widget
 * @var string $pjaxContainerId
 * @var string $gridViewContainerId
 * @var string $gridId
 * @var bool $useCheckbox
 */

$post = Yii::$app->getRequest()->post();
$genericSearchFieldId = 'm2mwidget-generic-search-textinput';
$fromGenericSearchFieldId = 'm2mwidget-from-generic-search-hiddeninput';
$resetId = 'm2mwidget-generic-search-reset-btn';
$submitId = 'm2mwidget-generic-search-submit-btn';

$js = JsUtility::getM2mSecondGridSearch($gridId, $this->params['postName'], $this->params['postKey'], $isModal, $useCheckbox);
$this->registerJs($js, View::POS_READY);

?>
<div class="m2mwidget-generic-search">
    <div class="col-xs-12 nop m-15-0">
        <div class="col-sm-6 col-lg-4 nop">
            <!-- TODO Rimuovere hiddenInput fromGenericSearch quando funzioner√† il pjax -->
            <?= Html::hiddenInput('fromGenericSearch', 0, [
                'id' => $fromGenericSearchFieldId
            ]); ?>

            <?= Html::textInput('genericSearch', (isset($post['genericSearch']) ? $post['genericSearch'] : null), [
                'placeholder' => BaseAmosModule::t('amoscore', 'Search') . '...',
                'id' => $gridId . '-search-field', 'class' => 'form-control'
            ]); ?>
        </div>

        <div class="col-sm-6 col-lg-8">
            <?php
            if (
                (isset(Yii::$app->params['m2mwidgetButtonPagination']) && (Yii::$app->params['m2mwidgetButtonPagination'] == true)) ||
                ($widget->m2mwidgetButtonPagination == true)
            ) {
                // add to curent url disable pagination params
                if (null == Yii::$app->getRequest()->get('disablePagination')) {
                    // add parameter to this url
                    $url_disable_pagination = yii\helpers\Url::current() . "&disablePagination=" . true;

                    echo Html::a(BaseAmosModule::t('amoscore', 'Senza Paginazione'), [$url_disable_pagination], ['class' => 'btn btn-secondary']);

                } else {
                    $url_disable_pagination = yii\helpers\Url::current();

                    echo Html::a(BaseAmosModule::t('amoscore', 'Con Paginazione'), [yii\helpers\Url::current(['disablePagination' => null])], ['class' => 'btn btn-secondary']);
                }
            }
            ?>
            <?= Html::button(BaseAmosModule::t('amoscore', '#reset_m2m_target_search_label'), ['class' => 'btn btn-secondary', 'id' => $gridId . '-reset-search-btn']) ?>
            <?= Html::button(BaseAmosModule::t('amoscore', 'Search'), ['class' => 'btn btn-navigation-primary', 'id' => $gridId . '-search-btn']) ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
