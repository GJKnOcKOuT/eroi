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
 * @package    arter\amos\core\giiamos\widgets\default
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

echo "<?php\n";
?>
use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;


/**
* Class <?= $data_obj->migration_widget_filename; ?>
*/
class <?= $data_obj->migration_widget_filename; ?> extends AmosMigrationWidgets
{
    const MODULE_NAME = '<?= $data_obj->moduleName; ?>';

    /**
    * @inheritdoc
    */
    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \<?= $data_obj->ns_4class. '\\' .$data_obj->widgetName; ?>::className(),
                'type' => <?php if(strtolower($data_obj->widgetType) == 'icon'): ?>AmosWidgets::TYPE_ICON<?php else: ?>AmosWidgets::TYPE_GRAPHIC <?php endif;?>,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'dashboard_visible' => <?= $data_obj->widgetVisible; ?>,
                <?php if(!empty($data_obj->widgetFather)): ?>'child_of' => \<?= $data_obj->widgetFather ?>::className(),<?php endif; ?>

            ]
        ];
    }
}
