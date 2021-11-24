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

$checkedByDefault = false;
if(!empty($this->params['checkedByDefault']) && $this->params['checkedByDefault'] == true ){
    $checkedByDefault = true;
}
?>
<?php $object = \Yii::createObject($model['classname']);?>
<?php if($object->isVisible()) { ?>
    <div class="card-widget">
        <div class="chechbox-widget pull-right">
            <label for="<?=\yii\helpers\StringHelper::basename($model['classname']);?>" class="sr-only"><?= \Yii::createObject($model['classname'])->getDescription(); ?></label>
            <input id="<?=\yii\helpers\StringHelper::basename($model['classname']);?>" type="checkbox" name="amosWidgetsIds[]" value="<?=$model['id'];?>" <?= (empty($this->params['widgetSelected']) && $checkedByDefault) ? 'checked' : (in_array($model['id'], $this->params['widgetSelected'])? 'checked' : '') ?> />
        </div>
        <div class="dashboard-item">
            <?php
                $object->setUrl('');
            ?>
            <?= $object->run(); ?>
        </div>
        <p><?= \Yii::createObject($model['classname'])->getDescription(); ?></p>
    </div>
<?php } ?>
