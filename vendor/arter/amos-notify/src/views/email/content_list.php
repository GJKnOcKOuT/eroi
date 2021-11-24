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
use arter\amos\core\interfaces\ModelImageInterface;
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
/** @var AmosNotify $notifyModule */
$notifyModule = AmosNotify::instance();
?>

<tr>
    <td colspan="2" style="padding-bottom:10px;">
        <table cellspacing="0" cellpadding="0" border="0" align="center"   class="email-container" width="100%">

<?php foreach ($arrayModels as $model) { ?>
    <?php
    $modelTitle = $model->getTitle();
    $modelAbsoluteFullViewUrl = Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl());
    ?>
    <tr>
        <td bgcolor="#FFFFFF" style="padding:10px 15px 10px 15px;">
            <table width="100%">
                <?php if ($model instanceof ModelImageInterface): ?>
                    <!-- Hero Image, Flush : BEGIN -->
                    <tr>
                        <td>
                            <?php
                            $url = $model->getModelImageUrl('square_large', true, '/img/img_default.jpg', false, true);
                            if ($model instanceof ContentModelInterface) {
                                $imageAlt = $model->getTitle();
                            } else {
                                $imageAlt = AmosNotify::t('amosnotify', '#content_image');
                            }
                            ?>
                            <img src="<?= Yii::$app->urlManager->createAbsoluteUrl($url); ?>" width="570" align="center" style="max-width: 570px; width:100%; border: 0;" alt="<?= $imageAlt; ?>">
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="2" style="font-size:18px; font-weight:bold; padding: 5px 0 ; font-family: sans-serif;">
                        <?= Html::a($modelTitle, $modelAbsoluteFullViewUrl, [
                            'style' => 'color: #000; text-decoration:none;',
                            'title' => $modelTitle
                        ]) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:13px; color:#7d7d7d; padding:10px 0; font-family: sans-serif;"><?= $model->getDescription(true); ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:15px 0 0 0;">
                        <table width="100%">
                            <tr>
                                <td width="400">
                                    <table width="100%">
                                        <tr>
                                            <?= \arter\amos\notificationmanager\widgets\ItemAndCardWidgetEmailSummaryWidget::widget([
                                                'model' => $model,
                                            ]); ?>
                                        </tr>
                                    </table>
                                </td>
	                            <td align="right" width="85" valign="bottom" style="text-align: center; padding-left: 10px;"><a href="<?= $modelAbsoluteFullViewUrl ?>"
                                 style="background: <?= $notifyModule->mailThemeColor['bgPrimary'] ?>; border:3px solid <?= $notifyModule->mailThemeColor['bgPrimary'] ?>; color: <?= $notifyModule->mailThemeColor['textContrastBgPrimary'] ?>; font-family: sans-serif; font-size: 11px; line-height: 22px; text-align: center; text-decoration: none; display: block; font-weight: bold; text-transform: uppercase; height: 20px;" class="button-a">
			                            <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]--><?= AmosNotify::t('amosnotify', '#content_image'); ?><!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom:1px solid #D8D8D8; padding:5px 0px"></td>
                </tr>
            </table>
        </td>
    </tr>
<?php } ?>
        </table>
    </td>
</tr>
