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
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace arter\amos\sondaggi\modules\v1\models;

/**
 * Description of TaskSondaggi
 *
 * @author stefano
 */
class TaskSondaggi extends \arter\amos\core\record\Record
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_sondaggi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['status'], 'integer'],
            [['command'], 'string', 'max' => 255],
            [['filename'], 'string', 'max' => 255],

            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by','updated_by','deleted_by'], 'safe']
        ];
    }
}