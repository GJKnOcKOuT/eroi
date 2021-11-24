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
 * @package    arter\amos\sondaggi\views\sondaggi
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\sondaggi\AmosSondaggi;

/**
 * @var yii\web\View $this
 * @var arter\amos\sondaggi\models\Sondaggi $model
 * @var \arter\amos\cwh\AmosCwh $moduleCwh
 * @var array $scope
 */

$this->title = AmosSondaggi::t('amossondaggi', 'Inserisci sondaggio');
$this->params['breadcrumbs'][] = ['label' => AmosSondaggi::t('amossondaggi', 'Sondaggi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sondaggi-create">
    <?=
    $this->render('_form', [
        'model' => $model,
        'url' => (isset($url)) ? $url : NULL,
        'public' => isset($public) ? $public : NULL,
        'moduleCwh' => $moduleCwh,
        'scope' => $scope
    ])
    ?>
</div>
