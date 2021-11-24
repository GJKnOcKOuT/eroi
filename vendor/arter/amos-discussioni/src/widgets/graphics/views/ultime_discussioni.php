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

<div class="grid-item grid-item--height2">
    <div class="box-widget latest-discussions">
        <div class="box-widget-toolbar">
            <h2 class="box-widget-title col-xs-10 nop"><?= AmosDiscussioni::tHtml('amosdiscussioni', 'Ultime discussioni') ?></h2>
            <?php
            if (isset($moduleDiscussioni) && !$moduleDiscussioni->hideWidgetGraphicsActions) {
                echo WidgetGraphicsActions::widget([
                    'widget' => $widget,
                    'tClassName' => AmosDiscussioni::className(),
                    'actionRoute' => '/discussioni/discussioni-topic/create',
                    'toRefreshSectionId' => $toRefreshSectionId
                ]);
            }
            ?>
        </div>

        <section>
            <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
            <div role="listbox">
                <?php
                if (count($listaModels) == 0):
                    $textReadAll = AmosDiscussioni::t('amosdiscussioni', '#addDiscussions');
                    $linkReadAll = '/discussioni/discussioni-topic/create';
                    $checkPermNew = true;
                    ?>

                    <div class="list-items list-empty clearfixplus">
                        <h2 class="box-widget-subtitle"><?= AmosDiscussioni::tHtml('amosdiscussioni', 'Nessuna Discussione'); ?></h2>
                    </div>

                <?php
                else:
                    $textReadAll = AmosDiscussioni::t('amosdiscussioni', 'Visualizza Elenco Discussioni');
                    $linkReadAll = ['/discussioni'];
                    $checkPermNew = false;
                    ?>
                    <div class="list-items clearfixplus">
                        <?php
                        $alt = AmosDiscussioni::t('amosdiscussioni', 'Immagine della discussione');
                        /** @var DiscussioniTopic $topic */
                        foreach ($listaModels as $topic):
                            ?>
                            <div class="col-xs-12 widget-listbox-option" role="option">
                                <article class="col-xs-12 nop">
                                    <div class="container-img">
                                        <?php
                                        $url = '/img/img_default.jpg';
                                        $topicImage = $topic->getDiscussionsTopicImage();
                                        if (!is_null($topicImage)) {
                                            $url = $topicImage->getUrl('dashboard_small_old', false, true);
                                        }

                                        echo Html::img(
                                            $url,
                                            [
                                                'class' => 'img-responsive',
                                                'alt' => $alt
                                            ]
                                        );
                                        ?>
                                    </div>
                                    <div class="container-text">
                                        <div class="col-xs-12 nop listbox-date">
                                            <p><?= Yii::$app->getFormatter()->asDate($topic->created_at); ?></p>
                                            <h2 class="box-widget-subtitle">
                                                <?php
                                                $decode_titolo = strip_tags($topic->titolo);
                                                if (strlen($decode_titolo) > 50) {
                                                    $stringCut = substr($decode_titolo, 0, 50);
                                                    echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                                } else {
                                                    echo $decode_titolo;
                                                }
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </article>
                                <div class="col-xs-12 footer-listbox nop">
                                    <p class="pull-left"><?= AmosIcons::show("comment", ['class' => 'am-1']); ?>
                                        <?= DiscussionsUtility::getViewContributeString($topic); ?>
                                    </p>
                                    <span class="pull-right">
                                        <?= Html::a(\Yii::$app->user->can('COMMENT_CREATE')
                                            ? AmosDiscussioni::t('amosdiscussioni', 'CONTRIBUISCI')
                                            : AmosDiscussioni::t(
                                                'amosdiscussioni',
                                                'LEGGI'
                                            ),
                                            [
                                                '../discussioni/discussioni-topic/partecipa',
                                                'id' => $topic->id
                                            ],
                                            [
                                                'class' => 'btn btn-navigation-primary'
                                            ]
                                        );
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php Pjax::end(); ?>
        </section>
        <div class="read-all"> <?= Html::a($textReadAll, $linkReadAll, ['class' => ''], $checkPermNew); ?></div>
    </div>
</div>
