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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var string $subject
 * @var array $userData
 */

$this->title = $subject;
echo AmosChat::tHtml('amoschat','Hai ricevuto ') . $userData['msgCount'] . AmosChat::tHtml('amoschat', 'messaggi/messaggio su ') . Yii::$app->name . AmosChat::tHtml('amoschat',' da ') . $userData['senderCompleteName'];
?>
<div>
    <?= Html::a(AmosChat::t('amoschat','Clicca qui'), ['/messages/' . $userData['sender_id']]) . AmosChat::t('amoschat',' per rispondere alla conversazione.') ?>
</div>