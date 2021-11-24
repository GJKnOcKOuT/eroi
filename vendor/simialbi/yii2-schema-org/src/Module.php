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

/**
 * @link https://github.com/simialbi/yii2-schema-org
 * @copyright Copyright (c) 2017 Simon Karlen
 * @license MIT
 */

namespace simialbi\yii2\schemaorg;

use simialbi\yii2\schemaorg\helpers\JsonLDHelper;
use yii\base\BootstrapInterface;
use yii\web\View;

/**
 * Class Module
 *
 * @package simialbi\yii2\schemaorg
 * @author Simon Karlen <simi.albi@outlook.com>
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @var string the namespace that controller classes are in.
     */
    public $controllerNamespace = 'simialbi\yii2\schemaorg\controllers';

    /**
     * @var boolean automatically add ld+json data for breadcrumbs
     */
    public $autoCreate = false;

    /**
     * @var boolean automatically render ld+json data at the end of body
     */
    public $autoRender = false;

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'simialbi\yii2\schemaorg\commands';

            // Backwards compatibility
            $app->urlManager->addRules([
                '/' . $this->id . '/schema-org/<action>' => $this->id . '/models/<action>',
                '/' . $this->id . '/schema-org/index' => $this->id . '/models/generate',
                '/' . $this->id . '/schema-org' => $this->id . '/models/generate'
            ]);
        } else {
            if ($this->autoCreate) {
                \Yii::$app->view->on(View::EVENT_END_BODY, function () {
                    JsonLDHelper::addBreadCrumbList();
                });
            }
            if ($this->autoRender) {
                \Yii::$app->view->on(View::EVENT_END_BODY, function () {
                    JsonLDHelper::render();
                });
            }
        }
    }
}