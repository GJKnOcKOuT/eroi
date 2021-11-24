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
 * @package    arter\amos\documenti\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\controllers;

use arter\amos\dashboard\controllers\base\DashboardController;

use yii\helpers\Url;

class DefaultController extends DashboardController
{

    /**
     * @var string $layout Layout per la dashboard interna.
     */
    public $layout = 'dashboard_interna';

    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();

        $this->setUpLayout();
    }

    /**
     * Lists all Documenti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $url = '/documenti/documenti/own-interest-documents';
        $module = \Yii::$app->getModule('documenti');
        if ($module) {
            $url = $module->defaultWidgetIndexUrl;
        }

        return $this->redirect([$url]);
    }

    /**
     * @param null $layout
     * @return bool
     */
    public function setUpLayout($layout = null)
    {
        if ($layout === false) {
            $this->layout = false;
            
            return true;
        }

        $this->layout = (!empty($layout)) ? $layout : $this->layout;

        $module = \Yii::$app->getModule('layout');
        if (empty($module)) {
            if (strpos($this->layout, '@') === false) {
                $this->layout = '@vendor/arter/amos-core/views/layouts/' . $this->layout;
            }
        }

        return true;
    }

}
