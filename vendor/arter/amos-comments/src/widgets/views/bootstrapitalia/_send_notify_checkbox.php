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
 * @package    arter\amos\comments\widgets\views\comments-widget
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\comments\AmosComments;
use arter\amos\core\helpers\Html;

/**
 * @var \arter\amos\comments\widgets\CommentsWidget $widget
 * @var bool $enableUserSendMailCheckbox
 * @var bool $displayNotifyCheckBox
 * @var string $checkboxName
 * @var string $viewTypePosition "comment" if from comment and "comment_reply" if from comments view for comment reply
 */

$sendNotifyCheckBox = '';
if ($enableUserSendMailCheckbox) {
    if ($displayNotifyCheckBox) {
        $sendNotifyCheckBox = Html::checkbox($checkboxName, true, ['label' => ' ' . AmosComments::t('amoscomments', '#checkbox_send_notify')]);
    } else {
        $sendNotifyCheckBox = Html::hiddenInput($checkboxName, 1);
    }
}
echo $sendNotifyCheckBox;
