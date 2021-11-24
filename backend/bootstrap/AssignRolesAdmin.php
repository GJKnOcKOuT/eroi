<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

namespace backend\bootstrap;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Yii;
use yii\base\Application;

/**
 * Class AssignRolesAdmin: <br />
 * Assign administration roles to user ADMIN <br />
 * ELIGIBLE FOR DEPRECATION (DEPRECATED)
 * @package backend\bootstrap
 */
class AssignRolesAdmin extends \yii\base\Component {

    private $_startTime;

    /**
     * Application-specific roles initialization
     * @uses onApplicationAction
     */
    public function init() {
        parent::init(); 
        \Yii::$app->on(Application::EVENT_BEFORE_ACTION, [$this, 'onApplicationAction']);
    }

    /**
     * Application-specific roles initialization
     */
    public function onApplicationAction($event) {
        $actionId = $event->action->uniqueId;
        $authManager = Yii::$app->authManager;
        $roles = $authManager->getRoles();
        $children = $authManager->getChildren('ADMIN');
        $adminRole = $authManager->getRole('ADMIN');
        foreach ($roles as $key => $value) {
            if ($key != 'ADMIN' && !isset($children[$key]) && !in_array($key, ['AMMINISTRATORE_CWH'])) { // TODO translate
                $ruolo = $authManager->getRole($key);
                $authManager->addChild($adminRole, $value);
            }
        }
    }

}
