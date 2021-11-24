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
 * @package    arter\amos\core\views\layouts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use arter\amos\dashboard\models\AmosWidgets;

////\arter\amos\audit\web\JSLoggingAsset::register($this);
/* @var $this \yii\web\View */
/* @var $content string */
$urlCorrente = Url::current();
$arrayUrl = explode('/', $urlCorrente);
$countArrayUrl = count($arrayUrl);
$percorso = '';
$i = 0;
$moduloId = Yii::$app->controller->module->id;
$basePath = Yii::$app->getBasePath();
if ($moduloId != 'app-backend') {
    $percorso .= '/modules/' . $moduloId . '/views/' . $arrayUrl[$countArrayUrl - 2];
} else {
    $percorso .= 'views';
    while ($i < ($countArrayUrl - 1)) {
        $percorso .= $arrayUrl[$i] . '/';
        $i++;
    }
}
if ($countArrayUrl) {
    $posizioneEsclusione = strpos($arrayUrl[$countArrayUrl - 1], '?');
    if ($posizioneEsclusione > 0) {
        $vista = substr($arrayUrl[$countArrayUrl - 1], 0, $posizioneEsclusione);
    } else {
        $vista = $arrayUrl[$countArrayUrl - 1];
    }
    if (file_exists($basePath . '/' . $percorso . '/help/' . $vista . '.php')) {
        $this->params['help'] = [
            'filename' => $vista
        ];
    }
    if (file_exists($basePath . '/' . $percorso . '/intro/' . $vista . '.php')) {
        $this->params['intro'] = [
            'filename' => $vista
        ];
    }
}
?>

<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "head"); ?>
    </head>
    <body>

    <?php $this->beginBody() ?>

    <div class="container-header">
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "header"); ?>
    </div>

    <div class="container-logo">
        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "logo"); ?>
    </div>

    <?php if (isset(Yii::$app->params['logo-bordo'])): ?>
        <div class="container-bordo-logo"><img src="<?= Yii::$app->params['logo-bordo'] ?>" alt=""></div>
    <?php endif; ?>

    <section id="bk-page">
        <div class="container-messages">
            <div class="container">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "messages"); ?>
            </div>
        </div>

        <div class="container-help">
            <div class="container">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "help"); ?>
            </div>
        </div>

        <div class="container">
            <div class="page-content">
                <?= $this->render("parts" . DIRECTORY_SEPARATOR . "breadcrumb"); ?>
                <div class="page-header">
                    <?php if (!is_null($this->title)) : ?>
                        <h1 class="title"><?= Html::encode($this->title) ?></h1>
                        <?= $this->render("parts" . DIRECTORY_SEPARATOR . "textHelp"); ?>
                    <?php endif; ?>
                </div>

                <?php if (array_key_exists('currentDashboard', $this->params)) : ?>
                <div class="col-xs-12 nop">
                <?php
                    $items = [];
                    $widgetsIcons = $thisDashboardWidgets = $this->params['currentDashboard']
                        ->getAmosWidgetsSelectedIcon(true);

                    if (\Yii::$app->controller->hasProperty('child_of')) {
                        $widgetsIcons
                            ->andFilterWhere([AmosWidgets::tableName() . '.child_of' => \Yii::$app->controller->child_of]);
                    }

                    $allWidgets = $widgetsIcons->all();
                    foreach ($allWidgetsIcons as $widgetIcon) {
                        if (Yii::$app->user->can($widgetIcon['classname'])) {
                            $widgetObj = Yii::createObject($widgetIcon['classname']);
                            $label = $widgetObj->bulletCount 
                                ? $widgetObj->label . '<span class="badge badge-default">' . $widgetObj->bulletCount . '</span>' 
                                : $widgetObj->label;
                            $items[$widgetIcon['classname']] = ['label' => $label, 'url' => $widgetObj->url];
                        }
                    }

                    echo \arter\amos\core\toolbar\Nav::widget([
                        'items' => $items,
                        'encodeLabels' => false,
                        'options' => ['class' => 'nav nav-tabs'],
                    ]);
                ?>
                </div>
                <?php endif; ?>

                <div class="container-change-view  col-xs-12">
                    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "change_view"); ?>
                </div>
                <?= $content ?>
            </div>
        </div>
    </section>

    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "sponsors"); ?>
    <?= $this->render("parts" . DIRECTORY_SEPARATOR . "footer"); ?>

    <?php $this->endBody() ?>

    </body>
    </html>
<?php $this->endPage() ?>