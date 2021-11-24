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

use arter\amos\core\forms\ItemAndCardHeaderWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\interfaces\ContentModelInterface;
use arter\amos\core\interfaces\ViewModelInterface;
use arter\amos\core\record\Record;

/**
 * @var Record|ContentModelInterface|ViewModelInterface $model
 * @var \arter\amos\admin\models\UserProfile $profile
 */

if (!empty($profile)) {
    $this->params['profile'] = $profile;
}

$nTagUser = \arter\amos\cwh\models\CwhTagOwnerInterestMm::find()
    ->andWhere(['record_id' => $profile->id])
    ->andWhere(['classname' => \arter\amos\admin\models\UserProfile::className()])->count();
if($nTagUser == 0){
    $text =  \arter\amos\een\AmosEen::t('amoseen', 'Ricevi una selezione di proposte di collaborazione da tutto il mondo sulla base degli interessi indicati nel tuo profilo EROI (Tematiche Smart Specialization Strategy) che puoi sempre modificare. Per vedere tutte le proposte di tuo interesse clicca su  <a href="{url}">questo link</a>.',[
            //'url' =>  \Yii::$app->params['platform']['backendUrl'].'/admin/user-profile/update?id='.$profile->id,
         'url' => \Yii::$app->params['platform']['backendUrl'].'/een/een-partnership-proposal/own-interest'
    ]);
} else {
    $text = \arter\amos\een\AmosEen::t('amoseen', "Ricevi una selezione di proposte di collaborazione da tutto il mondo sulla base degli interessi indicati nel tuo profilo EROI (Tematiche Smart Specialization Strategy) che puoi sempre modificare. Per vedere tutte le proposte di tuo interesse clicca su  <a href=\"{url}\">questo link</a>.", [
        'url' => \Yii::$app->params['platform']['backendUrl'].'/een/een-partnership-proposal/own-interest'
    ]);
}

?>


<div style="box-sizing:border-box;padding-bottom: 5px; margin-left: 10px;">
    <h4><?= $text?></h4>
</div>

