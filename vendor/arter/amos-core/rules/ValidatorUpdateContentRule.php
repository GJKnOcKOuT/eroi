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
 * @package    arter\amos\core\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\rules;

use arter\amos\core\record\Record;
use Yii;

/**
 * Class ValidatorUpdateContentRule
 * @package arter\amos\core\rules
 */
class ValidatorUpdateContentRule extends DefaultOwnContentRule
{
    /**
     * @inheritdoc
     */
    public $name = 'validatorUpdateContent';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var Record $model */
            $model = $params['model'];
            $modelClassName = $model->className();
            $cwhModule = Yii::$app->getModule('cwh');

            if (!$model->id) {
//                $post = \Yii::$app->getRequest()->post();
//                $get = \Yii::$app->getRequest()->get();
//                if (isset($get['id'])) {
//                    $model = $this->instanceModel($model, $get['id']);
//                } elseif (isset($post['id'])) {
//                    $model = $this->instanceModel($model, $post['id']);
//                }

                $data = \yii\helpers\ArrayHelper::merge(
                    \Yii::$app->getRequest()->post(),
                    \Yii::$app->getRequest()->get()
                );

                if (isset($data['id'])) {
                    $model = $this->instanceModel($model, $data['id']);
                }
            }

            if (!isset($cwhModule) || !in_array($modelClassName, $cwhModule->modelsEnabled)) {
                return false;
            }

            return $this->validatorContentUpdatePermission($model);
        }

        return false;
    }

    /**
     * @param Record $model
     * @return bool
     */
    private function validatorContentUpdatePermission($model)
    {
        // at the creation of a model, VALIDATORS, ADMIN and Community managers can publish directly a news
        // if you create a content using hidecwhtab, the model is creaed without a validator, so you cannot do the normal check for validation permission
        $cwhModule = \Yii::$app->getModule('cwh');
        $cwhEnabled = (isset($cwhModule) && in_array(get_class($model), $cwhModule->modelsEnabled) && $cwhModule->behaviors);

        /* Commentato condizione isNewRecord poichè sono controlli da fare sempre
         * Commentato anche validatori poichè non dovrebbe essere vuoto (c'è sempre lo user->id)
         * E' necessario testare solo $cwhEnabled
         * Vedi PR-224 (Possibilità di decidere il livello di moderazione di una community o sotto-community (MODIFICA EVOLITIVA DI OPEN2.0)
         */

        //IF YOU ARE IN THE CREATION PAGE
        if($cwhEnabled || $model->isNewRecord) {
            $scope = $cwhModule->getCwhScope();
            if (isset($cwhModule) && !empty($scope)) {
                $scope = $cwhModule->getCwhScope();

                $communityModule = \Yii::$app->getModule('community');
                if (isset($scope['community']) && $communityModule) {

                    $community = \arter\amos\community\models\Community::findOne($scope['community']);

                    if (isset($communityModule->forceWorkflowSingleCommunity) && $communityModule->forceWorkflowSingleCommunity) {
                        if (\arter\amos\community\utilities\CommunityUtil::hasRole($community) || !$community->force_workflow) {
                            return true;
                        }
                    } else {
                        if (\arter\amos\community\utilities\CommunityUtil::hasRole($community)) {
                            return true;
                        }
                    }
                }
            }

            // ---- This check for VALIDATOR or FACILITATOR or EXTERNAL_FACILITATOR is needed to publish a content directly (in the creation page)
            $validatorRole = $model->getValidatorRole();
            if(\Yii::$app->user->can('VALIDATOR') || \Yii::$app->user->can($validatorRole) ){
                return true;
            }

            $moduleAdmin = \Yii::$app->getModule('admin');
            $isFacilitatorExternal = false;
            if($moduleAdmin && !empty($moduleAdmin->enableExternalFacilitator) && $moduleAdmin->enableExternalFacilitator){
                $isFacilitatorExternal = \Yii::$app->user->can($model->getExternalFacilitatorRole());
            }
            if(empty($scope) &&  (\Yii::$app->user->can($model->getFacilitatorRole())|| $isFacilitatorExternal) ){
               return true;
            }


        }

        /* Commentato controllo poichè non è più necessario avendo modificato la if precedente
         * Vedi PR-224 (Possibilità di decidere il livello di moderazione di una community o sotto-community (MODIFICA EVOLITIVA DI OPEN2.0)
         *
         * TBD Da testare perché per come era stato modificato non funzionava più il passaggio da VALIDARE a VALIDATO
         * Ad ogni modo se falliscono i test precedenti questa è l'ultima ancora di salvezza!
         */
        $cwhActiveQuery = new \arter\amos\cwh\query\CwhActiveQuery(
            $model->className(), [
            'queryBase' => $model::find()->distinct()
        ]);
        $queryToValidateIds = $cwhActiveQuery->getQueryCwhToValidate(false)->select($model::tableName().'.id')->column();

        return (in_array($model->id, $queryToValidateIds));

    }
}
