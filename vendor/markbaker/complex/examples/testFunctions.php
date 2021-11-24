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


namespace Complex;

include('../classes/Bootstrap.php');

echo 'Function Examples', PHP_EOL;

$functions = array(
    'abs',
    'acos',
    'acosh',
    'acsc',
    'acsch',
    'argument',
    'asec',
    'asech',
    'asin',
    'asinh',
    'conjugate',
    'cos',
    'cosh',
    'csc',
    'csch',
    'exp',
    'inverse',
    'ln',
    'log2',
    'log10',
    'rho',
    'sec',
    'sech',
    'sin',
    'sinh',
    'sqrt',
    'theta'
);

for ($real = -3.5; $real <= 3.5; $real += 0.5) {
    for ($imaginary = -3.5; $imaginary <= 3.5; $imaginary += 0.5) {
        foreach ($functions as $function) {
            $complexFunction = __NAMESPACE__ . '\\' . $function;
            $complex = new Complex($real, $imaginary);
            try {
                echo $function, '(', $complex, ') = ', $complexFunction($complex), PHP_EOL;
            } catch (\Exception $e) {
                echo $function, '(', $complex, ') ERROR: ', $e->getMessage(), PHP_EOL;
            }
        }
        echo PHP_EOL;
    }
}
