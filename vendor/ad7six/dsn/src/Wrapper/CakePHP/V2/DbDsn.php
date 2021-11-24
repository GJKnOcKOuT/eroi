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


namespace AD7six\Dsn\Wrapper\CakePHP\V2;

use AD7six\Dsn\Wrapper\Dsn;

/**
 * DbDsn
 *
 */
class DbDsn extends Dsn
{

/**
 * Array of scheme => adapters
 *
 * @var array
 */
    protected static $adapterMap = [
        'mssql' => 'Database/Sqlserver',
        'mysql' => 'Database/Mysql',
        'pg' => 'Database/Postgres',
        'pgsql' => 'Database/Postgres',
        'postgres' => 'Database/Postgres',
        'sqlite' => 'Database/Sqlite',
        'sqlite3' => 'Database/Sqlite',
        'sqlserver' => 'Database/Sqlserver',
    ];

/**
 * The keymap for CakePHP db dsns.
 *
 * Adapter is false to prevent it appearing in this wrapper's array representation
 *
 * @var array
 */
    protected $defaultOptions = [
        'keyMap' => [
            'engine' => 'datasource',
            'adapter' => false,
            'user' => 'login',
            'pass' => 'password'
        ]
    ];

/**
 * getDatasource
 *
 * Get the engine to use for this dsn. Defaults to `Database/Enginename`
 *
 * @return string
 */
    public function getDatasource()
    {
        $adapter = $this->getAdapter();

        if ($adapter) {
            return $adapter;
        }

        $engine = $this->dsn->engine;

        return 'Database/' . ucfirst($engine);
    }

/**
 * getPersistent
 *
 * Cast the string value in the dsn to a bool
 *
 * @return bool
 */
    public function getPersistent()
    {
        return (bool)$this->dsn->persistent;
    }

/**
 * parse a url as a database dsn
 *
 * @param string $url
 * @param array $options
 * @return array
 */
    public static function parse($url, $options = [])
    {
        $inst = new DbDsn($url, $options);
        return $inst->toArray();
    }
}
