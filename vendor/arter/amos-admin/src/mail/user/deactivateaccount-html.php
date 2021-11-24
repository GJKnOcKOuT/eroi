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
 * @package    arter\amos\admin\mail\user
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \arter\amos\core\user\User $user
 * @var \arter\amos\admin\models\UserProfile $profile
 */

$appName = Yii::$app->name;
$appLink = Yii::$app->urlManager->createAbsoluteUrl(['/']);
$this->registerCssFile('http://fonts.googleapis.com/css?family=Roboto');
?>

<table style="line-height: 18px;" width=" 600" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
        <td>
            <div class="corpo"
                 style="padding:10px;margin-bottom:10px;background-color:#ffffff;">

                <div class="sezione" style="overflow:hidden;color:#000000;">
                    <div class="testo">
                        <p style="margin-bottom: 20px;">
                            <span style="">
                                <?= AmosAdmin::tHtml('amosadmin', '#welcome_deactivate_dear', [
                                    'name' => Html::encode($profile->nome),
                                    'surname' => Html::encode($profile->cognome)
                                ]); ?>
                                </span>
                            <br />
                        </p>
                        <p style="margin-bottom: 20px;">
                            <?php 
                            $link = $appLink . 'admin/security/reactivate-profile';
                            ?>
                            <?= AmosAdmin::tHtml('amosadmin', "#reactivation_text") ?>
                            <?= Html::beginTag('a', ['href' => $link]) ?>
                            <?= AmosAdmin::tHtml('amosadmin', $link) ?>
                            <?= Html::endTag('a'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>
