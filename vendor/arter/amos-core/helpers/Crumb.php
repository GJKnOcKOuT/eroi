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
 * @package    arter\amos\core\helpers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\helpers;


class Crumb
{
    public $label = '';
    public $url = '';
    public $controller = null;
    public $model = null;
    public $module = null;
    public $action = null;
    public $route = null;
    public $params = null;
    public $remove_action = null;
    public $visible = true;

    /**
     * @return array
     */
    public function asArray()
    {
        return (array)$this;
    }

    /**
     * @param Crumb $crumb
     * @return bool
     */
    public function equals(Crumb $crumb)
    {
        return ($this->label == $crumb->label && $this->controller == $crumb->controller);
    }
}