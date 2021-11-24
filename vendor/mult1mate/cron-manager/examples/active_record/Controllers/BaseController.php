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
 * @author mult1mate
 */
class BaseController
{
    public function __construct($db_user, $db_pass, $db_name, $server = 'localhost')
    {
        $cfg = ActiveRecord\Config::instance();
        $cfg->set_model_directory('../models');
        $cfg->set_connections(
            array(
                'development' => 'mysql://' . $db_user . ':' . $db_pass . '@' . $server . '/' . $db_name
            )
        );
    }

    protected function renderView($view, $params, $template = true)
    {
        if ($template) {
            require_once '../views/template.php';
        }
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        require_once "../views/$view.php";
    }
}
