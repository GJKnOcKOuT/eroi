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
 * @package    arter\amos\admin\views\user-profile
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

$js = <<<JS
window.close();
JS;

$this->title = \arter\amos\admin\AmosAdmin::t('amosadmin', 'Enable Google Service');

//$this->registerJs($js, \yii\web\View::POS_LOAD);

?>

<div class="col-xs-12 nop p-t-30 p-b-30">
    <?= isset($message) ? $message : '' ?>
</div>


