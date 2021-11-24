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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\cwh\controllers;

use arter\amos\core\user\User;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\module\Module;
use arter\amos\cwh\AmosCwh;
use arter\amos\cwh\models\base\CwhNodi;
use arter\amos\cwh\models\CwhConfig;
use arter\amos\cwh\models\CwhRegolePubblicazione;
use arter\amos\cwh\query\CwhActiveQuery;
use arter\amos\cwh\utility\CwhUtil;
use Yii;
use yii\web\Controller;

class CwhAjaxController extends Controller
{
    /**
     * @return string
     */
    public function actionRecipientsCheck()
    {
        if(Yii::$app->request->isAjax) {

            $this->layout = false;
            $validators = isset($_POST['validators']) ?  $_POST['validators'] : [];
            $publicationRule = $_POST['publicationRule'];
            $tagValues = $_POST['tags'];
            $scopes = (isset($_POST['scopes']) ? $_POST['scopes'] : []);
            $className = $_POST['className'];
            $searchName = isset($_POST['searchName']) ? $_POST['searchName'] : '';
            $labelSuffix = $_POST['labelSuffix'];

            if(!empty($publicationRule)) {
                $publicationRuleLabel = CwhUtil::getPublicationRuleLabel($publicationRule);

                if ($publicationRule == CwhRegolePubblicazione::ALL_USERS_WITH_TAGS && empty($tagValues)) {
                    return AmosCwh::t('amoscwh', 'It is not possible to calculate recipients with rule')
                        . ' <strong>' . $publicationRuleLabel . '</strong> '
                        . AmosCwh::t('amoscwh', 'without specifying tags.');
                } elseif ($publicationRule == CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS && empty($scopes)) {
                    return AmosCwh::t('amoscwh', 'It is not possible to calculate recipients with rule')
                        . ' <strong>' .$publicationRuleLabel . '</strong> '
                        . AmosCwh::t('amoscwh', 'without specifying publication scopes.');
                } elseif ($publicationRule == CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS_WITH_TAGS && (empty($tagValues) ||  empty($scopes))){
                    return AmosCwh::t('amoscwh', 'It is not possible to calculate recipients with rule')
                        . ' <strong>' .$publicationRuleLabel . '</strong> '
                        . AmosCwh::t('amoscwh', 'without specifying both tags and publication scopes.');
                }

                $cwhActiveQuery = new CwhActiveQuery($className);
                $queryUsers = $cwhActiveQuery->getRecipients($publicationRule, $tagValues, $scopes);
                $query = UserProfile::find()->andWhere([
                    'in',
                    'user_id',
                    $queryUsers->select('user.id')->asArray()->column()
                ]);

                if (!empty($searchName)) {
                    $query->andWhere(['or',
                        ['like', 'cognome', $searchName],
                        ['like', 'nome', $searchName],
                        ['like', "CONCAT( nome , ' ', cognome )", $searchName],
                        ['like', "CONCAT( cognome , ' ', nome )", $searchName],
                    ]);
                }

                return $this->render("recipients-check", [
                    'validators' => CwhUtil::getDomainNames($validators),
                    'publicationRule' => $publicationRuleLabel,
                    'tagValues' => CwhUtil::getTagNames($tagValues),
                    'scopes' => CwhUtil::getDomainNames($scopes),
                    'searchName' => $searchName,
                    'query' => $query,
                    'labelSuffix' => $labelSuffix
                ]);
            }
        }
        return null;
    }
    
    
    /**
     * @return string
     */
    public function actionRecipientsCheckNew()
    {
        if(Yii::$app->request->isAjax) {

            $this->layout = false;
            $validators = isset($_POST['validators']) ?  $_POST['validators'] : [];
            $publicationRule = $_POST['publicationRule'];
            $tagValues = $_POST['tags'];
            $scopes = (isset($_POST['scopes']) ? $_POST['scopes'] : []);
            $className = $_POST['className'];
            $searchName = isset($_POST['searchName']) ? $_POST['searchName'] : '';
            $labelSuffix = $_POST['labelSuffix'];

            if (!empty($publicationRule)) {
                if (!empty($tagValues) && empty($scopes)) {
                    $publicationRule = CwhRegolePubblicazione::ALL_USERS_WITH_TAGS;
                } else if (empty($tagValues) && !empty($scopes)) {
                    $publicationRule = CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS;
                } else if (!empty($tagValues) && !empty($scopes)) {
                    $publicationRule = CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS_WITH_TAGS;
                }
                
                $publicationRuleLabel = CwhUtil::getPublicationRuleLabel($publicationRule);

                if ($publicationRule == CwhRegolePubblicazione::ALL_USERS_WITH_TAGS && empty($tagValues)) {
                    return AmosCwh::t('amoscwh', 'It is not possible to calculate recipients with rule')
                        . ' <strong>' . $publicationRuleLabel . '</strong> '
                        . AmosCwh::t('amoscwh', 'without specifying tags.');
                    
                } elseif ($publicationRule == CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS && empty($scopes)) {
                    return AmosCwh::t('amoscwh', 'It is not possible to calculate recipients with rule')
                        . ' <strong>' .$publicationRuleLabel . '</strong> '
                        . AmosCwh::t('amoscwh', 'without specifying publication scopes.');
                    
                } elseif ($publicationRule == CwhRegolePubblicazione::ALL_USERS_IN_DOMAINS_WITH_TAGS && (empty($tagValues) ||  empty($scopes))){
                    return AmosCwh::t('amoscwh', 'It is not possible to calculate recipients with rule')
                        . ' <strong>' .$publicationRuleLabel . '</strong> '
                        . AmosCwh::t('amoscwh', 'without specifying both tags and publication scopes.');
                }

                $cwhActiveQuery = new CwhActiveQuery($className);
                $queryUsers = $cwhActiveQuery->getRecipients($publicationRule, $tagValues, $scopes);
                $query = UserProfile::find()
                    ->innerJoinWith('user')
                    ->andWhere([
                        User::tableName() . '.status' => User::STATUS_ACTIVE,
                        UserProfile::tableName() . '.deleted_at' => null,
                    ])
                    ->andWhere([
                        'not like', User::tableName() . '.username', ['#deleted_']
                    ])
                    ->andWhere([
                        'in', 'user_id', $queryUsers->select('user.id')->asArray()->column()
                    ]);

                if (!empty($searchName)) {
                    $query->andWhere(['or',
                        ['like', 'cognome', $searchName],
                        ['like', 'nome', $searchName],
                        ['like', "CONCAT( nome , ' ', cognome )", $searchName],
                        ['like', "CONCAT( cognome , ' ', nome )", $searchName],
                    ]);
                }

                return $this->render("recipients-check", [
                    'validators' => CwhUtil::getDomainNames($validators),
                    'publicationRule' => $publicationRuleLabel,
                    'tagValues' => CwhUtil::getTagNames($tagValues),
                    'scopes' => CwhUtil::getDomainNames($scopes),
                    'searchName' => $searchName,
                    'query' => $query,
                    'labelSuffix' => $labelSuffix
                ]);
            }
        }
        
        return null;
    }

    /**
     * @param $cwhNodIid
     * @return mixed
     */
    public function actionGetNetwork($cwhNodiId) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cwhNode = CwhNodi::findOne($cwhNodiId);
        $targetString = '';
        if(!is_null($cwhNode)){
            $network  = $cwhNode->network;
                if (array_key_exists('arter\amos\community\models\CommunityContextInterface', class_implements($network))) {
                    $targetString .= Module::t('amoscore', 'community') . ' ';
                }
                if (array_key_exists('arter\amos\core\interfaces\OrganizationsModelInterface', class_implements($network))) {
                    $targetString .= Module::t('amoscore', 'organizzazione') . ' ';
                }
                /** if is USER */
                else return '';
            return Module::t('amoscore', 'dalla'). ' ' .$targetString . ' ' .$cwhNode->network->name;
        }

        return '';
    }
}