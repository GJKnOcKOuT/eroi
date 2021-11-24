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
 * @package    arter\amos\documenti\views\documenti
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\documenti\AmosDocumenti;

/**
 * @var yii\web\View $this
 * @var arter\amos\documenti\models\Documenti $model
 */

/** @var \arter\amos\documenti\controllers\DocumentiController $controller */
$controller = Yii::$app->controller;
$controller->setNetworkDashboardBreadcrumb();
$isFolder = $controller->documentIsFolder($model);
if ($isFolder) {
    $this->title = AmosDocumenti::t('amosdocumenti', '#create_folder_title');
} else {
    $this->title = AmosDocumenti::t('amosdocumenti', 'Inserisci documento');
}
$this->params['breadcrumbs'][] = ['label' => AmosDocumenti::t('amosdocumenti', Yii::$app->session->get('previousTitle')), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documenti-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>