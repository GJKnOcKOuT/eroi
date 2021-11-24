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


/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\Fixtures;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DescriptorCommandMbString extends Command
{
    protected function configure()
    {
        $this
            ->setName('descriptor:åèä')
            ->setDescription('command åèä description')
            ->setHelp('command åèä help')
            ->addUsage('-o|--option_name <argument_name>')
            ->addUsage('<argument_name>')
            ->addArgument('argument_åèä', InputArgument::REQUIRED)
            ->addOption('option_åèä', 'o', InputOption::VALUE_NONE)
        ;
    }
}
