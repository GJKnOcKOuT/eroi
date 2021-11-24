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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var arter\amos\upload\models\FilemanagerOwners $model
*/

$this->title = Yii::t('amosupload', 'Update {modelClass}: ', [
    'modelClass' => 'Filemanager Owners',
]) . ' ' . $model->mediafile_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amosupload', 'Filemanager Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mediafile_id, 'url' => ['view', 'mediafile_id' => $model->mediafile_id, 'owner_id' => $model->owner_id, 'owner' => $model->owner, 'owner_attribute' => $model->owner_attribute]];
$this->params['breadcrumbs'][] = Yii::t('amosupload', 'Update');
?>
<div class="filemanager-owners-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
