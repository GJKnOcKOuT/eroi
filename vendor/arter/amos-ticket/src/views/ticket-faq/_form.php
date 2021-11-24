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
 * @package    arter\amos\ticket\views\ticket-faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\AccordionWidget;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\editors\Select;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\utility\TicketUtility;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\TicketFaq $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<div class="ticket-faq-form col-xs-12 nop">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'ticket_categoria_id')->widget(Select::className(), [
        'auto_fill' => false,
        'options' => [
            'placeholder' => AmosTicket::t('amosticket', '#ticket_category_field_placeholder'),
            'id' => 'ticket_categoria_id-id',
            'disabled' => false,
            'value' => $model->ticket_categoria_id
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'data' =>
            ArrayHelper::map(TicketUtility::getTicketCategories(null, false)
                ->orderBy('titolo')->all(), 'id', 'nomeCompleto'),
    ]); ?>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?=
            $form->field($model, 'domanda')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'buttonsHide' => [
                        'image',
                        'file'
                    ],
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?=
            $form->field($model, 'risposta')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'buttonsHide' => [
                        'image',
                        'file'
                    ],
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ])
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?php
            $moduleSeo = \Yii::$app->getModule('seo');
            if (isset($moduleSeo)) :
                ?>
                <?=
                AccordionWidget::widget([
                    'items' => [
                        [
                            'header' => AmosTicket::t('amosticket', '#settings_seo_title'),
                            'content' => \arter\amos\seo\widgets\SeoWidget::widget([
                                'contentModel' => $model,
                            ]),
                        ]
                    ],
                    'headerOptions' => ['tag' => 'h2'],
                    'options' => Yii::$app->user->can('ADMIN') ? [] : ['style' => 'display:none;'],
                    'clientOptions' => [
                        'collapsible' => true,
                        'active' => 'false',
                        'icons' => [
                            'header' => 'ui-icon-amos am am-plus-square',
                            'activeHeader' => 'ui-icon-amos am am-minus-square',
                        ]
                    ],
                ]);
                ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
