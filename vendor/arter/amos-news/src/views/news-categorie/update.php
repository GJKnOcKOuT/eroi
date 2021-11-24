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
 * @package    arter\amos\news\views\news-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\news\AmosNews;

/**
 * @var yii\web\View $this
 * @var arter\amos\news\models\NewsCategorie $model
 */

$this->title = $model->titolo;
$this->params['breadcrumbs'][] = ['label' => AmosNews::t('amosnews', 'Notizie'), 'url' => '/news'];
$this->params['breadcrumbs'][] = ['label' => AmosNews::t('amosnews', 'Categorie notizie'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->titolo, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosNews::t('amosnews', 'Aggiorna');
?>
<div class="news-categorie-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
