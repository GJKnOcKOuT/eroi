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

$widgetClassname2 = \openinnovation\landing\widgets\graphics\WidgetGraphicLiveChat::className();
$widget2 = \Yii::createObject($widgetClassname2);
echo '<div data-code="' . $widget2::classname() . '" data-module-name>' . $widget2::widget(['url' => '/community/join/live-chat']) . '</div>';