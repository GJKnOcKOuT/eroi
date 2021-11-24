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
 * @package    arter\amos\partnershipprofiles\views\expressions-of-interest
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\partnershipprofiles\Module;

/**
 * @var yii\web\View $this
 * @var arter\amos\partnershipprofiles\models\ExpressionsOfInterest $model
 * @var arter\amos\partnershipprofiles\models\PartnershipProfiles $partnershipProfile
 */

$this->title = Module::t('amospartnershipprofiles', 'Create expression of interest');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="<?= Yii::$app->controller->id ?>-create">
    <?= $this->render('_form', [
        'model' => $model,
        'partnershipProfile' => $partnershipProfile,
    ]) ?>
</div>
