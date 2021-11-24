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


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

//Ensure has proper line ending before outputting a text block like with SymfonyStyle::listing() or SymfonyStyle::text()
return function (InputInterface $input, OutputInterface $output) {
    $output = new SymfonyStyle($input, $output);

    $output->writeln('Lorem ipsum dolor sit amet');
    $output->listing([
        'Lorem ipsum dolor sit amet',
        'consectetur adipiscing elit',
    ]);

    //Even using write:
    $output->write('Lorem ipsum dolor sit amet');
    $output->listing([
        'Lorem ipsum dolor sit amet',
        'consectetur adipiscing elit',
    ]);

    $output->write('Lorem ipsum dolor sit amet');
    $output->text([
        'Lorem ipsum dolor sit amet',
        'consectetur adipiscing elit',
    ]);

    $output->newLine();

    $output->write('Lorem ipsum dolor sit amet');
    $output->comment([
        'Lorem ipsum dolor sit amet',
        'consectetur adipiscing elit',
    ]);
};
