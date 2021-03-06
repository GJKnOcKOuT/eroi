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
 * @package    arter\amos\admin\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\models;

//use backend\modules\cwh\behaviors\CwhNetworkBehaviors;
//use backend\modules\eventi\models\query\EventiQuery;
//use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user_profile_titoli_studio".
 */
class UserProfileTitoliStudio extends \arter\amos\admin\models\base\UserProfileTitoliStudio
{
    //public $regola_pubblicazione;
    //public $destinatari;
    //public $validatori;

    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }

    /**
     * Scommentare le seguenti function(), gli attributi sopra  e gli "use"
     * nel caso il modulo necessiti di regole di pubblicazione e personalizzarle
     * a piacimento. E' necessario per poter utilizzare le regole di
     * pubblicazione creare la classe User Profile Titoli StudioQuery.php
     * che conterrà le query specifiche per gestire la pubblicazione
     * dei contenuti per differenti destinatari.
     * Nelle function() sotto facciamo il merge con le altre function()
     * eventualmente già presenti per il model
     */
    /*
    
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['regola_pubblicazione', 'destinatari', 'validatori'], 'safe'],
        ]);
    }
    
    public function attributeLabels()
    {
        return
            ArrayHelper::merge(
                parent::attributeLabels(),
                [
                    'tagValues' => '',
                    'regola_pubblicazione' => 'Pubblicata per',
                    'destinatari' => 'Per i condominii',
                ]);
    }
    
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'CwhNetworkBehaviors' => [
                'class' => CwhNetworkBehaviors::className(),
            ]
        ]);
    }
    
    public static function find()
    {
        $User Profile Titoli StudioQuery = new User Profile Titoli StudioQuery(get_called_class());
        $User Profile Titoli StudioQuery->andWhere('user Profile Titoli Studio.deleted_at IS NULL');
        return $User Profile Titoli StudioQuery;
    }   
    */

    /**
     * Restituisce il percorso del marker, da personalizzare a piacimento
     * @return string Il percorso del marker che sarà utilizzato nella mappa
     */
    public function getIconaMarker()
    {
        return null;
    }

    /**
     * Restituisce il colore della categoria
     */
    public function getColoreCategoria()
    {
        return NULL; //da personalizzare
    }

    /**
     * Restituisce il nome della categoria per la legenda
     */
    public function getNomeLegenda()
    {
        return NULL; //da personalizzare
    }

    /**
     * Funzione che crea gli eventi da visualizzare sulla mappa in caso di più eventi legati al singolo model
     * Andrà valorizzato il campo array a true nella configurazione della vista calendario nella index
     */
    public function getEvents()
    {
        return NULL; //da personalizzare
    }

    /**
     * Restituisce l'url per il calendario dell'attività
     */
    public function getUrlEvento()
    {
        return NULL; //da personalizzare magari con Yii::$app->urlManager->createUrl([]);    
    }

    /**
     * Restituisce il colore associato all'evento
     */
    public function getColoreEvento()
    {
        return NULL; //da personalizzare     
    }

    /**
     * Restituisce il titolo, possono essere anche più dati, associato all'evento
     */
    public function getTitoloEvento()
    {
        return NULL; //da personalizzare     
    }
}
