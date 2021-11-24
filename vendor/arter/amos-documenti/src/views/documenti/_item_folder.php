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
 * @package    arter\amos\documenti\views\documenti
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\notificationmanager\forms\NewsWidget;

/**
 * @var yii\web\View $this
 * @var arter\amos\documenti\models\Documenti $model
 */

$modelViewUrl = [Yii::$app->controller->action->id, 'parentId' => $model->id];

?>
<div class="listview-container folder">
    <div class="post-horizontal">
        <div class="post-content col-xs-12 nop">
            <div class="post-title col-xs-12">
                <?= AmosIcons::show('folder-open', [], 'dash'); ?>
                <?= Html::a(Html::tag('h2', htmlspecialchars($model->titolo)), $modelViewUrl, ['title' => $model->titolo]) ?>
            </div>
            <?= NewsWidget::widget([
                'model' => $model,
            ]); ?>
        </div>
        <?= ContextMenuWidget::widget([
            'model' => $model,
            'actionModify' => $model->getFullUpdateUrl(),
            'actionDelete' => $model->getFullDeleteUrl(),
            'modelValidatePermission' => 'DocumentValidate',
            'labelDeleteConfirm' => AmosDocumenti::t('amosdocumenti', '#confirm_delete_folder')
//                    'mainDivClasses' => 'col-xs-1 nop'
        ]) ?>
    </div>
</div>
