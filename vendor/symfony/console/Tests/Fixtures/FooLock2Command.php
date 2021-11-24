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
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FooLock2Command extends Command
{
    use LockableTrait;

    protected function configure()
    {
        $this->setName('foo:lock2');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->lock();
            $this->lock();
        } catch (LogicException $e) {
            return 1;
        }

        return 2;
    }
}
