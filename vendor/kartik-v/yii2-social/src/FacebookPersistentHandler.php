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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2018
 * @package yii2-social
 * @version 1.3.5
 */

namespace kartik\social;

use Facebook\PersistentData\PersistentDataInterface;
use Yii;

/**
 * Facebook persistent handler for Yii.
 */
class FacebookPersistentHandler implements PersistentDataInterface
{
    /**
     * @var string prefix to use for session variables.
     */
    public $sessionPrefix = 'FBPH_';

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        return Yii::$app->session->get($this->sessionPrefix . $key);
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        Yii::$app->session->set($this->sessionPrefix . $key, $value);
    }
}