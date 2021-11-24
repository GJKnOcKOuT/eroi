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
 * @package    @vendor/arter/amos-attachments/src/views
 * @author     Elite Division S.r.l.
 */
/**
 * @var yii\web\View $this
 * @var arter\amos\attachments\models\AttachGallery $model
 */

$this->title = \arter\amos\attachments\FileModule::t('amosattachments', 'Update gallery')." '". $model->name."'";
$this->params['breadcrumbs'][] = ['label' => '', 'url' => ['/attachments']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('amoscore', 'Attach Gallery'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attach-gallery-update">

    <?= $this->render('_form', [
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
        'dataProviderImages' => $dataProviderImages
    ]) ?>

</div>
