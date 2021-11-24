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

namespace arter\amos\cwh\widgets;

use yii\base\Widget;

/**
 * Class DestinatariPlusTagWidget
 * @package arter\amos\cwh\widgets
 */
class DestinatariPlusTagWidget extends Widget
{
    public
        $model,
        $moduleCwh,
        $scope;

    /**
     * @var int|array $singleFixedTreeId
     */
    public $singleFixedTreeId;

    /**
     * @return string
     */
    public function run()
    {
        return $this->render(
            'destinatari-plus-tag',
            [
                'singleFixedTreeId' => $this->singleFixedTreeId,
                'model' => $this->model,
                'moduleCwh' => $this->moduleCwh
            ]
        );
    }

    /**
     * @return \yii\db\ActiveRecord
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param \yii\db\ActiveRecord $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }
}
