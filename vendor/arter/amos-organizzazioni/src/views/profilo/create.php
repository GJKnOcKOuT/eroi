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
 * @package    arter\amos\organizzazioni\views\profilo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\Module;

/**
 * @var yii\web\View $this
 * @var arter\amos\organizzazioni\models\Profilo $model
 * @var arter\amos\organizzazioni\models\ProfiloSediLegal $mainLegalHeadquarter
 * @var arter\amos\organizzazioni\models\ProfiloSediOperative $mainOperativeHeadquarter
 */

$this->title = Module::t('amosorganizzazioni', 'Create organization');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="are-profilo-create">
    <?= $this->render('_form', [
        'model' => $model,
        'mainLegalHeadquarter' => $mainLegalHeadquarter,
        'mainOperativeHeadquarter' => $mainOperativeHeadquarter,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
        'moduleCwh' => $moduleCwh,
        'scope' => $scope
    ]) ?>
</div>
