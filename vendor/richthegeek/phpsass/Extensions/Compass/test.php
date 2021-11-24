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

function loadCallback($file, $parser)
{
    $paths = array();
    foreach ($parser->extensions as $extensionName) {
        $namespace = ucwords(preg_replace('/[^0-9a-z]+/', '_', strtolower($extensionName)));
        $extensionPath = realpath(__DIR__.'/../' . $namespace . '/' . $namespace . '.php');
        if (is_file($extensionPath)) {
            require_once($extensionPath);
            $hook = $namespace . '::resolveExtensionPath';
            $returnPath = call_user_func($hook, $file, $parser);
            if (!empty($returnPath)) {
                $paths[] = $returnPath;
            }

        }
    }
    
    return $paths;
}

function getFunctions($extensions)
{
    $output = array();
    if (!empty($extensions)) {
        foreach ($extensions as $extension) {
            $name = explode('/', $extension, 2);
            $namespace = ucwords(preg_replace('/[^0-9a-z]+/', '_', strtolower(array_shift($name))));
            $extensionPath = realpath(__DIR__.'/../' . $namespace . '/' . $namespace . '.php');
            if (file_exists(
                $extensionPath
            )
            ) {
                require_once($extensionPath);
                $namespace = $namespace . '::';
                $function = 'getFunctions';
                $output = array_merge($output, call_user_func($namespace . $function, $namespace));
            }
        }
    }

    return $output;
}

$path = realpath(__DIR__).'/../..';
$library = $path . '/SassParser.php';

require_once ($library);

$options = array(
            'style' => 'expanded',
            'cache' => false,
            'syntax' => 'scss',
            'debug' => false,
            'debug_info' => false,
            'load_path_functions' => array('loadCallback'),
            'load_paths' => array(dirname($file)),
            'functions' => getFunctions(array('Compass','Own')),
            'extensions' => array('Compass','Own')
);
$parser = new SassParser($options);
return $parser->toCss($file);