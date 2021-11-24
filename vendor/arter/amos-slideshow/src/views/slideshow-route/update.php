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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\slideshow\AmosSlideshow;

/**
 * @var yii\web\View $this
 * @var backend\modules\slideshow\models\SlideshowRoute $model
 */

$this->title = AmosSlideshow::t('amosslideshow', 'Aggiorna {modelClass}', [
    'modelClass' => 'Slideshow Route',
]);
$this->params['breadcrumbs'][] = ['label' => AmosSlideshow::t('amosslideshow', 'Slideshow Route'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosSlideshow::t('amosslideshow', 'Aggiorna');
?>
<div class="slideshow-route-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
