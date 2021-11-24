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
 * @package    arter\amos\core\giiamos\model\default
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

echo "<?php\n";
?>
use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;


/**
* Class <?= $generator->migrationName; ?>
*/
class <?= $generator->migrationName; ?> extends AmosMigrationPermissions
{

    /**
    * @inheritdoc
    */
    protected function setRBACConfigurations()
    {
        $prefixStr = '';

        return [
                [
                    'name' =>  '<?= strtoupper($className); ?>_CREATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di CREATE sul model <?= $className; ?>',
                    'ruleName' => null,
                    'parent' => ['ADMIN']
                ],
                [
                    'name' =>  '<?= strtoupper($className); ?>_READ',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di READ sul model <?= $className; ?>',
                    'ruleName' => null,
                    'parent' => ['ADMIN']
                    ],
                [
                    'name' =>  '<?= strtoupper($className); ?>_UPDATE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di UPDATE sul model <?= $className; ?>',
                    'ruleName' => null,
                    'parent' => ['ADMIN']
                ],
                [
                    'name' =>  '<?= strtoupper($className); ?>_DELETE',
                    'type' => Permission::TYPE_PERMISSION,
                    'description' => 'Permesso di DELETE sul model <?= $className; ?>',
                    'ruleName' => null,
                    'parent' => ['ADMIN']
                ],

            ];
    }
}
