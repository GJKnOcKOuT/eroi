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
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;
<?php
$el_count = count($data_obj->rolesSelected);
$str_role = '[';
if (!empty($data_obj->rolesSelected)){

    foreach ($data_obj->rolesSelected as $key => $role){
        $str_role .= "'".$role."'";
        if($key+1 < $el_count ){
            $str_role .= ',';
        }
    }
}
$str_role .= ']';
//pr($str_role, "STR ROLE");
?>


/**
* Class <?= $data_obj->migration_auth_filename; ?>
*/
class <?= $data_obj->migration_auth_filename; ?> extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = 'Permissions for the dashboard for the widget ';

        return [
                [
                    'name' =>  \<?= $data_obj->ns_4class. '\\' .$data_obj->widgetName; ?>::className(),
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => $prefixStr . '<?= $data_obj->widgetName; ?>',
                    'ruleName' => null,
                    'parent' => <?= $str_role; ?>

                ]

            ];
    }
}
