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
 * @package    arter\amos\events\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;

/**
 * Class m180207_083951_fix_events_permissions
 */
class m180207_083951_fix_events_permissions extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \arter\amos\events\widgets\icons\WidgetIconEventOwnInterest::className(),
                'update' => true,
                'newValues' => [
                    'addParents' => ['EVENTS_READER'],
                    'removeParents' => ['BASIC_USER']
                ]
            ]
        ];
    }
}
