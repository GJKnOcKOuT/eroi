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
 * @package    arter\amos\report
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\report\utilities;

use arter\amos\report\AmosReport;
use arter\amos\report\models\Report;

/**
 * Class ReportUtil
 * @package arter\amos\report\utilities
 */
class ReportUtil
{

    public static function translateArrayValues($arrayValues)
    {
        $translatedArrayValues = [];
        foreach ($arrayValues as $key => $title) {
            $translatedArrayValues[$key] = $title;
        }
        return $translatedArrayValues;
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return \yii\db\ActiveRecord
     */
    public static function retrieveReportsQuery($className, $context_id){
        return Report::find()
                ->andWhere([
                    'classname' => $className,
                    'context_id' => $context_id
                ]);
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return array
     */
    public static function retrieveReports($className, $context_id){
        return self::retrieveReportsQuery($className, $context_id)
            ->asArray()
            ->all();
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return array
     */
    public static function retrieveUnreadReports($className, $context_id){
        return self::retrieveReportsQuery($className, $context_id)
            ->andWhere([
                'read_at' => null,
                'read_by' => 0
            ])
            ->asArray()
            ->all();
    }

    /**
     * @param string $className
     * @param integer $context_id
     * @return integer
     */
    public static function retrieveReportsCount($className, $context_id){
        return self::retrieveReportsQuery($className, $context_id)
            ->count();
    }

}
