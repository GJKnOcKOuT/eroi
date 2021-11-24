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


include __DIR__ . '/../vendor/autoload.php';

$grid1 = [
    [1, 3, 2],
    [2, 3, 1],
];

$grid2 = [
    [1, 6],
    [0, 1],
];

$matrix = new Matrix\Matrix($grid1);

$new = $matrix->directsum(new Matrix\Matrix($grid2));

var_dump($new);
