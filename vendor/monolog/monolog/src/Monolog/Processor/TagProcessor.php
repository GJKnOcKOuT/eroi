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


/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Monolog\Processor;

/**
 * Adds a tags array into record
 *
 * @author Martijn Riemers
 */
class TagProcessor implements ProcessorInterface
{
    private $tags;

    public function __construct(array $tags = array())
    {
        $this->setTags($tags);
    }

    public function addTags(array $tags = array())
    {
        $this->tags = array_merge($this->tags, $tags);
    }

    public function setTags(array $tags = array())
    {
        $this->tags = $tags;
    }

    public function __invoke(array $record)
    {
        $record['extra']['tags'] = $this->tags;

        return $record;
    }
}
