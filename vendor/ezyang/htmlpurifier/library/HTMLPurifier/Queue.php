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


/**
 * A simple array-backed queue, based off of the classic Okasaki
 * persistent amortized queue.  The basic idea is to maintain two
 * stacks: an input stack and an output stack.  When the output
 * stack runs out, reverse the input stack and use it as the output
 * stack.
 *
 * We don't use the SPL implementation because it's only supported
 * on PHP 5.3 and later.
 *
 * Exercise: Prove that push/pop on this queue take amortized O(1) time.
 *
 * Exercise: Extend this queue to be a deque, while preserving amortized
 * O(1) time.  Some care must be taken on rebalancing to avoid quadratic
 * behaviour caused by repeatedly shuffling data from the input stack
 * to the output stack and back.
 */
class HTMLPurifier_Queue {
    private $input;
    private $output;

    public function __construct($input = array()) {
        $this->input = $input;
        $this->output = array();
    }

    /**
     * Shifts an element off the front of the queue.
     */
    public function shift() {
        if (empty($this->output)) {
            $this->output = array_reverse($this->input);
            $this->input = array();
        }
        if (empty($this->output)) {
            return NULL;
        }
        return array_pop($this->output);
    }

    /**
     * Pushes an element onto the front of the queue.
     */
    public function push($x) {
        array_push($this->input, $x);
    }

    /**
     * Checks if it's empty.
     */
    public function isEmpty() {
        return empty($this->input) && empty($this->output);
    }
}
