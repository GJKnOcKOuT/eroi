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
 * @package    arter\amos\admin\views\user-contact
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;

/**
 * @var \arter\amos\admin\models\UserProfile $contactProfile
 * @var string $message
 * @var string $url
 * @var string $messageLink
 */

?>

<div>
    <div style="box-sizing:border-box;">
        <div class="corpo"
             style="border:1px solid #cccccc;padding:10px;margin-bottom:10px;background-color:#ffffff;margin-top:20px">
            <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                    'model' => $contactProfile,
                    'onlyAvatar' => true,
                    'absoluteUrl' => true
                ]) ?>
            </div>
            <div style="margin: 0 0 0 20px;">
                <p style="font-weight: 900"><?= $contactProfile->getNomeCognome() ?></p>
                <p><?= $message ?></p>
            </div>
        </div>
        <div style="width:100%;margin-top:30px">
            <p><?=
                Html::a(AmosAdmin::t('amosadmin', 'Sign into the platflorm'), $url, ['style' => 'color: #297a38;']). ' '. $messageLink
                ?>
            </p>
        </div>
    </div>
</div>