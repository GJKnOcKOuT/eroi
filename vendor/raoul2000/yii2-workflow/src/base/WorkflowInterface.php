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
 * Interface implemented by Workflow objects.
 */
interface WorkflowInterface
{
	/**
	 * Returns the id of this workflow
	 * 
	 * @return string the workflow id
	 */
	public function getId();
	/**
	 * Returns the id of the initial status for this workflow.
	 *
	 * @return string status id
	 */
	public function getInitialStatusId();
	
	/**
	 * Returns the initial status instance for this workflow.
	 * 
	 * @return \raoul2000\workflow\base\StatusInterface the initial status instance
	 * @throws \raoul2000\workflow\base\WorkflowException when no source component is available
	 */
	public function getInitialStatus();
	/**
	 * Returns an array containing all Status instances belonging to this workflow.
	 * 
	 * @return \raoul2000\workflow\base\StatusInterface[]  status list belonging to this workflow
	 * @throws \raoul2000\workflow\base\WorkflowException when no source component is available
	 */
	public function getAllStatuses();	
}
