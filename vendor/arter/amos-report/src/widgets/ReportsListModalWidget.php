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
 * @package    arter\amos\report
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\report\widgets;

use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\Record;
use arter\amos\core\utilities\ModalUtility;
use arter\amos\core\icons\AmosIcons;
use arter\amos\report\AmosReport;
use arter\amos\report\models\Report;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * Class ReportsListModalWidget
 * @package arter\amos\report\widgets
 */
class ReportsListModalWidget extends Widget
{
    /**
     * @var Record $model
     */
    public $model = null;

    /**
     * @return Record
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Record $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->getModel())) {
            throw new \Exception(BaseAmosModule::t('amosreport', 'Missing Model'));
        }
    }

    public function run()
    {
        $model = $this->getModel();
        /** @var ActiveQuery $query */
        $query = Report::find()->andWhere([
            'classname' => $model->className(),
            'context_id' => $model->id
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
//            'pagination' => [
//                'pageSize' => $limit,
//            ]
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC,
                    'created_at' => SORT_ASC
                ]
            ]
        ]);

        $modalContent = $this->render('modal-reports-list', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'context_id' => $model->id,
        ]);

        return ModalUtility::amosModal([
            'id' => 'modal_reports_list-' . $model->id,
            'headerClass' => 'modal-utility-confirm',
            'headerText' => AmosIcons::show('flag') . AmosReport::t('amosreport', '#reports_content_list_modal-title'),
            'modalBodyContent' => $modalContent,
            'modalClassSize' => 'modal-lg'
        ]);
    }
}