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


use Symfony\CS\Config\Config;
use Symfony\CS\FixerInterface;

$config = Config::create()
    // use symfony level and extra fixers:
    ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
    ->fixers(array(
        '-concat_without_spaces',
        '-pre_increment',
        '-unalign_double_arrow',
        '-unalign_equals',
        'align_double_arrow',
        'concat_with_spaces',
        'ordered_use',
        'strict',
    ))
    ->setUsingLinter(false);

$finder = $config->getFinder()
    ->in('bin')
    ->in('src')
    ->in('test');

return $config;
