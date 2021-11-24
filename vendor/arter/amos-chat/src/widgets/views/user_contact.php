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
use arter\amos\chat\AmosChat;
/**
 * @var \arter\amos\chat\models\User $model
 * @var \arter\amos\chat\controllers\DefaultController $appController
 * @var array $settings
 * @var int $key
 */

//check if the user contact is disabled
$disabled = false;
$disabledText = "";
if($disableByCommunityScope){
    $disabled = true;
    $disabledText = AmosChat::t('amoschat', '#disabled_community_scope');
}

if(!$disabled){ ?>
<a class="user-contacts-item" href="<?= '/messages/' . $model->id ?>">
<?php } ?>
    <div class="item-chat media nop <?= $settings['itemCssClass'] ?> <?=($disabled ? "user-disabled" : "")?>" data-key="<?= $key ?>"
         data-user-contact="<?= $model->id ?>" <?=($disabledText ? "title=\"$disabledText\"" : "")?>>
        <div class="media-left">
            <div class="container-round-img">
                <?= $model->getAvatar() ?>
            </div>
        </div>
        <div class="media-body">
            <h5 class="media-heading"><strong><?= $model->name ?></strong></h5>
            <!-- < ?= $model->username ?> -->
        </div>
    </div>
<?php if(!$disabled){ ?>
</a>
<?php } ?>