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

namespace Symfony\Component\CssSelector\Node;

use Symfony\Component\CssSelector\Parser\Token;

/**
 * Represents a "<selector>:<name>(<arguments>)" node.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class FunctionNode extends AbstractNode
{
    /**
     * @var NodeInterface
     */
    private $selector;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Token[]
     */
    private $arguments;

    /**
     * @param NodeInterface $selector
     * @param string        $name
     * @param Token[]       $arguments
     */
    public function __construct(NodeInterface $selector, $name, array $arguments = array())
    {
        $this->selector = $selector;
        $this->name = strtolower($name);
        $this->arguments = $arguments;
    }

    /**
     * @return NodeInterface
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Token[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function getSpecificity()
    {
        return $this->selector->getSpecificity()->plus(new Specificity(0, 1, 0));
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $arguments = implode(', ', array_map(function (Token $token) {
            return "'".$token->getValue()."'";
        }, $this->arguments));

        return sprintf('%s[%s:%s(%s)]', $this->getNodeName(), $this->selector, $this->name, $arguments ? '['.$arguments.']' : '');
    }
}
