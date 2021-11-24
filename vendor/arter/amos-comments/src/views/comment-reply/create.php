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
 * @package    arter\amos\comments\views\comment-reply
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\comments\AmosComments;

/**
 * @var yii\web\View $this
 * @var arter\amos\comments\models\CommentReply $model
 */

$this->title = AmosComments::t('amoscomments', 'Create');
$this->params['breadcrumbs'][] = ['label' => AmosComments::t('amoscomments', 'Comments Replies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-reply-create">
    <?= $this->render('_form', [
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
    ]) ?>
</div>
