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

namespace raoul2000\workflow\base;

/**
 * A transition is a link between a start and an end status.
 *
 * If status "A" has a transition to status "B", then it only means that it is possible to go from
 * status "A" to status "B".
 */
interface TransitionInterface
{
	/**
	 * @return string the transition id
	 */
	public function getId();
	/**
	 * Returns the Status instance that is the destination status.
	 *
	 * @return \raoul2000\workflow\base\StatusInterface the Status instance this transition ends to
	 */
	public function getEndStatus();
	/**
	 * Returns the Status instance that is the starting point fo the transition.
	 *
	 * @return \raoul2000\workflow\base\StatusInterface the Status instance this transition starts from
	 */
	public function getStartStatus();
}
