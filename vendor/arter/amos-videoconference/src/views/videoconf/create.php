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
* @var arter\amos\videoconference\models\Videoconf $model
*/

$this->title = Yii::t('cruds', 'Crea', [
    'modelClass' => 'Videoconf',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Videoconf'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videoconf-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_partecipanti' => $model_partecipanti,
        'partecipanti' => $partecipanti,
    ]) ?>

</div>
