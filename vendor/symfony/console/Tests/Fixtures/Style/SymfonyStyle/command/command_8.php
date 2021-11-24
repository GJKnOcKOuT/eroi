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


use Symfony\Component\Console\Helper\TableCell;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

//Ensure formatting tables when using multiple headers with TableCell
return function (InputInterface $input, OutputInterface $output) {
    $headers = [
        [new TableCell('Main table title', ['colspan' => 3])],
        ['ISBN', 'Title', 'Author'],
    ];

    $rows = [
        [
            '978-0521567817',
            'De Monarchia',
            new TableCell("Dante Alighieri\nspans multiple rows", ['rowspan' => 2]),
        ],
        ['978-0804169127', 'Divine Comedy'],
    ];

    $output = new SymfonyStyle($input, $output);
    $output->table($headers, $rows);
};
