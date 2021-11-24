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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;


/* @var $this yii\web\View */
/* @var $model arter\amos\emailmanager\models\EmailSpool */

$this->title = 'Create Email Spool';
$this->params['breadcrumbs'][] = ['label' => 'Email Spools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-spool-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
