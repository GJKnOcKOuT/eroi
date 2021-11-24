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


namespace arter\amos\admin\models;

use arter\amos\core\user\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "token_group".
 */
class TokenGroup extends \arter\amos\admin\models\base\TokenGroup
{
    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }

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

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
        ]);
    }

    public function attributeLabels()
    {
        return
            ArrayHelper::merge(
                parent::attributeLabels(),
                [
                ]);
    }


    public static function getEditFields()
    {
        $labels = self::attributeLabels();

        return [
            [
                'slug' => 'name',
                'label' => $labels['name'],
                'type' => 'string'
            ],
            [
                'slug' => 'Description',
                'label' => $labels['Description'],
                'type' => 'string'
            ],
            [
                'slug' => 'url_redirect',
                'label' => $labels['url_redirect'],
                'type' => 'string'
            ],
            [
                'slug' => 'target_class',
                'label' => $labels['target_class'],
                'type' => 'string'
            ],
            [
                'slug' => 'target_id',
                'label' => $labels['target_id'],
                'type' => 'integer'
            ],
            [
                'slug' => 'consumable',
                'label' => $labels['consumable'],
                'type' => 'integer'
            ],
            [
                'slug' => 'expire_date',
                'label' => $labels['expire_date'],
                'type' => 'datetime'
            ],
        ];
    }

    /**
     * @param $ids
     * @throws \yii\base\InvalidConfigException
     */
    public function generateTokenUsersByIds($ids){
        foreach ($ids as $id){
            $this->generateSingleTokenUser($id);
        }
    }


    /**
     * @param $id
     * @return TokenUsers|null
     * @throws \yii\base\InvalidConfigException
     */
    public function generateSingleTokenUser($id){
        $user = User::findOne($id);
        if($user){
            $tokenuser = TokenUsers::find()->andWhere(['token_group_id' => $this->id, 'user_id' => $id])->one();
            if(empty($tokenuser)) {
                $tokenuser = new TokenUsers();
                $tokenuser->token_group_id = $this->id;
                $tokenuser->user_id = $user->id;
                $tokenuser->generateToken($user->id, $this->id);
                if($tokenuser->save()){
                    return $tokenuser;
                }
            }
        }
        return null;
    }


    /**
     * @param $classname
     * @param null $id
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    public static function getTokenGroup($string_code){
        $token = TokenGroup::find()
            ->andWhere(['string_code' => $string_code])->one();
        return $token;
    }


}
