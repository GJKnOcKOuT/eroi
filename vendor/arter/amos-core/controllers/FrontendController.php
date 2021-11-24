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
 * @package    arter\amos\core\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\controllers;

/**
 * Class FrontendController
 * @package arter\amos\core\controllers
 */
abstract class FrontendController extends AmosController
{
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        //$this->view->on(\Yii\base\View::EVENT_BEFORE_RENDER, [$this, 'setupSeoMetadata']);

        $siteManagementModule = \Yii::$app->getModule('sitemanagement');
        if (!is_null($siteManagementModule)) {
            /** @var \amos\sitemanagement\Module $siteManagementModule */
            $siteManagementModule->registerMetadata();
        }

        return true;
    }

    public function setupSeoMetadata($model) {
        if (!$model) {
            return false;
        }

        if ($model->getOgTitle()) {
            $this->view->registerMetaTag(['name' => 'og:title', 'content' => $model->getOgTitle()],
                'ogTitle');
            $this->view->registerMetaTag(['property' => 'og:title', 'content' => $model->getOgTitle()],
                'fbTitle');
        }
        if ($model->getOgDescription()) {
            $this->view->registerMetaTag(['name' => 'og:description', 'content' => $model->getOgDescription()],
                'ogDescription');
            $this->view->registerMetaTag(['property' => 'og:description', 'content' => $model->getOgDescription()],
                'fbDescription');
        }
        if ($model->getOgType()) {
            $this->view->registerMetaTag(['name' => 'og:type', 'content' => $model->getOgType()],
                'ogType');
            $this->view->registerMetaTag(['property' => 'og:type', 'content' => $model->getOgType()],
                'fbType');
        }
        if ($model->getOgImageUrl()) {
            $this->view->registerMetaTag(['name' => 'og:image', 'content' => $model->getOgImageUrl()],
                'ogImage', false);
            $this->view->registerMetaTag(['property' => 'og:image', 'content' => $model->getOgImageUrl()],
                'fbImage', false);
        }
        if ($model->getMetaRobots()) {
            $this->view->registerMetaTag(['name' => 'robots', 'content' => $model->getMetaRobots()],
                'metaRobots');
            $this->view->registerMetaTag(['property' => 'robots', 'content' => $model->getMetaRobots()],
                'fbmetaRobots');
        }
        if ($model->getMetaGooglebot()) {
            $this->view->registerMetaTag(['name' => 'googlebot', 'content' => $model->getMetaGooglebot()],
                'metaGooglebot');
            $this->view->registerMetaTag(['property' => 'googlebot', 'content' => $model->getMetaGooglebot()],
                'fbmetaGooglebot');
        }
        if ($model->getMetaDescription()) {
            $this->view->registerMetaTag(['name' => 'description', 'content' => $model->getMetaDescription()],
                'metaDescription');
            $this->view->registerMetaTag(['property' => 'description', 'content' => $model->getMetaDescription()],
                'fbmetaDescription');
        }
        if ($model->getMetaKeywords()) {
            $this->view->registerMetaTag(['name' => 'keywords', 'content' => $model->getMetaKeywords()],
                'metyKeywords');
            $this->view->registerMetaTag(['property' => 'keywords', 'content' => $model->getMetaKeywords()],
                'fbmetyKeywords');
        }
    }
}
