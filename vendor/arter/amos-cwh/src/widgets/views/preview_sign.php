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

/** @var $profile \arter\amos\admin\models\UserProfile */
$js = <<<JS
$('#validatori-cwh').on('select2:select', function() {
    $.ajax({
        url: '/cwh/cwh-ajax/get-network',
        type: 'get',
        data: {cwhNodiId: $(this).val()},
        success: function (data) {
            if($('#sign-inserted').length > 0) {
                $('#sign-inserted strong').text(data);
            } else {
                var p = $("<p id='sign-inserted'></p>")
                    .addClass('card-creator-targets');
                $(p).append("<strong>"+data+"</strong>");

                var last_child = $("#preview-sign .post-header > p").last();
                $(last_child).append(p);
            }
        }
    });
});

JS;
$this->registerJs($js);

if ($model->isNewRecord) {
    $model->created_by = \Yii::$app->user->id;
//  $profile = \arter\amos\admin\models\UserProfile::findOne(['user_id' => $model->created_by]);

    $contentCreatorTargets = \arter\amos\core\forms\ItemAndCardHeaderWidget::getValidatorNameGeneral([\arter\amos\cwh\utility\CwhUtil::getCwhNodeFromScope()]);

    $model->validatori = [\arter\amos\cwh\utility\CwhUtil::getCwhNodeFromScope()];
}
?>

<div id="preview-sign">
    <div id="profile-image-preview" class="signature-preview col-xs-12">
        <p><?= \arter\amos\cwh\AmosCwh::t('amoscwh', 'Example sign') ?></p>
        <?php
        echo \arter\amos\core\forms\ItemAndCardHeaderWidget::widget([
                'model' => $model,
                'publicationDateNotPresent' => true,
                'showPrevalentPartnershipAndTargets' => true,
            ]
        );
        ?>
    </div>
</div>
