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
 * @package    arter\amos\documenti\widgets\graphics\views\hierarchical-documents
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\documenti\utility\DocumentsUtility;
use arter\amos\documenti\widgets\graphics\WidgetGraphicsHierarchicalDocuments;

/**
 * @var yii\web\View $this
 * @var \arter\amos\documenti\models\Documenti $model
 */

$moduleDocuments = \Yii::$app->getModule(\arter\amos\documenti\AmosDocumenti::getModuleName());
$hidePubblicationDate = $moduleDocuments->hidePubblicationDate;
?>

<?= Html::beginTag('a', WidgetGraphicsHierarchicalDocuments::getLinkOptions($model)) ?>
<div class="card-container col-xs-12 nop<?= (!$model->is_folder ? ' file' : '') ?>">
    <div class="widget-listbox-option" role="option">
        <article class="col-xs-12 nop">
            <div class="container-icon col-xs-12">
                <?= DocumentsUtility::getDocumentIcon($model) ?>
            </div>
            <div class="icon-body col-xs-12">
                <p class="date">
                    <?= WidgetGraphicsHierarchicalDocuments::getDocumentDate($model) ?></p>
                <p class="directory-title"><?= WidgetGraphicsHierarchicalDocuments::getIconDescription($model) ?></p>
            </div>
        </article>
    </div>
</div>
<?= Html::endTag('a') ?>
