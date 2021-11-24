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

use arter\amos\admin\widgets\UserCardWidget;
?>
    <div class="media-left">
        <?= UserCardWidget::widget(['model' => $comment->createdUserProfile, 'enableLink' => false]) ?>
    </div>
     <div class="clearfix"></div>
     <p class="answer_text"><?= Yii::$app->getFormatter()->asRaw(strip_tags($comment->comment_text)) ?></p>
