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
 * @package    arter\amos\discussioni\views\discussioni-topic
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\widgets\UserCardWidget;
use arter\amos\attachments\components\AttachmentsTableWithPreview;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\core\forms\ShowUserTagsWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\helpers\Html;
use arter\amos\discussioni\AmosDiscussioni;
use arter\amos\core\views\toolbars\StatsToolbar;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\icons\AmosIcons;
use arter\amos\attachments\components\AttachmentsList;
use arter\amos\core\forms\InteractionMenuWidget;
use \arter\amos\discussioni\models\DiscussioniTopic;

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniTopic $model
 * @var yii\widgets\ActiveForm $form
 */

$this->title = $model->titolo;

?>

<div class="discussioni-topic-view col-xs-12 nop">
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <div class="header col-xs-12 nop">
            <?php
            $url = '/img/img_default.jpg';
            if (!is_null($model->discussionsTopicImage)) {
                $url = $model->discussionsTopicImage->getWebUrl('original', false, true);
                ?>
                <?= Html::img($url, [
                    'class' => 'img-responsive',
                    'alt' => AmosDiscussioni::t('amosdiscussioni', 'Immagine della discussione')
                ]); ?>
                <?php
            }
            ?>
            <div class="title col-xs-12">
                <h2 class="title-text"><?= $model->titolo ?></h2>
            </div>
        </div>
        <div class="text-content col-xs-12 nop">
            <?= $model->testo ?>
        </div>
        <div class="col-xs-12 text-center">
            <hr>
            <?= Html::a(
                AmosDiscussioni::t('amosdiscussioni', 'Contribuisci'),
                ['partecipa', 'id' => $model->id, '#' => 'comments_contribute'],
                [
                    'class' => 'btn btn-navigation-primary',
                    'title' => AmosDiscussioni::t('amosdiscussioni', 'commenta')
                ]
            ) ?>
        </div>

    </div>

</div>
