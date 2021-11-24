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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\attachments\components\AttachmentsTableWithPreview;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\forms\ShowUserTagsWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\news\AmosNews;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\attachments\components\AttachmentsList;
use arter\amos\core\forms\InteractionMenuWidget;
use arter\amos\news\assets\ModuleNewsAsset;
use \arter\amos\news\models\News;
ModuleNewsAsset::register($this);

/**
 * @var yii\web\View $this
 * @var arter\amos\news\models\News $model
 */

$this->title = $model->titolo;


/** @var \arter\amos\news\controllers\NewsController $controller */
$url = '/img/img_default.jpg';
if (!is_null($model->newsImage)) {
    $url = $model->newsImage->getWebUrl('square_large', false, true);
}

?>

<div class="news-view col-xs-12 nop">
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <div class="header col-xs-12 nop">
            <img class="img-responsive" src="<?= $url ?>" alt="<?= $model->titolo ?>">
            <div class="title col-xs-12">
                <h2 class="title-text"><?= $model->titolo ?></h2>
                <h3 class="subtitle-text"><?= $model->sottotitolo ?></h3>
            </div>
        </div>
        <div class="text-content col-xs-12 nop">
            <?= $model->descrizione; ?>
        </div>
    </div>
    <div class="col-xs-12 text-center">
        <hr>
        <?= Html::a(AmosNews::t('amosnews', '#enter_into_platform'), ['/news/news/view', 'id' => $model->id], [
            'class' => 'btn btn-navigation-primary'
        ])?>
    </div>
</div>

