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


use yii\helpers\Html;
use yii\helpers\Url;

$this->title = \arter\amos\seo\AmosSeo::t('amosseo', 'Genera Pretty Url mancanti');
?>
<div class="default-index">
    <div class="row">
        <?php
        foreach ($modules as $module) {
            $moduleName = $module::getModuleName();
            ?>
            <div class="generator col-lg-4">
                <h3><?= strtoupper($moduleName) ?></h3>
                <p><?= Html::a('Genera', Url::toRoute(['/seo/tools/generate-missing-pretty-urls', 'moduleName' => $moduleName]), ['class' => 'btn btn-default']) ?></p>
            </div>
        <?php } ?>

    </div>
</div>




