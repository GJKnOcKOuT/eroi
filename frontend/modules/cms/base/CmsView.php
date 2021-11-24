<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cms\base;

use luya\web\View;
use yii\helpers\Url;
use yii\helpers\Html;
use Lullabot\AMP\AMP;
use Lullabot\AMP\Validate\Scope;

class CmsView extends View
{
    private $queryVars = [
        'amp',
        'path'
    ];

    /**
     * 
     */
    public function init()
    {
        if (\Yii::$app instanceof \luya\console\Application) {
            $this->autoRegisterCsrf = false;
        }
        parent::init();
    }

    public function beforeRender($viewFile, $params)
    {
        $isValid = parent::beforeRender($viewFile, $params);
        return $isValid;
    }

    /**
     * 
     * @param type $view
     * @param type $params
     * @param type $context
     * @return type
     */
    public function render($view, $params = array(), $context = null)
    {
        $html = null;

        if ($this->isAmp()) {
            $this->clearForAmp();
            $amp  = new AMP();
            $amp->loadHtml(parent::render($view, $params, $context),
                ['canonical_path' => Url::canonical(), 'base_url_for_relative_path' => rtrim(Url::home(true),
                    '/'), 'server_url' => rtrim(Url::home(true), '/'), 'url_with_query' => true]);
            $html = $amp->convertToAmpHtml();
        } else {
            $html = parent::render($view, $params, $context);
        }

        return $html;
    }

    /**
     * 
     */
    public function renderHeadHtml()
    {
        $html = null;

        if ($this->isAmp()) {
            $this->clearForAmp();
            $amp  = new AMP();
            $amp->loadHtml(parent::renderHeadHtml(),
                ['canonical_path' => Url::canonical(), 'base_url_for_relative_path' => rtrim(Url::home(true),
                    '/'), 'server_url' => rtrim(Url::home(true), '/'), 'url_with_query' => true]);
            $html = $amp->convertToAmpHtml();
            $html = Html::tag('link', '',
                    ['rel' => 'canonical', 'href' => Url::current(\Yii::$app->controller->actionParams,
                        true)]).PHP_EOL.$html;
        } else {
            $this->registerLinkTag(['rel' => 'amphtml', 'href' => \Yii::$app->menu->current->getAbsoluteLink().'?amp=amp']);
            $html = parent::renderHeadHtml();
        }
        return $html;
    }

    /**
     * 
     * @return boolean
     */
    public function isAmp()
    {
        $is = false;

        foreach ($this->queryVars as $var) {
            $value = \Yii::$app->request->getQueryParam($var);
            if (!empty($value)) {
                if ($value == 'amp') {
                    $is = true;
                }
                break;
            }
        }
        return $is;
    }

    /**
     * 
     */
    private function clearForAmp()
    {
        $this->css          = [];
        $this->cssFiles     = [];
        $this->js           = [];
        $this->jsFiles      = [];
        $this->assetBundles = [];
        $this->linkTags     = [];
    }
}