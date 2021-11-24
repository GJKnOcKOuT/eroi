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
 * @package    arter\amos\mobile\bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\mobile\bridge\modules\v1\actions\entitydata;

use arter\amos\admin\models\UserProfile;
use arter\amos\community\models\Community;
use arter\amos\core\record\Record;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use arter\amos\mobile\bridge\modules\v1\models\User;
use yii\base\Exception;
use yii\helpers\Json;
use yii\rest\Action;

class ActionEditItem extends Action
{
    public function run()
    {
        //Request params
        $bodyParams = \Yii::$app->getRequest()->getBodyParams();

        //Refference namespace
        $namespace = $bodyParams['namespace'];

        /**
         * Class for this fetch, expected Record
         * @var $class Record
         */
        $class = new $namespace();

        //List of edit fields
        $editFields = $class::getEditFields();

        //Record interested
        if(!empty($bodyParams['id'])) {
            $record = $class::findOne(['id' => $bodyParams['id']]);
        } else {
            $record = new $class();
        }

        if(isset($bodyParams['data'])) {
            $dataToLoad = [$record->formName() => $bodyParams['data']];

            if($record->load($dataToLoad) && $record->validate() && $record->save()) {
                return $record->toArray();
            } else {
                //Get all rerrors
                $errors = $record->getErrors();

                //First Error
                $firstError = reset($errors);

                return [
                    'error' => true,
                    'message' => reset($firstError),
                    'more' => $errors
                ];
            }
        } else {
            //Set Value
            foreach ($editFields as $key=>$field) {
                $slug = $field['slug'];
                $editFields[$key]['value'] = $record->$slug;
            }

            //Return fields array
            return $editFields;
        }
    }
}