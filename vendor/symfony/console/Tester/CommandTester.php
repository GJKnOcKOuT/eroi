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

namespace Symfony\Component\Console\Tester;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Output\StreamOutput;

/**
 * Eases the testing of console commands.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
class CommandTester
{
    private $command;
    private $input;
    private $output;
    private $inputs = [];
    private $statusCode;

    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Executes the command.
     *
     * Available execution options:
     *
     *  * interactive: Sets the input interactive flag
     *  * decorated:   Sets the output decorated flag
     *  * verbosity:   Sets the output verbosity flag
     *
     * @param array $input   An array of command arguments and options
     * @param array $options An array of execution options
     *
     * @return int The command exit code
     */
    public function execute(array $input, array $options = [])
    {
        // set the command name automatically if the application requires
        // this argument and no command name was passed
        if (!isset($input['command'])
            && (null !== $application = $this->command->getApplication())
            && $application->getDefinition()->hasArgument('command')
        ) {
            $input = array_merge(['command' => $this->command->getName()], $input);
        }

        $this->input = new ArrayInput($input);
        // Use an in-memory input stream even if no inputs are set so that QuestionHelper::ask() does not rely on the blocking STDIN.
        $this->input->setStream(self::createStream($this->inputs));

        if (isset($options['interactive'])) {
            $this->input->setInteractive($options['interactive']);
        }

        $this->output = new StreamOutput(fopen('php://memory', 'w', false));
        $this->output->setDecorated(isset($options['decorated']) ? $options['decorated'] : false);
        if (isset($options['verbosity'])) {
            $this->output->setVerbosity($options['verbosity']);
        }

        return $this->statusCode = $this->command->run($this->input, $this->output);
    }

    /**
     * Gets the display returned by the last execution of the command.
     *
     * @param bool $normalize Whether to normalize end of lines to \n or not
     *
     * @return string The display
     */
    public function getDisplay($normalize = false)
    {
        if (null === $this->output) {
            throw new \RuntimeException('Output not initialized, did you execute the command before requesting the display?');
        }

        rewind($this->output->getStream());

        $display = stream_get_contents($this->output->getStream());

        if ($normalize) {
            $display = str_replace(\PHP_EOL, "\n", $display);
        }

        return $display;
    }

    /**
     * Gets the input instance used by the last execution of the command.
     *
     * @return InputInterface The current input instance
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Gets the output instance used by the last execution of the command.
     *
     * @return OutputInterface The current output instance
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Gets the status code returned by the last execution of the application.
     *
     * @return int The status code
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the user inputs.
     *
     * @param array $inputs An array of strings representing each input
     *                      passed to the command input stream
     *
     * @return CommandTester
     */
    public function setInputs(array $inputs)
    {
        $this->inputs = $inputs;

        return $this;
    }

    private static function createStream(array $inputs)
    {
        $stream = fopen('php://memory', 'r+', false);

        foreach ($inputs as $input) {
            fwrite($stream, $input.\PHP_EOL);
        }

        rewind($stream);

        return $stream;
    }
}
