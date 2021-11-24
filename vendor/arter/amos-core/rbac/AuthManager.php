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
 * @package    arter\amos\core\rbac
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\rbac;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\log\Logger;
use yii\rbac\Item;

/**
 * Class AuthManager
 * @package arter\amos\core\rbac
 */
class AuthManager extends \yii\rbac\DbManager
{
    /**
     * @param string $roleName
     * @return array|string[]
     */
    public function getUserIdsByRole($roleName)
    {
        $ids = parent::getUserIdsByRole($roleName);
        foreach ($this->getParents($roleName) as $parent) {
            if ($parent['type'] == Item::TYPE_ROLE) {
                $ids = ArrayHelper::merge($ids, $this->getUserIdsByRole($parent['name']));
            }
        }
        return array_unique($ids);
    }

    /**
     * @param string $roleName
     * @return array
     */
    public function getParents($roleName)
    {
        $parents = [];

        try {
            $query = new Query;
            $parents = $query->select('b.*')
                ->from(['a' => $this->itemChildTable, 'b' => $this->itemTable])
                ->where('{{a}}.[[parent]]={{b}}.[[name]]')
                ->andwhere(['child' => $roleName])
                ->all($this->db);
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $parents;
    }

    /**
     * @param string $roleName
     * @return array|string[]
     */
    public function getUserIdsByRoleDirectlyAssigned($roleName)
    {
        if (empty($roleName)) {
            return [];
        }

        return (new Query)->select('[[user_id]]')
            ->from($this->assignmentTable)
            ->where(['item_name' => $roleName])->column($this->db);
    }
}
