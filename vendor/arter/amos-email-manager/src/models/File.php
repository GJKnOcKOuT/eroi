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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\emailmanager\models;

use yii\base\BaseObject;


class File extends BaseObject
{
    public $content;
    public $name;
    public $type;


    /**
     *
     * @return type
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     *
     * @return type
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param type $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     *
     * @param type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param type $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}
