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


use yii\widgets\Pjax;
use arter\amos\core\views\AmosLinkPager;
use arter\amos\comments\AmosComments;
use arter\amos\attachments\components\AttachmentsTable;
use arter\amos\attachments\FileModule;

$currentAsset = $asset::register($this);

Pjax::begin([
    'id' => 'pjax-block-comments',
    'timeout' => 15000,
    'linkSelector' => false
]);
?>


<?php
$prev[-1] = 'bk-contribute';
foreach ($comments as $k => $comment):
    ?>
    <?php
    /** @var \arter\amos\comments\models\Comment $comment */
    $prev[$k]           = 'comment_id'.$comment->id;
    ?>
    <div class="media border-bottom mb-4">
        <div class="avatar size-sm mr-2">
            <img src="<?= $comment->createdUserProfile->getAvatarUrl('square_small') ?>" alt="<?= $comment->createdUserProfile->nomeCognome ?>">
        </div>
        <div id="comment_id<?= $comment->id ?>" class="media-body">
            <p class="mt-0 mb-2">
                <small><a href="/admin/user-profile/view?id=<?= $comment->createdUserProfile->id ?>"><?= $comment->createdUserProfile->nomeCognome ?></a> <span class="text-muted"><?= \Yii::$app->formatter->asDatetime($comment->created_at) ?></span></small>
            </p>
            <?= \Yii::$app->formatter->asHtml($comment->comment_text) ?>
            <?php $commentAttachments = $comment->getCommentAttachmentsForItemView(); ?>
            <?php if (count($commentAttachments) > 0) { ?>
                <p>Allegati</p>
                <?php
                foreach ($commentAttachments as $k => $v) {
                    $urlDelete = \yii\helpers\Url::to([
                            '/'.FileModule::getModuleName().'/file/delete',
                            'id' => $v->id,
                            'item_id' => $comment->id,
                            'model' => get_class($comment),
                            'attribute' => 'commentAttachments'
                    ]);
                    ?>
                <p>
                        <a href="<?= $v->getWebUrl() ?>" title="<?= $v->name ?>">
                            <?= $v->name ?>
                        </a>
                        <?php if (\Yii::$app->user->can('COMMENT_UPDATE', ['model' => $comment])) { ?>
                            <a href="<?= $urlDelete ?>" title="<?= AmosComments::t('amoscomments', 'Cancella') ?>" data-confirm="<?=
                            AmosComments::t('amoscomments', 'Sei sicuro di voler cancellare l\'allegato?')
                            ?>">
                                <span class="rounded-icon rounded-white">
                                    <svg class="icon icon-dark">
                                    <use xlink:href="<?= $currentAsset->baseUrl ?>/sprite/material-sprite.svg#ic_delete"></use>
                                    </svg>
                                </span>
                                <span class="sr-only"><?= AmosComments::t('amoscomments', 'Cancella allegato') ?></span>
                            </a>
                        <?php } ?>
                    </p>
                    <?php
                }
            }
            ?>
            <p class="mt-2">
                <small>
                    <?php if (\Yii::$app->user->can('COMMENT_UPDATE', ['model' => $comment])) { ?>
                        <a href="<?= "/".AmosComments::getModuleName()."/comment/update?id=".$comment->id."&noAttach=$no_attach&url=".\yii\helpers\Url::current()."#comment_id".$comment->id ?>" class="mr-3">
                            <?=
                            AmosComments::t('amoscomments', 'Modifica')
                            ?>
                        </a>
                    <?php } ?>
                    <?php if (\Yii::$app->user->can('COMMENT_DELETE', ['model' => $comment])) { ?>
                        <a class="text-danger" href="<?=
                           "/".AmosComments::getModuleName()."/comment/delete?id=".$comment->id."&url=".\yii\helpers\Url::current()."#".$prev[$k
                           - 1]
                           ?>"><?=
                               AmosComments::t('amoscomments', 'Elimina')
                               ?>
                        </a>
                    <?php } ?>
                </small>
            </p>
        </div>
    </div>
<?php endforeach; ?>
<?php Pjax::end(); ?>