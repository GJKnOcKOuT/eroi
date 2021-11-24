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

use arter\amos\chat\AmosChat;
use arter\amos\chat\models\User;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\helpers\Html;

/**
 * @var array $model
 * @var int $key
 * @var array $settings
 * @var boolean $isCurrent
 * @var \arter\amos\chat\controllers\DefaultController $appController
 */

$appController = Yii::$app->controller;
$contactObj = User::findOne($model['contact']['id']);
$newMessagesCount = $model['newMessages']['count'];

?>
<a href="<?= '/messages/' . $model['contact']['id'] ?>" class="<?= $settings['itemCssClass'] ?>" data-pjax="0">
    <div
        class="item-chat nop <?= $newMessagesCount > 0 ? $settings['unreadCssClass'] : '' ?> <?= $isCurrent ? $settings['currentCssClass'] : '' ?>"
        data-key="<?= $key ?>" data-contact="<?= $model['contact']['id'] ?>"
        data-unreadurl="<?= $model['unreadUrl'] ?>"
        data-readurl="<?= $model['readUrl'] ?>"
        data-deleteurl="<?= $model['deleteUrl'] ?>"
        data-loadurl="<?= $model['loadUrl'] ?>"
        data-sendurl="<?= $model['sendUrl'] ?>">
        <div class="media">
            <div class="media-left">
                <div class="container-round-img-sm">
                    <?= $contactObj->getAvatar() ?>
                </div>
            </div>
            <div class="media-body">
                <h5 class="media-heading"><strong><?= $model['name'] ?></strong></h5>
                <!-- < ?= $model['contact']['username'] ?> -->
                <p class="time"> <?= $model['lastMessage']['date'] ?></p>


                <?php if ($newMessagesCount > 0): ?>
                    <span class="badge pull-right msg-new">
                        <?= $newMessagesCount ?>
                    </span>
                <?php endif; ?>

            </div>
        </div>
        <!--<div class="conversation-preview-text">
            <?php
/*            $result = Yii::$app->getFormatter()->asRaw($model['lastMessage']['text']);
            if( preg_match_all('/<img[^>]+>/i',$model['lastMessage']['text']) ){
                $result = AmosIcons::show('camera', ['class' => 'am-1']) . '<span> foto</span>';
            }
            */?>
            < ?= $result; ?>
        </div>-->

        <ul class="action-list">
            <li>
                    <span class="close delete_btn" title="<?= AmosChat::t('amoschat', 'Archivia') ?>">
                        <small aria-hidden="true">
                            <?= AmosIcons::show('delete', ['class' => 'am-lg']) ?>
                        </small>
                    </span>
            </li>
        </ul>
    </div>
</a>