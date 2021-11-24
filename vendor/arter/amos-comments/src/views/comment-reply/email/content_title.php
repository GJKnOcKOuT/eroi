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
 * @package    arter\amos\comments\views\comment\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\comments\AmosComments;

/**
 * @var \arter\amos\core\interfaces\ModelLabelsInterface $model
 * @var \arter\amos\comments\models\Comment $modelComment
 */

?>

<div style="box-sizing:border-box;color:#000000;">
    <div style="padding:5px 10px;background-color: #F2F2F2;text-align:center;">
        <h1 style="color:#297A38;font-size:1.5em;margin:0;">
            <?= AmosComments::t('amoscomments', '#user_published_comment', [$modelComment->createdUserProfile->getSurnameName()]) ?>
        </h1>
        <p style="font-size:1em;margin:0;margin-top:5px;">
            <?= AmosComments::t('amoscomments', '#there_have_content_interest', [$model->getGrammar()->getIndefiniteArticle(), $model->getGrammar()->getModelSingularLabel()]) ?>
        </p>
    </div>
</div>
