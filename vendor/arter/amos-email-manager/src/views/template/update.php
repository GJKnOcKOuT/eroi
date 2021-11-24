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

use arter\amos\emailmanager\AmosEmail;
use arter\amos\emailmanager\models\EmailTemplate;

/* @var $this yii\web\View */
/* @var $model EmailTemplate */

$this->title = 'Update Email Template: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => AmosEmail::t('amosemail', 'Email Templates'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="email-template-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
