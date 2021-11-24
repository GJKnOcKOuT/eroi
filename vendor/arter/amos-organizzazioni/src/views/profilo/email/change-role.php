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
 * @package    arter\amos\organizzazioni\views\profilo\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\organizzazioni\Module;
use arter\amos\organizzazioni\widgets\ProfiloCardWidget;

/**
 * @var \yii\web\View $this
 * @var \arter\amos\organizzazioni\utility\EmailUtility $util
 */

if (!empty($profile)) {
    $this->params['profile'] = $profile;
}
?>

<div>
    <div style="box-sizing:border-box;">
        <div style="padding:5px 10px;background-color: #F2F2F2;">
            <h1 style="color:#297A38;text-align:center;font-size:1.5em;margin:0;"><?= Module::t('amosorganizzazioni', '#change_role_mail_title') ?></h1>
        </div>
        <div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff; margin-top: 20px;">
            <h2 style="color:#000000;font-size:2em;line-height: 1;"><?= Module::t('amosorganizzazioni', '#change_role_mail_text_1') . $util->contextLabel ?></h2>
            <div style="color:#000000;display: flex; padding: 10px;">
                <div style="width: 50px; height: 50px; -webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                    <?= ProfiloCardWidget::widget([
                        'model' => $util->model,
                        'onlyLogo' => true,
                        'absoluteUrl' => true,
                        'inEmail' => true
                    ]) ?>
                </div>
                <?php
                echo Html::tag('div', '<p style="font-weight: 900">' . $util->model->name . '</p>
                <p>' . $util->model->getDescription(true) . '</p>', ['style' => 'margin: 0 0 0 20px;'])
                ?>
            </div>
            <?php if (!empty($util->role)): ?>
                <div style="color:#000000;width:100%;margin-top:30px">
                    <p>
                        <?= Module::t('amosorganizzazioni', "You are now:") . " " ?>
                        <span style="font-weight: 900"><?= $util->role . "." ?></span>
                    </p>
                </div>
            <?php endif; ?>
            <p style="color:#000000;"><?= Html::a(Module::t('amosorganizzazioni', 'Sign into the platform'), $util->url, ['style' => 'color: green;']) . ' ' .
                Module::t('amosorganizzazioni', "to start working within") . " " . $util->model->name
                ?>
            </p>
            <p style="color:#000000;">
                <?= Module::t('amosorganizzazioni', "#mail_network_organization_1") ?>
                <?= Html::a(' ' . Module::t('amosorganizzazioni', '#mail_network_organization_2'),
                    Yii::$app->urlManager->createAbsoluteUrl('dashboard'),
                    ['style' => 'color: green;']
                ) ?>
                <?= ' ' . Module::t('amosorganizzazioni', '#mail_network_organization_3') . ' ' ?>
                <span style="color:#000000;font-weight: 900; font-style: italic;"><?= Module::t('amosorganizzazioni', '#mail_network_organization_4') ?> </span>
                <?= Module::t('amosorganizzazioni', '#mail_network_organization_5') ?>
            </p>
        </div>
    </div>
</div>
