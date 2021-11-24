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


use arter\amos\core\helpers\Html;

/**
 * @var yii\web\View $this
 * @var arter\amos\comuni\models\IstatCittaMetropolitane $model
 */

$this->title = 'Create Istat Citta Metropolitane';
$this->params['breadcrumbs'][] = ['label' => 'Istat Citta Metropolitane', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="istat-citta-metropolitane-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
