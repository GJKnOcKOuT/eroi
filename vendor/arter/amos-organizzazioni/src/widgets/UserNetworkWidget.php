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
 * @package    arter\amos\organizzazioni\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\widgets;

use arter\amos\organizzazioni\Module;
use yii\base\Widget;
use Yii;
/**
 * Class UserNetworkWidget
 * @package arter\amos\organizzazioni\widgets
 */
class UserNetworkWidget extends Widget
{
    /**
     * @var int $userId
     */
    public $userId = null;

    /**
     * @var bool|false true if we are in edit mode, false if in view mode or otherwise
     */
    public $isUpdate = false;

    /**
     * @var string $gridId
     */
    public $gridId = 'user-organizzazioni-grid';

    /**
     * @var string $gridSediId
     */
    public $gridSediId = 'user-sedi-grid';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if (is_null($this->userId)) {
            throw new \Exception(Module::t('amosorganizzazioni', '#Missing_user_id'));
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $post = \Yii::$app->request->post();
        $organizzazioniPostName = UserNetworkWidgetOrganizzazioni::getSearchPostName();
        $sediPostName = UserNetworkWidgetSedi::getSearchPostName();
        $organizzazioniWidget = '';
        $sediWidget = '';
        $sedi_enabled = true;
        if (!$post || ($post && isset($post[$organizzazioniPostName]))) {
            $organizzazioniWidget = UserNetworkWidgetOrganizzazioni::widget([
                'userId' => $this->userId,
                'isUpdate' => $this->isUpdate,
                'gridId' => $this->gridId,
            ]);
        }
        /** @var Module $organizationsModule */
        $organizationsModule = Module::instance();
        if (!is_null($organizationsModule->enabled_widget_sedi)) {
            $sedi_enabled = $organizationsModule->enabled_widget_sedi;
        }

        if ($sedi_enabled && (!$post || ($post && isset($post[$sediPostName])))) {
            $sediWidget = UserNetworkWidgetSedi::widget([
                'userId' => $this->userId,
                'isUpdate' => $this->isUpdate,
                'gridId' => $this->gridSediId,
            ]);
        }
        return $organizzazioniWidget . $sediWidget;
    }
}
