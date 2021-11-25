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
 * @package    arter\amos\best\practice\views\expressions-of-interest
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\best\practice\Module;

/**
 * @var yii\web\View $this
 * @var arter\amos\best\practice\models\BestPractice $model
 */

$this->title = Module::t('amosbestpractice', '#update_best_practice');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Best Practice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="best-practice-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
