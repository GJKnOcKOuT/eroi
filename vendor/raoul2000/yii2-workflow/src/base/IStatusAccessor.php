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

use raoul2000\workflow\base\Status;
use yii\db\BaseActiveRecord;

/**
 * Interface for status accessor component.
 */
interface IStatusAccessor
{
	/**
	 * This method is invoked each time a status value must be read.
	 *
	 * @param BaseActiveRecord $model
	 * @return string the status Id
	 */
	public function readStatus(BaseActiveRecord $model);

	/**
	 * This method is invoked each time a status value must be updated.
	 *
	 * Updating a status value differs from actually saving the status in persistent storage (the database).
	 * @param BaseActiveRecord $model
	 * @param Status $status
	 */
	public function updateStatus(BaseActiveRecord $model, Status $status = null);

	/**
	 * This method is invoked when the status needs to be saved.
	 * @param BaseActiveRecord $model
	 */
	public function commitStatus($model);
}
