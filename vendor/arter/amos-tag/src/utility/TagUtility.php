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
 * @package    arter\amos\tag\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag\utility;

use arter\amos\tag\models\EntitysTagsMm;
use arter\amos\tag\models\Tag;
use yii\base\BaseObject;
use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * Class TagUtility
 * @package arter\amos\tag\utility
 */
class TagUtility extends BaseObject
{
    /**
     * This method returns all tags selected for a model.
     * @param string $className
     * @param int $modelId
     * @return Tag[]
     */
    public static function findTagsByModel($className, $modelId)
    {
        $entityTagsMmTable = EntitysTagsMm::tableName();
        /** @var ActiveQuery $query */
        $query = Tag::find();
        $query->innerJoinWith('entitysTagsMms');
        $query->andWhere([$entityTagsMmTable . '.classname' => $className]);
        $query->andWhere([$entityTagsMmTable . '.record_id' => $modelId]);
        $query->andWhere([Tag::tableName() . '.deleted_at' => null]);
        $tags = $query->all();
        return $tags;
    }

    /**
     * This method returns all tag ids selected for a model.
     * @param string $className
     * @param int $modelId
     * @return Tag[]
     */
    public static function findTagIdsByModel($className, $modelId)
    {
        $tagTable = Tag::tableName();
        $entityTagsMmTable = EntitysTagsMm::tableName();
        $query = new Query();
        $query->select([$tagTable . '.id']);
        $query->from([$tagTable]);
        $query->innerJoin($entityTagsMmTable, '`' . $tagTable . '`.`id` = `' . $entityTagsMmTable . '`.`tag_id`');
        $query->andWhere([$tagTable . '.deleted_at' => null]);
        $query->andWhere([$entityTagsMmTable . '.deleted_at' => null]);
        $query->andWhere([$entityTagsMmTable . '.classname' => $className]);
        $query->andWhere([$entityTagsMmTable . '.record_id' => $modelId]);
        $tagIds = $query->column();
        return $tagIds;
    }

    /**
     * This method returns all root tags.
     * @return Tag[]
     */
    public static function findAllRootTags()
    {
        /** @var ActiveQuery $query */
        $query = Tag::find();
        $query->groupBy(['root']);
        $rootTags = $query->all();
        return $rootTags;
    }

    /**
     * This method returns all root tag ids.
     * @return array
     */
    public static function findAllRootTagIds()
    {
        $tagTable = Tag::tableName();
        $query = new Query();
        $query->select(['root']);
        $query->from($tagTable);
        $query->andWhere(['deleted_at' => null]);
        $query->groupBy(['root']);
        $rootIds = $query->column();
        return $rootIds;
    }
}
