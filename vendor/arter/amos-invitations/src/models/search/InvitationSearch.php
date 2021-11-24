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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use arter\amos\invitations\models\Invitation;
use yii\db\ActiveQuery;

/**
 * InvitationSearch represents the model behind the search form about `arter\amos\invitations\models\Invitation`.
 */
class InvitationSearch extends Invitation
{
    public $email;

    public function rules()
    {
        return [
            [['id', 'send', 'invitation_user_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['name', 'surname', 'message', 'send_time', 'email', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        /** @var ActiveQuery $query */
        $query = Invitation::find()
            ->andWhere([Invitation::tableName() . '.created_by' => Yii::$app->user->id])
            ->orderBy('send ASC, send_time DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $scope = $this->getScope($params);
        if (!($this->load($params, $scope) && $this->validate())) {
            return $dataProvider;
        }
        
        if (!empty($this->email)) {
            $query->innerJoinWith('invitationUser')
                ->andFilterWhere(['like', 'email', $this->email]);
        }

        if ((isset($params['moduleName'])) && (isset($params['contextModelId']))) {
//            if ($params['moduleName'] == 'community') {
            $query
                ->andWhere(['=', 'context_model_id', $params['contextModelId']]);
//            }
        }



        $query->andFilterWhere([
            'id' => $this->id,
            'send_time' => $this->send_time,
            'send' => $this->send,
            'invitation_user_id' => $this->invitation_user_id,
            'invitation.created_at' => $this->created_at,
            'invitation.updated_at' => $this->updated_at,
            'invitation.deleted_at' => $this->deleted_at,
            'invitation.created_by' => $this->created_by,
            'invitation.updated_by' => $this->updated_by,
            'invitation.deleted_by' => $this->deleted_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }

    public function searchAll($params)
    {
        /** @var ActiveQuery $query */
        $query = Invitation::find();
        $query->innerJoinWith('invitationUser');

        if ((isset($params['moduleName'])) && (isset($params['contextModelId']))) {
//            if ($params['moduleName'] == 'community') {
                $query
                    ->andWhere(['=', 'context_model_id', $params['contextModelId']]);
//            }
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'send' => SORT_ASC,
                    'send_time' => SORT_DESC,
                ],
                'attributes' => [
                    'invitationUser.email' => [
                        'asc' => ['invitation_user.email' => SORT_ASC],
                        'desc' => ['invitation_user.email' => SORT_DESC]
                        ],
                    'name',
                    'surname',
                    'send_time',
                    'send'
                ]
            ],
        ]);

        $scope = $this->getScope($params);

        if (!($this->load($params, $scope) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'send_time' => $this->send_time,
            'send' => $this->send,
            'invitation_user_id' => $this->invitation_user_id,
            'invitation.created_at' => $this->created_at,
            'invitation.updated_at' => $this->updated_at,
            'invitation.deleted_at' => $this->deleted_at,
            'invitation.created_by' => $this->created_by,
            'invitation.updated_by' => $this->updated_by,
            'invitation.deleted_by' => $this->deleted_by,
        ])->andFilterWhere(['like', 'email', $this->email]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }

    public function getScope($params)
    {
        $scope = $this->formName();
        if (!isset($params[$scope])) {
            $scope = '';
        }
        return $scope;
    }
}
