<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\seo\frontend;

/**
 * Seo Admin Module.
 *
 * File has been created with `module/create` command. 
 * 
 * @author
 * @since 1.0.0
 */
class Module extends \luya\base\Module
{
    public static function onLoad()
    {
        self::registerTranslation('seo', static::staticBasePath(). '/messages', [
            'seo' => 'seo.php',
        ]);
    }
    
     /**
     * Translations for CMS frontend Module.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('seo', $message, $params);
    }

}