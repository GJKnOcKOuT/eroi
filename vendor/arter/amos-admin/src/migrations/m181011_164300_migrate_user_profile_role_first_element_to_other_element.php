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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfile;
use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\db\Migration;
use yii\db\Query;

/**
 * Class m181011_164300_migrate_user_profile_role_first_element_to_other_element
 */
class m181011_164300_migrate_user_profile_role_first_element_to_other_element extends Migration
{
    private $tableName;
    private $firstElementUserIds = [];
    private $otherElementUserIds = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = UserProfile::tableName();
    }

    private function findUserProfiles($userProfileRoleId)
    {
        $this->tableName = UserProfile::tableName();
        $query = new Query();
        $query->select(['id']);
        $query->from($this->tableName);
        $query->where(['user_profile_role_id' => $userProfileRoleId]);
        return $query->column();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->firstElementUserIds = $this->findUserProfiles(1);
        $this->otherElementUserIds = $this->findUserProfiles(7);
        try {
            $this->update($this->tableName, ['user_profile_role_id' => 7], ['id' => $this->firstElementUserIds]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage("Errore durante l'aggiornamento dei profili utente con primo elemento");
            return false;
        }
        try {
            $this->update($this->tableName, ['user_profile_role_id' => 1], ['id' => $this->otherElementUserIds]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage("Errore durante l'aggiornamento dei profili utente con altro elemento");
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->firstElementUserIds = $this->findUserProfiles(7);
        $this->otherElementUserIds = $this->findUserProfiles(1);
        try {
            $this->update($this->tableName, ['user_profile_role_id' => 1], ['id' => $this->firstElementUserIds]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage("Errore durante l'aggiornamento dei profili utente con primo elemento");
            return false;
        }
        try {
            $this->update($this->tableName, ['user_profile_role_id' => 7], ['id' => $this->otherElementUserIds]);
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage("Errore durante l'aggiornamento dei profili utente con altro elemento");
            return false;
        }
        return true;
    }
}
