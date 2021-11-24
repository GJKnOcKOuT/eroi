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

use arter\amos\audit\components\panels\DataStoragePanelTrait;

use Yii;
use yii\base\InlineAction;
use yii\helpers\Inflector;

/**
 * RequestPanel
 * @package arter\amos\audit\panels
 */
class RequestPanel extends \yii\debug\panels\RequestPanel
{
    use DataStoragePanelTrait;

    /**
     * @var array
     */
    public $ignoreKeys = [];

    /**
     * @inheritdoc
     */
    public function getDetail()
    {
        return \Yii::$app->view->render('@yii/debug/views/default/panels/request/detail', ['panel' => $this]);
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        if (Yii::$app->request instanceof \yii\console\Request) {
            return $this->saveCliRequest();
        }
        return $this->cleanData(parent::save());
    }

    /**
     * @return array
     */
    protected function saveCliRequest()
    {
        return $this->cleanData([
            'flashes' => $this->getFlashes(),
            'statusCode' => 0,
            'requestHeaders' => [],
            'responseHeaders' => [],
            'route' => $this->getRoute(),
            'action' => $this->getAction(),
            'actionParams' => Yii::$app->request->params,
            'requestBody' => [],
            'SERVER' => empty($_SERVER) ? [] : $_SERVER,
            'GET' => empty($_GET) ? [] : $_GET,
            'POST' => empty($_POST) ? [] : $_POST,
            'COOKIE' => empty($_COOKIE) ? [] : $_COOKIE,
            'FILES' => empty($_FILES) ? [] : $_FILES,
            'SESSION' => empty($_SESSION) ? [] : $_SESSION,
        ]);
    }

    /**
     * @return null|string
     */
    protected function getAction()
    {
        if (Yii::$app->requestedAction) {
            if (Yii::$app->requestedAction instanceof InlineAction) {
                return get_class(Yii::$app->requestedAction->controller) . '::' . Yii::$app->requestedAction->actionMethod . '()';
            }
            return get_class(Yii::$app->requestedAction) . '::run()';
        }
        return null;
    }

    /**
     * @return string
     */
    protected function getRoute()
    {
        if (Yii::$app->requestedAction) {
            return Inflector::camel2id(Yii::$app->requestedAction->getUniqueId());
        }
        return Yii::$app->requestedRoute;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function cleanData($data)
    {
        foreach ($data as $k => $v) {
            if (in_array($k, $this->ignoreKeys)) {
                $data[$k] = null;
            }
        }
        return $data;
    }

}
