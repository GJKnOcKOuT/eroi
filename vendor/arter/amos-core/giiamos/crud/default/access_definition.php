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
 * @package    arter\amos\core\giiamos\crud\default
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * define action permissions and roles
 * use in controller access control, access migration and for role translation
 */
use yii\helpers\Inflector;
/**
 * action list
 */
$actions = ['index','view','create','update','delete'];
/**
 * permissions - create name and descriptions
 */
$permisions = [];
foreach ($actions as $k => $action){
    $name = $this->getModuleId() 
            . '_' . $this->getControllerID() 
            . '_' . $action;
    $description = $this->getModuleId() 
            . '/' . $this->getControllerID() 
            . '/' . $action;
    $permisions[$action] = [
        'name' => $name,
        'description' => $description,
        ];
}
/**
 * roles dependencies
 */
$roles = [
        'Full' => ['index','view','create','update','delete'],
        'View' => ['index','view'],
        'Edit' => ['update','create','delete'],
        ]; 
/**
 * create roles name
 */
foreach($roles as $role => $roleActons){
    unset($roles[$role]);
    $roleName = Inflector::camelize($this->getModuleId())
            .Inflector::camelize($this->getControllerID())
            .$role;
    $roles[$roleName] = $roleActons;
}
return [
    'permisions' => $permisions,
    'roles' => $roles,
];