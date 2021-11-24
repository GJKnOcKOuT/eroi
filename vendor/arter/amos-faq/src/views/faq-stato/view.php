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

use yii\widgets\DetailView;
use arter\amos\faq\AmosFaq;

/**
 * @var yii\web\View $this
 * @var arter\amos\faq\models\FaqStato $model
 */
$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => AmosFaq::t('amosfaq', 'Faq'), 'url' => ['/src/src']];
$this->params['breadcrumbs'][] = ['label' => AmosFaq::t('amosfaq', 'Stati'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-stato-view">

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome',
            'descrizione:ntext',
        ],
    ])
    ?>

</div>
