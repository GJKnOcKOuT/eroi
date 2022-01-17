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


namespace arter\amos\supercraft\models\base;

use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\ContentModel;
use arter\amos\core\record\Record;
use yii\helpers\ArrayHelper;

/**
 * Class SuperCraft
 *
 * This is the base-model class for table "SuperCraft".
 *
 * @property integer $id
 * @property string $title
 * @property string $synthesis
 * @property string $facilitator_text
 * @property string $facilitator_organization_text
 * @property string $users_text
 * @property string $tr_doc_link
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @package arter\amos\supercraft\models\base
 */
abstract class SuperCraft extends ContentModel
{

    /**
     * @var string
     */
    public $created_at_from;

    /**
     * @var string $begin_date_hour_to
     */
    public $created_at_to;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'super_craft';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'synthesis'], 'required'],
            [['synthesis', 'users_text', 'tr_doc_link'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['facilitator_text', 'facilitator_organization_text', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'created_at_from' => BaseAmosModule::t('amosbestpractice', 'Created at from'),
            'created_at_to' => BaseAmosModule::t('amosbestpractice', 'Created at to'),
            'id' => BaseAmosModule::t('amosbestpractice', 'ID'),
            'title' => BaseAmosModule::t('amosbestpractice', 'Title'),
            'synthesis' => BaseAmosModule::t('amosbestpractice', 'Synthesis'),
            'facilitator_text' => BaseAmosModule::t('amosbestpractice', 'Facilitator Text'),
            'facilitator_organization_text' => BaseAmosModule::t('amosbestpractice', 'Facilitator Organization Text'),
            'users_text' => BaseAmosModule::t('amosbestpractice', 'Users Text'),
            'tr_doc_link' => BaseAmosModule::t('amosbestpractice', '#tr_doc_link'),
            'status' => BaseAmosModule::t('amosbestpractice', 'Status'),
            'created_at' => BaseAmosModule::t('amosbestpractice', 'Created at'),
            'updated_at' => BaseAmosModule::t('amosbestpractice', 'Updated at'),
            'deleted_at' => BaseAmosModule::t('amosbestpractice', 'Deleted at'),
            'created_by' => BaseAmosModule::t('amosbestpractice', 'Created by'),
            'updated_by' => BaseAmosModule::t('amosbestpractice', 'Updated by'),
            'deleted_by' => BaseAmosModule::t('amosbestpractice', 'Deleted by'),
        ]);
    }
}
