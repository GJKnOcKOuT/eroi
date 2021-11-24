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

namespace arter\amos\audit\panels;

use Yii;
use arter\amos\audit\models\AuditError;
use arter\amos\audit\components\panels\DataStoragePanel;
use yii\data\ArrayDataProvider;

/**
 * Class CurlPanel
 * @package arter\amos\audit\src\panels
 */
class SoapPanel extends DataStoragePanel
{
    public function getName()
    {
        return Yii::t('audit', 'SOAP');
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->getName() . ' <small>(' . count($this->data) . ')</small>';
    }

    /**
     * Receives a bunch of information about a SOAP request and logs it.
     * If you are unable to use the modules' SoapClient class you can call this function manually to log the data.
     *
     * @param array $data
     */
    public function logSoapRequest($data)
    {
        $this->module->registerPanel($this);

        if (!is_array($this->data))
            $this->data = [];

        if (isset($data['error'])) {
            $error = $this->module->exception($data['error']);
            $data['error'] = [$data['error']->faultcode, $error ? $error->id : null];
        }
        $this->data[] = array_filter($data);
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        return $this->data;
    }

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        $dataProvider = new ArrayDataProvider();
        $dataProvider->allModels = $this->data;

        return Yii::$app->view->render('panels/soap/index', [
            'panel'        => $this,
            'dataProvider' => $dataProvider,
        ]);
    }
}