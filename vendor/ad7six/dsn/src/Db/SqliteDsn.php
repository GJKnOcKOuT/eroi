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


namespace AD7six\Dsn\Db;

use AD7six\Dsn\DbDsn;

/**
 * SqliteDsn
 *
 */
class SqliteDsn extends DbDsn
{

/**
 * The database in a sqlite dsn is a path, not a database name
 *
 * @var bool
 */
    protected $databaseIsPath = true;
}
