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
use arter\amos\chat\assets\AmosChatAsset;
use yii\data\ActiveDataProvider;
use yii\web\View;

$assetBundle = AmosChatAsset::register($this);
?>

<div class="box-widget-header">
    <div class="box-widget-wrapper">
        <div class="box-widget-toolbar row nom">
            <h2 class="box-widget-title col-xs-10 nop"><?= $widget->titleWidget ?></h2>
        </div>
    </div>
</div>

<div class="box-widget chat-assistance-widget">
        <section>
            <?= Html::img(!empty($widget->urlImage) ? $widget->urlImage : $assetBundle->baseUrl . '/img/info_chat.jpg', ['alt' => 'Scrivici per maggiori informazioni', 'style' => 'max-width: 100%; margin: 0 auto;']) ?>
            <?= Html::a($widget->buttonText,
                [
                    '/chat/default/chat-with-assistance', 'user_id' => $widget->assistanceUserId,
                    'url' => $url,
                    'idchatAssistance' => $widget->assistanceWidgetId
                ],
                ['class' => 'btn btn btn-navigation-secondary', 'title' => $widget->buttonText]); ?>
        </section>
</div>
