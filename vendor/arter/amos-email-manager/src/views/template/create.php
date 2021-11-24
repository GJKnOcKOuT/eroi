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

$this->title = 'Create Email Template';
$this->params['breadcrumbs'][] = ['label' => AmosEmail::t('amosemail', 'Email Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-template-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
