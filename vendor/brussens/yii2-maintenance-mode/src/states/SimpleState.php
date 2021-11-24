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
 * @link https://github.com/brussens/yii2-maintenance-mode
 * @copyright Copyright (c) since 2015 Dmitry Brusensky
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace brussens\maintenance\states;

use brussens\maintenance\StateInterface;
use yii\base\BaseObject;

/**
 * Class SimpleState
 * @package brussens\maintenance\states
 */
class SimpleState extends BaseObject implements StateInterface
{
    /**
     * @var bool
     */
    public $enabled = false;

    /**
     * @inheritdoc
     */
    public function enable()
    {
        $this->enabled = true;
    }

    /**
     * @inheritdoc
     */
    public function disable()
    {
        $this->enabled = false;
    }

    /**
     * @inheritdoc
     */
    public function isEnabled()
    {
        return $this->enabled;
    }
}