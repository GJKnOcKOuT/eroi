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

use arter\amos\attachments\components\AttachmentsList;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\utility\DocumentsUtility;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var arter\amos\documenti\models\Documenti $model
 */

$this->title = $model->titolo;
$ruolo = Yii::$app->authManager->getRolesByUser(Yii::$app->getUser()->getId());
$documentMainFile = $model->documentMainFile;


/** @var \arter\amos\documenti\controllers\DocumentiController $controller */


?>

<div class="documents-view col-xs-12 nop">
    <div class="clearfix"></div>
    <div class="col-md-8 col-xs-12">
        <div class="header col-xs-12 nop">
            <div class="title col-xs-12">
                <h2 class="title-text"><?= $model->titolo ?></h2>
                <h3 class="subtitle-text"><?= $model->sottotitolo ?></h3>
            </div>
        </div>
        <div class="col-xs-12 download-file nop">
            <div class="col-xs-12 action-document">
                <div>
                    <div>
                        <?=
                        DocumentsUtility::getDocumentIcon($model);
                        ?>
                    </div>
                    <div>
                        <?=
                        Html::tag('p', ((strlen($documentMainFile->name) > 80) ? substr($documentMainFile->name, 0, 75) . '[...]' : $documentMainFile->name) . '.' . $documentMainFile->type, ['class' => 'filename']);
                        ?>
                    </div>
                </div>
                <div>
                    <?= Html::a(/*AmosDocumenti::tHtml('amosdocumenti', 'Scarica file') . */
                        AmosIcons::show('download'), [$model->getDocumentMainFile()->getWebUrl()], [
                        'title' => AmosDocumenti::t('amosdocumenti', 'Scarica file'),
                        'class' => 'bk-btnImport pull-right btn btn-icon',
                    ]); ?>

                </div>
            </div>

        </div>
        <div class="text-content col-xs-12 nop">
            <?= $model->descrizione; ?>
        </div>
    </div>


</div>
<?= Html::a(AmosDocumenti::t('amosnews', '#enter_into_platform'), ['/documenti/documenti/view', 'id' => $model->id], [
    'class' => 'btn btn-secondary pull-left m-b-10'
])?>