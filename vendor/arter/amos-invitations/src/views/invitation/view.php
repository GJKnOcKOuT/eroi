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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var arter\amos\invitations\models\Invitation $model
*/

$this->title =  Yii::t('amosinvitations', 'Invitation addressed to {nameSurname}', ['nameSurname' => $model->getNameSurname()]);
?>
<div class="invitation-view col-xs-12">

    <?php
    try {
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'surname',
                'message:html',
                'send_time:datetime',
                'send:boolean',
                'invitationUser.email',
                'invitationUser.numberNotificationSended',
                'invitationUser.numberNotificationSendedByMe',
                'created_at:datetime',
            ],
        ]);
    } catch (Exception $e) {
        // pr($e->getMessage());
    } ?>

    <div class="btnViewContainer pull-right">
        <?= Html::a(Yii::t('amosinvitations', 'Chiudi'), Url::previous(), ['class' => 'btn btn-secondary']); ?>
    </div>

</div>
