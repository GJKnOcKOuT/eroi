<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile
 * @category   CategoryName
 */

use arter\amos\admin\AmosAdmin;
use yii\bootstrap\Button;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use backend\models\Settings;

/**
 * @var yii\web\View $this
 */

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => AmosAdmin::t('amosplatform', 'Admin'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => AmosAdmin::t('amosplatform', 'Platform Configurator'), 'url' => ['/admin/settings']];
//$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosAdmin::t('amosplatform', 'Configuration Test');
?>


<hr>

<h3><?= AmosAdmin::t('amosplatform', $result ? 'Success' : 'Failed'); ?></h3>

<hr>