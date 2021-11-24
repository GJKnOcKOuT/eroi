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
 * @package    arter\amos\ticket\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\models\base;

use arter\amos\ticket\AmosTicket;

/**
 * This is the base-model class for table "ticket_categorie_users_mm".
 *
 * @property integer $id
 * @property integer $ticket_categoria_id
 * @property integer $user_profile_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\admin\models\ $user
 * @property \arter\amos\ticket\models\TicketCategorie $ticketCategoria
 */
class TicketCategorieUsersMm extends \arter\amos\core\record\Record
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ticket_categorie_users_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_categoria_id', 'user_profile_id'], 'required'],
            [['ticket_categoria_id', 'user_profile_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['user_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\admin\models\UserProfile::className(), 'targetAttribute' => ['user_profile_id' => 'id']],
            [['ticket_categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketCategorie::className(), 'targetAttribute' => ['ticket_categoria_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosTicket::t('amosticket', 'Id'),
            'ticket_categoria_id' => AmosTicket::t('amosticket', 'Categoria Id'),
            'user_profile_id' => AmosTicket::t('amosticket', 'User ID'),
            'created_at' => AmosTicket::t('amosticket', 'Creato il'),
            'updated_at' => AmosTicket::t('amosticket', 'Aggiornato il'),
            'deleted_at' => AmosTicket::t('amosticket', 'Cancellato il'),
            'created_by' => AmosTicket::t('amosticket', 'Creato da'),
            'updated_by' => AmosTicket::t('amosticket', 'Aggiornato da'),
            'deleted_by' => AmosTicket::t('amosticket', 'Cancellato da'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(\arter\amos\admin\models\UserProfile::className(), ['id' => 'user_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicketCategoria()
    {
        return $this->hasOne(\arter\amos\ticket\models\TicketCategorie::className(), ['id' => 'ticket_categoria_id']);
    }
}
