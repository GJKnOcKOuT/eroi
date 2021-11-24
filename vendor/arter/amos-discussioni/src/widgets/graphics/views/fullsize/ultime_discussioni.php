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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\WidgetGraphicsActions;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\discussioni\AmosDiscussioni;
use arter\amos\discussioni\assets\ModuleDiscussioniInterfacciaAsset;
use arter\amos\discussioni\models\DiscussioniTopic;
use arter\amos\discussioni\utility\DiscussionsUtility;
use arter\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $listaTopic
 * @var WidgetGraphicsUltimeDiscussioni $widget
 * @var string $toRefreshSectionId
 */

$moduleDiscussioni = \Yii::$app->getModule(AmosDiscussioni::getModuleName());
ModuleDiscussioniInterfacciaAsset::register($this);
$listaModels = $listaTopic->getModels();

?>

<div class="box-widget-header">
    <?php if (isset($moduleDiscussioni) && !$moduleDiscussioni->hideWidgetGraphicsActions) { ?>
        <?= WidgetGraphicsActions::widget([
            'widget' => $widget,
            'tClassName' => AmosDiscussioni::className(),
            'actionRoute' => '/discussioni/discussioni-topic/create',
            'toRefreshSectionId' => $toRefreshSectionId
        ]); ?>
    <?php } ?>

    <div class="box-widget-wrapper">
        <h2 class="box-widget-title">
            <?= AmosIcons::show('disc', ['class' => 'am-2'], AmosIcons::IC) ?>
            <?= AmosDiscussioni::tHtml('amosdiscussioni', 'discussioni') ?>
        </h2>
    </div>

    <?php
    if (count($listaModels) == 0) {
        $textReadAll = AmosDiscussioni::t('amosdiscussioni', '#addDiscussions');
        $linkReadAll = '/discussioni/discussioni-topic/create';
        $checkPermNew = true;
    } else {
        $textReadAll = AmosDiscussioni::t('amosdiscussioni', '#showAll') . AmosIcons::show('chevron-right');
        $linkReadAll = ['/discussioni'];
        $checkPermNew = false;
    }
    ?>
    <div class="read-all"><?= Html::a($textReadAll, $linkReadAll, ['class' => ''], $checkPermNew); ?></div>
</div>

<div class="box-widget latest-discussions">
    <section>
        <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
        <?php if (count($listaModels) == 0): ?>
            <div class="list-items list-empty">
                <h3><?= AmosDiscussioni::tHtml('amosdiscussioni', 'Nessuna Discussione'); ?></h3></div>
        <?php else: ?>
            <div class="list-items">
                <?php
                foreach ($listaModels as $topic):
                    /** @var DiscussioniTopic $topic */
                    ?>
                    <div class="widget-listbox-option" role="option">
                        <article class="wrap-item-box">
                            <div>
                                <div class="container-img">
                                    <?php
                                    $url = '/img/img_default.jpg';
                                    $topicImage = $topic->getDiscussionsTopicImage();
                                    if (!is_null($topicImage)) {
                                        $url = $topicImage->getUrl('dashboard_discussioni', false, true);
                                    }

                                    $imgHtml = Html::img($url, ['class' => 'img-responsive', 'alt' => AmosDiscussioni::t('amosdiscussioni', 'Immagine della discussione')]); ?>

                                    <?= Html::a($imgHtml, ['../discussioni/discussioni-topic/partecipa', 'id' => $topic->id]); ?>

                                </div>
                            </div>

                            <div class="wrap-content">
                                <div class="container-text">
                                    <div class="box-widget-info-top">
                                        <p><?= Yii::$app->getFormatter()->asDate($topic->created_at); ?></p>
                                        <p><?= AmosDiscussioni::t('amosdiscussioni', '#by') ?> <?= $topic->creatoreDiscussione ?></p>
                                    </div>
                                    <h2 class="box-widget-subtitle">
                                        <?php
                                        $decode_titolo = strip_tags($topic->titolo);
                                        if (strlen($decode_titolo) > 150) {
                                            $stringCut = substr($decode_titolo, 0, 150);
                                            $decode_titolo = substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                        }
                                        ?>

                                        <?= Html::a($decode_titolo, ['../discussioni/discussioni-topic/partecipa', 'id' => $topic->id]); ?>

                                    </h2>
                                    <div class="box-widget-text">
                                        <?php
                                         $stringNoTags = strip_tags($topic->testo);  
//                                        $stringNoTags = $topic->testo;
//                                        //remove table from editor
//                                        //$stringNoTags = preg_replace('/<table(.*?)>(.*?)<\/table>/s', '', $stringNoTags);
//                                        $stringNoTags = preg_replace('/<table(.*$)/s', '', $stringNoTags);
//                                        // remove iframe from editor
//                                        //$stringNoTags = preg_replace('/<iframe(.*?)>(.*?)<\/iframe>/s', '', $stringNoTags);
//                                        $stringNoTags = preg_replace('/<iframe(.*$)/s', '', $stringNoTags);
//                                        // remove images from editor
//                                        //$stringNoTags = preg_replace('/<img(.*?)\/>/s', '', $stringNoTags);
//                                        $stringNoTags = preg_replace('/<p><img(.*$)/s', '', $stringNoTags);
//                                        // remove empty paragraph
//                                        $stringNoTags = preg_replace('/<p><\/p>/s', '', $stringNoTags);
//                                        // remove &nbsp; space
//                                        $stringNoTags = str_replace('&nbsp;', '', $stringNoTags);
                                        if (strlen($stringNoTags) > 300) {
                                            $stringCut = substr($stringNoTags, 0, 300);
                                            echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                        } else {
                                            echo $stringNoTags;
                                        }
                                        ?>
                                    </div>
                                    <div class="box-widget-info-bottom">
                                        <?= DiscussionsUtility::getViewContributeString($topic); ?>
                                        <?php if ((isset($moduleDiscussioni->disableComments) && $moduleDiscussioni->disableComments) && $topic->close_comment_thread): ?>
                                            <div class="closed-label col-xs-12 nop">
                                                <?= AmosDiscussioni::t('amosdiscussioni', '#discussion_closed') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="footer-listbox">
                                    <?php if ((isset($moduleDiscussioni->disableComments) && $moduleDiscussioni->disableComments) && $topic->close_comment_thread): ?>
                                        <?= '<span class="sr-only">' . Html::a(AmosDiscussioni::t('amosdiscussioni', 'LEGGI') . '</span>' . AmosIcons::show('chevron-right'), ['../discussioni/discussioni-topic/partecipa', 'id' => $topic->id], ['class' => 'btn-action']); ?>
                                    <?php else: ?>
                                        <?= Html::a(\Yii::$app->user->can('COMMENT_CREATE') ? '<span class="sr-only">' . AmosDiscussioni::t('amosdiscussioni', 'CONTRIBUISCI') . '</span>' . AmosIcons::show('chevron-right') : AmosDiscussioni::t('amosdiscussioni', 'LEGGI'), ['../discussioni/discussioni-topic/partecipa', 'id' => $topic->id], ['class' => 'btn-action']); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php Pjax::end(); ?>
    </section>
</div>
