<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\behaviors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Json;

/**
 * Class EJsonBehavior
 * @package arter\amos\core\behaviors
 */
class EJsonBehavior extends Behavior
{
    /**
     * Get related attributes in JSON format
     * @return string
     */
    public function toJSON()
	{
		$jsonDataSource = $this->getRelated($this->owner);

		return Json::encode($jsonDataSource);
	}

    /**
     * Get related attributes in array format
     * @param $record
     * @return array
     */
	private function getRelated($record)
	{
		$related = array();
		$obj = null;

		$attributes = $record->getAttributes();

		$related['record'] = get_class($record);
		$related['attributes'] = $attributes;
		$related['relations'] = array();

		$relations = $record->getRelatedRecords();

		foreach ($relations as $name => $relation) {
			if(is_array($relation)) {
				foreach($relation as $single) {
					$related['relations'][] = $this->getRelated($single);
				}
			} else {
				$related['relations'][] = $this->getRelated($relation);
			}
		}

		return $related;
	}
}