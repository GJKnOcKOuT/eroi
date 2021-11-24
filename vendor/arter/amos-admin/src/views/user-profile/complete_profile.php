<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;

$this->title = AmosAdmin::t('amosadmin',"Completa il tuo profilo utente");
$assetBundle = \arter\amos\admin\assets\ModuleUserProfileAsset::register($this);

$url = \yii\helpers\Url::to(['/admin/user-profile/update', 'id' => $model->id]);
?>
<div class="col-xs-12 m-t-15">
    <h4><?= AmosAdmin::t('amosadmin',"Porta a termine la tua registrazione utente e richiedi la validazione del profilo, <br> così potrai partecipare attivamente alla creazione di contenuti in piattaforma, accedendo a <a href='{link}'>'Il mio profilo'</a>.",[
            'link' => $url
        ]) ?>
    </h4>
</div>
<div class="col-xs-12 m-t-15">
    <?= \yii\helpers\Html::img($assetBundle->baseUrl.'/img/example_complete_profile.jpg')?>
</div>
<div class="col-xs-12 m-t-15">
    <?= \yii\helpers\Html::a(AmosAdmin::t('amosadmin', 'Chiudi'), '/dashboard', [
        'class' => 'btn btn-navigation-secondary pull-left',
        'title' => AmosAdmin::t('amosadmin', 'Chiudi')
    ]);
    ?>
    <?= \yii\helpers\Html::a(AmosAdmin::t('amosadmin', 'Completa il profilo'), $url, [
        'class' => 'btn btn-navigation-primary pull-right',
        'title' => AmosAdmin::t('amosadmin', 'Completa il profilo')
    ]);
    ?>
</div>
