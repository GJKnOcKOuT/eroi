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

use arter\amos\dashboard\AmosDashboard;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
?>

<div class="card-widget">
    <div class="chechbox-widget pull-right">
        <label for="<?=\yii\helpers\StringHelper::basename($model['classname']);?>" class="sr-only"><?= Yii::createObject($model['classname'])->getDescription(); ?></label>
        <input id="<?=\yii\helpers\StringHelper::basename($model['classname']);?>" type="checkbox" name="amosWidgetsClassnames[]" value="<?=$model['classname'];?>" <?= (in_array($model['classname'], $this->params['widgetSelected'])? 'checked' : '') ?> />
    </div>
    <div class="dashboard-item">
        <?php
            $object = \Yii::createObject($model['classname']);
            $object->setUrl('');
        ?>
        <?= $object->run(); ?>
    </div>
    <p><?= Yii::createObject($model['classname'])->getDescription(); ?></p>
</div>
