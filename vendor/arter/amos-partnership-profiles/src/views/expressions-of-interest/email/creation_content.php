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
 * @package    arter\amos\partnershipprofiles\views\expressions-of-interest\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use arter\amos\partnershipprofiles\Module;

/**
 * @var ExpressionsOfInterest $expressionOfInterest
 */

?>
<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;">

    <div>
        <div style="margin-top: 20px;color:#000000;margin-left: 10px;">
            <h2 style="font-size:1.5em;line-height: 1;"><?= $expressionOfInterest->createdUserProfile->getNomeCognome() . ' ' . Module::t('amospartnershipprofiles', 'presented an expression of interest for the partnership profile') ?></h2>
        </div>
    </div>

    <div style="padding:0;margin:0">
        <h3 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">
            <?= Html::a($expressionOfInterest->partnershipProfile->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($expressionOfInterest->partnershipProfile->getFullViewUrl()), ['style' => 'color: #297A38;']) ?>
        </h3>
    </div>

    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;color:#000000;">
        <?= $expressionOfInterest->partnershipProfile->getDescription(true); ?>
    </div>
</div>