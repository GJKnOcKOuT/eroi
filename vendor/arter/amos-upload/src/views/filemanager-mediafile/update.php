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
* @var arter\amos\upload\models\FilemanagerMediafile $model
*/

$this->title = Yii::t('amosupload', 'Update {modelClass}: ', [
    'modelClass' => 'Filemanager Mediafile',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('amosupload', 'Filemanager Mediafiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('amosupload', 'Update');
?>
<div class="filemanager-mediafile-update">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
