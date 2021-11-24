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
 * @var arter\amos\sondaggi\models\SondaggiRisposteSessioni $model
 */

$this->title = AmosSondaggi::t('amossondaggi', 'Aggiorna {modelClass}', [
    'modelClass' => 'Sondaggi Risposte Sessioni',
]);
$this->params['breadcrumbs'][] = ['label' => AmosSondaggi::t('amossondaggi', 'Sondaggi Risposte Sessioni'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosSondaggi::t('amossondaggi', 'Aggiorna');
?>
<div class="sondaggi-risposte-sessioni-update">
<?= $this->render(
    '_form',
    ['model' => $model,])
?>
</div>
