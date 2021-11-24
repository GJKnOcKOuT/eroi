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

/**
 * @author mult1mate
 * @since 31.12.2015
 * @var string $content
 */
use yii\helpers\Html;
use yii\helpers\Url;

$menu = [
    'index'        => Yii::t('cron', 'Tasks list'),
    'update'    => Yii::t('cron', 'Add new/edit task'),
    'show-log'     => Yii::t('cron', 'Logs'),
    'export'       => Yii::t('cron', 'Import/Export'),
    'tasks-report' => Yii::t('cron', 'Report'),
];

?>
<div class="col-lg-10">

    <h2><?=Yii::t('cron', 'Cron tasks manager')?></h2>

    <?php foreach (Yii::$app->session->getAllFlashes(true) as $key => $message) : ?>
        <div class="alert alert-<?= $key ?>"><?= $message ?></div>
    <?php endforeach; ?>

    <ul class="nav nav-tabs">
        <?php foreach ($menu as $route => $text):
            $class = Yii::$app->controller->action->id == $route ? 'active' : '';
            ?>
            <li class="<?= $class ?>"><?= Html::a($text, Url::toRoute($route)) ?></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <?= isset($content) ? $content : '' ?>
</div>
