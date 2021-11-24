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
 * @package    arter\amos\notificationmanager\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\interfaces\ContentModelInterface;
use arter\amos\core\interfaces\ViewModelInterface;
use arter\amos\core\record\Record;
use arter\amos\notificationmanager\AmosNotify;

/**
 * @var Record|ContentModelInterface|ViewModelInterface $model
 * @var \arter\amos\admin\models\UserProfile $profile
 * @var Record[] $arrayModels
 */
if (!empty($profile)) {
    $this->params['profile'] = $profile;
}

$colors = \arter\amos\notificationmanager\utility\NotifyUtility::getColorNetwork($color);
$notifyModule = AmosNotify::instance();

?>

 
<?php
foreach ($arrayModels as $model) {
    $textButton      = Yii::t('amosapp', 'Leggi');
    $commentsVisible = false;
    $commentsCount   = false;
    $textNewComments = '';

    if (method_exists($model, 'getNotifyTextButton')) {
        $textButton = $model->getNotifyTextButton();
    }
    if (!empty($arrayModelsComments)) {
        $count           = count($arrayModelsComments);
        $textNewComments = "<h2>$count ".($count == 1 ? Yii::t('amosapp', 'Commento nuovo') : Yii::t('amosapp',
                'Commenti nuovi'))."</h2>";
        $commentsCount   = true;
        if (!empty($arrayModelsComments[$model->id])) {
            $commentsVisible = true;
        }
    }
    ?>
    <!-- Hero Image, Flush : BEGIN -->
    <tr>
        <td>
            <?php
                $url = '/img/img_default.jpg';
                $image=$model->getModelImage();
                if (!is_null($image)) {
                    $url = $image->getUrl('square_large', false, true);
                }
                $url =  Yii::$app->urlManager->createAbsoluteUrl($url);
            ?>
            <img src="<?= $url ?>" border="0" width="570" align="center" style="max-width: 570px; width:100%;">
        </td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:18px; font-weight:bold; padding: 5px 0 ; font-family: sans-serif;">
            <?=
            Html::a($model->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()),
                ['style' => 'color: #000; text-decoration:none;'])
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="font-size:13px; color:#7d7d7d; padding:10px 0; font-family: sans-serif;"> <?= $model->getDescription(true); ?></td>
    </tr>
    <tr>
        <td colspan="2" style="padding:15px 0 0 0;">
            <table width="100%">
                <tr>
                    <td width="400">
                        <table width="100%">
                            <tr>
                                <?=
                                \arter\amos\notificationmanager\widgets\ItemAndCardWidgetEmailSummaryWidget::widget([
                                    'model' => $model,
                                ]);
                                ?>

                            </tr>
                        </table>
                        <table width="100%">
                            <tr>
                            <div style="box-sizing:border-box; /*padding: 10px 0; margin-top:10px;*/ float: left; width:100%;">
                                <?php
                                if ($commentsCount === true) {
                                    echo $textNewComments;
                                    if ($commentsVisible === true) {
                                        foreach ($arrayModelsComments[$model->id] as $comment) {
                                            echo $this->render('content_comment', ['comment' => $comment]);
                                        }
                                    }
                                }
                                ?>
                            </div>

                </tr>
            </table>
        </td>
        <td align="right" width="85" valign="bottom" style="text-align: center; padding-left: 10px;">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()) ?>"
            
            style="background: <?= $notifyModule->mailThemeColor['bgPrimary'] ?>; border:3px solid <?= $notifyModule->mailThemeColor['bgPrimary'] ?>; color: <?= $notifyModule->mailThemeColor['textContrastBgPrimary'] ?>; font-family: sans-serif; font-size: 11px; line-height: 22px; text-align: center; text-decoration: none; display: block; font-weight: bold; text-transform: uppercase; height: 20px;" class="button-a">
                <?php  if($commentsCount == false){  ?>
                <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--><?= $textButton ?><!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->
                <?php  }  ?>
            </a>
        </td>
    </tr>

    </table>
    </td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom:1px solid #D8D8D8; padding:5px 0px"></td>
    </tr>


<?php } ?>


