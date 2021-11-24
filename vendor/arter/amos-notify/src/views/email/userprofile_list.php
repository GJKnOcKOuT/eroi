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
use arter\amos\cwh\base\ModelContentInterface;
use arter\amos\core\forms\ItemAndCardHeaderWidget;

/**
 * @var Record|ContentModelInterface|ViewModelInterface $model
 * @var \arter\amos\admin\models\UserProfile $profile
 * @var Record[] $arrayModels
 */
if (!empty($profile)) {
    $this->params['profile'] = $profile;
}

?>


<tr>
    <td colspan="2" style="padding-bottom:10px;">
        <table cellspacing="0" cellpadding="0" border="0" align="center"   class="email-container" width="100%">

<?php foreach ($arrayModels as $model){ ?>
    <tr>
        <td bgcolor="#FFFFFF" style="padding:10px 15px 10px 15px;">
            <table width="100%">
                <tr>
                    <td colspan="2" style="font-size:18px; font-weight:bold; padding: 5px 0 ; font-family: sans-serif;">
                        <?= Html::a($model->getNomeCognome(), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #000; text-decoration:none;']) ?>
                    </td>
                    <td colspan="2" style="font-size:18px; font-weight:bold; padding: 5px 0 ; font-family: sans-serif;">
                        <?= Html::a(Yii::t('amosnotify', "collegati"), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #000; text-decoration:none;']) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:13px; color:#7d7d7d; padding:10px 0; font-family: sans-serif;"><?= $model->getNomeCognome(); ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:13px; color:#7d7d7d; padding:10px 0; font-family: sans-serif;">Per test: profile_id <?= $model->id; ?> user_id <?= $model->user_id; ?></td>
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
