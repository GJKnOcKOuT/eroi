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
 * @package    arter\amos\events\views\event-wizard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\events\AmosEvents;

/**
 * @var yii\web\View $this
 * @var \arter\amos\events\models\Event $model
 * @var string $finishMessage
 */

$this->title = AmosEvents::t('amosevents',"Nuovo Evento");
?>

<div class="col-xs-12">
    <div class="row">
        <div class="col-xs-12">
            <h3><?= $finishMessage ?></h3>
            <h4><?= AmosEvents::tHtml('amosevents', "Clic on 'back to events' to finish.") ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <?= Html::a(AmosEvents::tHtml('amosevents', 'Back to events'), ['/events/event/index'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
</div>
