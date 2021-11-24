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
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class SectionObjects
{
    public $start = 'It worked the first time.';

    public function middle()
    {
        return new SectionObject();
    }

    public $final = 'Then, surprisingly, it worked the final time.';
}

class SectionObject
{
    public $foo = 'And it worked the second time.';
    public $bar = 'As well as the third.';
}
