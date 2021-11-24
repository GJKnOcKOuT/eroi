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
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */

namespace arter\amos\audit;

use Yii;
use yii\log\Target;

/**
 * LogTarget
 * @package arter\amos\audit
 */
class LogTarget extends Target
{
    /**
     * @var Audit
     */
    public $module;

    /**
     * @param Audit $module
     * @param array $config
     */
    public function __construct($module, $config = [])
    {
        parent::__construct($config);
        $this->module = $module;
    }

    /**
     *
     */
    public function export()
    {
        if (!\Yii::$app)
            // Things like this can happen in tests etc, but it is too late for us to do anything about that.
            return;

        $module = $this->module;
        if (!$module->entry || empty($module->panels))
            return;

        $entry = $module->entry;

        $records = [];
        foreach ($module->panels as $id => $panel) {
            $records[$id] = $panel->save();
        }
        $records = array_filter($records);

        if (!empty($records)) {
            if ($module->batchSave)
                $entry->addBatchData($records, false);
            else {
                foreach ($records as $type => $record)
                    $entry->addData($type, $record, false);
            }
        }
        $this->messages = [];
    }

    /**
     * @param array $messages
     * @param bool  $final
     */
    public function collect($messages, $final)
    {
        $this->messages = array_merge(
            $this->messages, 
            static::filterMessages($messages, $this->getLevels(), $this->categories, $this->except)
        );
        
        if ($final) {
            $this->export();
        }
    }

}
