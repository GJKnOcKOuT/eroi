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


namespace arter\amos\sondaggi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use arter\amos\sondaggi\models\SondaggiDomandeTipologie;

/**
* SondaggiDomandeTipologieSearch represents the model behind the search form about `arter\amos\sondaggi\models\SondaggiDomandeTipologie`.
*/
class SondaggiDomandeTipologieSearch extends SondaggiDomandeTipologie
{
public function rules()
{
return [
[['id', 'created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['tipologia', 'descrizione', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
];
}

public function scenarios()
{
// bypass scenarios() implementation in the parent class
return Model::scenarios();
}

public function search($params)
{
$query = SondaggiDomandeTipologie::find();

$dataProvider = new ActiveDataProvider([
'query' => $query,
]);

if (!($this->load($params) && $this->validate())) {
return $dataProvider;
}

$query->andFilterWhere([
            'id' => $this->id,
            'attivo' => $this->attivo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'deleted_by' => $this->deleted_by,
            'version' => $this->version,
        ]);

        $query->andFilterWhere(['like', 'tipologia', $this->tipologia])
            ->andFilterWhere(['like', 'descrizione', $this->descrizione]);

return $dataProvider;
}
}
