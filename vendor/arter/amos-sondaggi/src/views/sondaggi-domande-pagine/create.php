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


use arter\amos\sondaggi\AmosSondaggi;

/**
 * @var yii\web\View $this
 * @var arter\amos\sondaggi\models\SondaggiDomandePagine $model
 */

$this->title = AmosSondaggi::t('amossondaggi', 'Aggiungi pagina al sondaggio');
$this->params['breadcrumbs'][] = ['label' => AmosSondaggi::t('amossondaggi', 'Sondaggi'), 'url' => ['/' . $this->context->module->id . '/sondaggi/index']];
if (isset($url)) {
    if (strstr(yii\helpers\Url::previous(), "sondaggi/sondaggi-domande-pagine/")) {
        $this->title = AmosSondaggi::t('amossondaggi', 'Aggiungi pagina al sondaggio: ' . $model->getSondaggi()->one()['titolo']);
        $this->params['breadcrumbs'][] = ['label' => AmosSondaggi::t('amossondaggi', 'Pagine del sondaggio'), 'url' => $url];
    } else {
        $this->title = AmosSondaggi::t('amossondaggi', 'Aggiungi pagina al sondaggio: ' . $model->getSondaggi()->one()['titolo']);
    }
} else {
    $this->params['breadcrumbs'][] = ['label' => AmosSondaggi::t('amossondaggi', 'Pagine dei sondaggi'), 'url' => ['/' . $this->context->module->id . '/sondaggi-domande-pagine/index']];
}
$this->params['breadcrumbs'][] = AmosSondaggi::t('amossondaggi', 'Aggiungi pagina al sondaggio');
?>
<div class="sondaggi-domande-pagine-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        'url' => (isset($url)) ? $url : NULL
    ])
    ?>
</div>
