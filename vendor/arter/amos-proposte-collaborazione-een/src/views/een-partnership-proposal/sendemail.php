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
 * @package    arter\amos\een\views\een-partnership-proposal
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\een\AmosEen;


/**
 * @var yii\web\View $this
 * @var arter\amos\een\models\search\EenPartnershipProposalSearch $model
 * @var yii\widgets\ActiveForm $form
 */


?>

<div >

    <div >
        <h2 class="title">
            <?= AmosEen::t('amoseen', '#mailsended'); ?>
        </h2>
    </div>
    <a class= 'btn btn-navigation-primary' href="<?= Yii::$app->urlManager->createUrl(['/' . AmosEen::getModuleName() .'/een-partnership-proposal']); ?>" title="<?= AmosEen::t('amoseen', '#return') ?>"><?= AmosEen::t('amoseen', '#return') ?></a>
</div>
