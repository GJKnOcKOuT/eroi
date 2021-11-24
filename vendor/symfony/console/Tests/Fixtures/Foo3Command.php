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


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Foo3Command extends Command
{
    protected function configure()
    {
        $this
            ->setName('foo3:bar')
            ->setDescription('The foo3:bar command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            try {
                throw new \Exception('First exception <p>this is html</p>');
            } catch (\Exception $e) {
                throw new \Exception('Second exception <comment>comment</comment>', 0, $e);
            }
        } catch (\Exception $e) {
            throw new \Exception('Third exception <fg=blue;bg=red>comment</>', 404, $e);
        }
    }
}
