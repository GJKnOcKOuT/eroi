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
 * @package    box_google_services.php
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\icons\AmosIcons;

/**
 * @var \arter\amos\admin\models\UserProfile $model
 * @var \arter\amos\socialauth\models\SocialAuthUsers[] $socialAuthUsers
 * @var array $enableServices
 */

$socialAuthUser = null;
if (count($socialAuthUsers) && array_key_exists('google', $socialAuthUsers)) {
    $socialAuthUser = $socialAuthUsers['google'];
}
$serviceCalendarActive = in_array('calendar', $enableServices);
$serviceContactActive = in_array('contacts', $enableServices);

if ($serviceCalendarActive || $serviceContactActive) {

    /** @var \arter\amos\socialauth\models\SocialAuthUsers $socialAuthUser */
    if ($socialAuthUser) {
        $isEnabledCalendar = $serviceCalendarActive && $socialAuthUser->getServices()->andWhere(['service' => 'calendar'])->count();
        $isEnabledContacts = $serviceContactActive && $socialAuthUser->getServices()->andWhere(['service' => 'contacts'])->count();
    } else {
        $isEnabledCalendar = false;
        $isEnabledContacts = false;
    }
    $js = <<<JS

function isEnabledCalendar(){
    isEnabledService($model->id, 'google', 'calendar');       
}
function isEnabledContacts(){
    isEnabledService($model->id, 'google', 'contacts');       
}
isEnabledCalendar();
isEnabledContacts();
      
JS;

    $this->registerJs($js);
    ?>

    <div id='google-services' class="<?= $socialAuthUser ? "google-services" : "hidden" ?>">
        <div class="col-xs-12 nop">
            <p><?= AmosAdmin::t('amosadmin', '#google_calendar_description') ?></p>
            <p class="label-social"><strong><?= AmosAdmin::t('amosadmin', '#google_calendar_label'); ?></strong></p>
            <div class="wrap-btn-social">
                <?php
                if ($serviceCalendarActive){
                ?>
                <span id="manage-calendar">
                <?= \arter\amos\core\helpers\Html::a(
                    AmosIcons::show('calendar', [], 'dash'),
                    '/admin/user-profile/enable-google-service?id=' . $model->id . '&serviceName=calendar',
                    [
                        'id' => 'enable-calendar-btn',
                        'class' => 'btn btn-google-services' . ($isEnabledCalendar ? ' hidden' : ''),
                        'title' => AmosAdmin::t('amosadmin', 'Enable') . ' ' . AmosAdmin::t('amosadmin', '#calendar'),
                        'onclick' => "window.open(this.href, 'enableCalendar', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"
                    ]) ?>
                <?= \arter\amos\core\helpers\Html::a(
                    AmosIcons::show('calendar', [], 'dash') . '&nbsp;' . AmosAdmin::t('amosadmin', 'Disconnect'),
                    '/admin/user-profile/disable-google-service?id=' . $model->id . '&serviceName=calendar',
                    [
                        'id' => 'disable-calendar-btn',
                        'class' => 'btn btn-google-services' . ($isEnabledCalendar ? ' btn-google-services-disconnect' : ' hidden'),
                        'title' => AmosAdmin::t('amosadmin', 'Disconnect') . ' ' . AmosAdmin::t('amosadmin', '#calendar'),
                    ]) ?>
            </span>
            </div>
        </div>
        <div class="col-xs-12 nop">
            <p><?= AmosAdmin::t('amosadmin', '#google_contact_description') ?></p>
            <p class="label-social"><strong><?= AmosAdmin::t('amosadmin', '#google_contact_label'); ?></strong></p>
            <div class="wrap-btn-social">
                <?php
                }
                if ($serviceContactActive) {
                    ?>
                    <span id="manage-contacts">
            <?= \arter\amos\core\helpers\Html::a(
                AmosIcons::show('account'),
                '/admin/user-profile/enable-google-service?id=' . $model->id . '&serviceName=contacts',
                [
                    'id' => 'enable-contacts-btn',
                    'class' => 'btn btn-google-services' . ($isEnabledContacts ? ' hidden' : ''),
                    'title' => AmosAdmin::t('amosadmin', 'Enable') . ' ' . AmosAdmin::t('amosadmin', '#contacts'),
                    'onclick' => "window.open(this.href, 'enableContacts', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;"
                ]) ?>
            <?= \arter\amos\core\helpers\Html::a(
                AmosIcons::show('account') . '&nbsp;' . AmosAdmin::t('amosadmin', 'Disconnect'),
                '/admin/user-profile/disable-google-service?id=' . $model->id . '&serviceName=contacts',
                [
                    'id' => 'disable-contacts-btn',
                    'class' => 'btn btn-google-services' . ($isEnabledContacts ? ' btn-google-services-disconnect' : ' hidden'),
                    'title' => AmosAdmin::t('amosadmin', 'Disconnect') . ' ' . AmosAdmin::t('amosadmin', '#contacts')
                ]) ?>
        </span>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
<?php } ?>
