<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\chat\AmosChat;
use arter\amos\core\helpers\Html;
use arter\amos\core\forms\TextEditorWidget;
?>
<?= Html::beginForm('', 'post', [
    'id' => 'msg-form',
    'class' => 'col-xs-11 nop'
]); ?>
<label class="hidden" for="chat-message"><?= AmosChat::tHtml('amoschat', 'Messaggio') ?></label>

<?= TextEditorWidget::widget([
    'name' => 'text',
    'options' => [
        'id' => 'chat-message',
        'class' => 'form-control send-message',
        'placeholder' => AmosChat::t('amoschat', 'Scrivi una risposta...')
    ],
    'clientOptions' => [
        'focus' => true,
        'buttons' => Yii::$app->controller->module->formRedactorButtons,
        'lang' => substr(Yii::$app->language, 0, 2),
        'toolbar' => "link image",
        'plugins' => ['autosave'],
        'setup' => new yii\web\JsExpression('function(editor) {
                editor.on("change keyup", function(e){
                    //console.log("Saving");
                    //tinyMCE.triggerSave(); // updates all instances
                    editor.save();
                    $(editor.getElement()).trigger("change"); 
                });
            }')
    ]
]) ?>
<?= Html::endForm(); ?>
