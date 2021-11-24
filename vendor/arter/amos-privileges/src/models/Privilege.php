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
 * @package    arter\amos\privileges
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\privileges\models;

use yii\base\Model;

/**
 * Class Privilege
 * @package arter\amos\privileges\models
 */
class Privilege extends Model
{

    public $name;
    public $type;
    public $text;
    public $description;
    public $tooltip;
    public $domains;
    public $active = false;
    public $can = false;
    public $isChild;
    public $parents = [];
    public $isCwh = false;
    public $isPlatformUserClass = false;

}