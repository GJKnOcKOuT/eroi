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

use Yii;
use yii\helpers\ArrayHelper;

/**
* This is the model class for table "user_profile_reactivation_request".
*/
class UserProfileReactivationRequest extends \arter\amos\admin\models\base\UserProfileReactivationRequest
{
    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
                    ];
    }

    public function attributeHints(){
        return [
                    ];
    }

    /**
    * Returns the text hint for the specified attribute.
    * @param string $attribute the attribute name
    * @return string the attribute hint
    * @see attributeHints
    */
    public function getAttributeHint($attribute) {
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

    
    public static function getEditFields() {
        $labels = self::attributeLabels();

        return [
                                        [
                            'slug' => 'user_profile_id',
                            'label' => $labels['user_profile_id'],
                            'type' => 'integer'
                            ],
                                                    [
                            'slug' => 'message',
                            'label' => $labels['message'],
                            'type' => 'text'
                            ],
                                ];
    }

}
