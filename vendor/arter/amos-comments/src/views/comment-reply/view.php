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
use arter\amos\core\forms\CloseButtonWidget;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\comments\models\CommentReply $model
 */

$this->title = strip_tags(substr($model->comment_text, 0, 15) . '...');
$this->params['breadcrumbs'][] = ['label' => AmosComments::t('amoscomments', 'Comments Replies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-reply-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'comment_text'
        ],
    ]) ?>
</div>

<?= CloseButtonWidget::widget([
    'title' => AmosComments::t('amoscomments', 'Close'),
    'layoutClass' => 'pull-right'
]) ?>
