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


use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;

use yii\bootstrap\Modal;

$js = <<<JS
$(document).ready(function () {
  var uid;
  var cid;
  var mid;
  var act;
  
  $('#like, #like-to').on('click', function(e) {
    e.preventDefault();
  
    uid = $('#like-uid').data('key');
    cid = $('#like-cid').data('key');
    mid = $('#like-mid').data('key');
    act = this.id;
  
    $.ajax({
      url: act,
      async: true,
      type: 'get',
      dataType: 'json',
      data: {
        uid: uid,
        cid: cid,
        mid: mid
      },
      success: function(data) {
        if  (data) {
          if (act == 'like-to') {
            $("#openmodal-preview").html(data);
            $("#openModelUsers").modal('show'); 
          }
  
          if (act == 'like') {
            $('#n-piacea').html(data.tot);
            $('#like').attr('class', data.class);
          }
        }
  
      }
    });
  });
});
JS;


$this->registerJs($js);
?>

<div class="container-like">
    <div class="like-wrap-button">
      <span id="like" class="<?= $lme ?>">
          <a class="btn"><?= AmosIcons::show('heart', [], 'dash') ?></a>
      </span>
        <span class="like-wrap-piacea">
          <a class="btn" id="like-to"><?= \Yii::t('amosapp','Piace a') . ' ' ?><span id="n-piacea" class="likeme">
                  <?= $tot ?>
              </span><?= ' ' . \Yii::t('amosapp', 'utenti') ?>
          </a>
  </span>
    </div>
    <div hidden id="like-uid" data-classname="" data-key="<?= $uid ?>"></div>
    <div hidden id="like-cid" data-classname="" data-key="<?= $cid ?>"></div>
    <div hidden id="like-mid" data-classname="" data-key="<?= $mid ?>"></div>
</div>

<?php
Modal::begin([
    'id' => 'openModelUsers',
    'header' => AmosIcons::show('heart', [], 'dash') . ' ' .Yii::t('app', 'Piace a'),
//    'size' => Modal::SIZE_LARGE
]);
echo Html::tag('div', '', ['id' => 'openmodal-preview']);
Modal::end();
?>