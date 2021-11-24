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


use arter\amos\core\forms\CloseButtonWidget;
use arter\amos\utility\Module;
use yii\helpers\Html;

$this->title = Module::t('amosutility', 'Run Console Command');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <h1>Platform Console Run</h1>

    <?php $form = \arter\amos\core\forms\ActiveForm::begin(
        ['action' => 'run-cmd', 'id' => 'forum_post', 'method' => 'get',]
    ) ?>
    <div class="col-sm-6">
        <h3>
            <?= Html::label('Console Command', 'cmd_text'); ?>
        </h3>
        <?= Html::textarea('cmd', '', ['rows' => '6', 'cols' => '50', 'id' => 'cmd_text']); ?>
    </div>

    <hr>
    <div class="col-sm-12 ">
        <?= Html::submitButton('Run', ['class' => 'btn btn-navigation-primary', 'name' => 'submit-button']) ?>
        <?= CloseButtonWidget::widget(['urlClose' => '/utility/']) ?>
    </div>
    <?php \arter\amos\core\forms\ActiveForm::end() ?>

</div>
