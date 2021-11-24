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


namespace Symfony\Component\Debug\Tests\Fixtures;

/**
 * @final since version 3.3.
 */
class FinalClass1
{
    // simple comment
}

/**
 * @final
 */
class FinalClass2
{
    // no comment
}

/**
 * @final comment with @@@ and ***
 *
 * @author John Doe
 */
class FinalClass3
{
    // with comment and a tag after
}

/**
 * @final
 *
 * @author John Doe
 */
class FinalClass4
{
    // without comment and a tag after
}

/**
 * @author John Doe
 *
 * @final multiline
 * comment
 */
class FinalClass5
{
    // with comment and a tag before
}

/**
 * @author John Doe
 *
 * @final
 */
class FinalClass6
{
    // without comment and a tag before
}

/**
 * @author John Doe
 *
 * @final another
 *        multiline comment...
 *
 * @return string
 */
class FinalClass7
{
    // with comment and a tag before and after
}

/**
 * @author John Doe
 * @final
 *
 * @return string
 */
class FinalClass8
{
    // without comment and a tag before and after
}
