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

use arter\amos\core\utilities\ViewUtility;
use arter\amos\sondaggi\AmosSondaggi;

use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\sondaggi\models\SondaggiRisposteSessioni $model
 */

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => AmosSondaggi::t('amossondaggi', 'Sondaggi Risposte Sessioni'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sondaggi-risposte-sessioni-view">
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'session_id',
        'unique_id',
        ['attribute' => 'begin_date', 'format' => ['datetime', ViewUtility::formatDateTime()]],
        ['attribute' => 'end_date', 'format' => ['datetime', ViewUtility::formatDateTime()]],
        'session_tmp:ntext',
        'user_profile_id',
        'sondaggi_id',
        ['attribute' => 'created_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
        ['attribute' => 'updated_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
        ['attribute' => 'deleted_at', 'format' => ['datetime', ViewUtility::formatDateTime()]],
        'created_by',
        'updated_by',
        'deleted_by',
        'version',
    ],
]) ?>
</div>
