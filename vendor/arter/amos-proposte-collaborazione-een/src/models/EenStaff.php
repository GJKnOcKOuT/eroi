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


namespace arter\amos\een\models;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;

/**
 * Class EenStaff
 * This is the model class for table "een_staff".
 *
 * @property \arter\amos\admin\models\UserProfile $profileStaffDefault
 *
 * @package arter\amos\een\models
 */
class EenStaff extends \arter\amos\een\models\base\EenStaff
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'user_id',
            'een_network_node_id'
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     * @see attributeHints
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    /**
     * @return UserProfile
     * @throws \yii\base\InvalidConfigException
     */
    public static function getProfileStaffDefault()
    {
        /** @var UserProfile $userProfileModel */
        $userProfileModel = AmosAdmin::instance()->createModel('UserProfile');
        $staff_default = $userProfileModel::find()
            ->innerJoin(self::tableName(), UserProfile::tableName() . '.user_id = ' . self::tableName() . '.user_id')
            ->andWhere([self::tableName() . '.staff_default' => 1])->one();
        return $staff_default;
    }

    /**
     * This method check if the current staff is the staff default.
     * @return bool
     */
    public function isStaffDefault()
    {
        return (!empty($this->id) && ($this->staff_default == 1));
    }

    public function deleteStaffMemeber()
    {

    }
}
