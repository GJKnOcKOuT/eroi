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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\faq\AmosFaq;

/**
 * @var yii\web\View $this
 * @var arter\amos\faq\models\Faq $model
 */

$this->title = AmosFaq::t('amosfaq', 'Aggiorna {modelClass}', [
        'modelClass' => 'Faq',
    ]);
$this->params['breadcrumbs'][] = ['label' => AmosFaq::t('amosfaq', 'Faq'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->domanda, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = AmosFaq::t('amosfaq', 'Aggiorna');
?>
<div class="faq-update">

    <?= $this->render('_form', [
        'model' => $model,
        //'listaWidget' => $listaWidget,
    ]) ?>

</div>
