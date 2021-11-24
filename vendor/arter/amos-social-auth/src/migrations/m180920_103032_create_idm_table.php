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


use arter\amos\core\migration\AmosMigrationTableCreation;

/**
 * Class m180920_103032_create_idm_table
 */
class m180920_103032_create_idm_table extends AmosMigrationTableCreation
{
    /**
     * @inheritdoc
     */
    protected function setTableName()
    {
        $this->tableName = '{{%social_idm_user}}';
    }

    /**
     * @inheritdoc
     */
    protected function setTableFields()
    {
        $this->tableFields = [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->null()->comment('User ID'),
            'numeroMatricola' => $this->string(255)->notNull()->comment('Numero di Matricola'),
            'codiceFiscale' => $this->string(255)->null()->comment('Codice Fiscale'),
            'nome' => $this->string(255)->null()->comment('Nome'),
            'cognome' => $this->string(255)->null()->comment('Cognome'),
            'ssoDN' => $this->string(255)->null()->comment('ssoDN'),
            'tipoAutenticazione' => $this->string(255)->null()->comment('Tipo di Autenticazione'),
            'ssoUrlLogout' => $this->string(255)->null()->comment('Url di Logout SSO'),
            'responseBase64' => $this->string(255)->null()->comment('Risposta BASE64'),
            'emailAddress' => $this->string(255)->null()->comment('Indirizzo Email'),
            'livelloVerifica' => $this->string(255)->null()->comment('Livello di Verifica'),
            'nomeUtente' => $this->string(255)->null()->comment('Nome Utente'),
            'sesso' => $this->string(255)->null()->comment('Sesso'),
            'dataNascita' => $this->string(255)->null()->comment('Data di Nascita'),
            'luogoNascita' => $this->string(255)->null()->comment('Luogo di Nascita'),
            'provinciaNascita' => $this->string(255)->null()->comment('Provincia di Nascita'),
            'statoNascita' => $this->string(255)->null()->comment('Stato di Nascita'),
            'identificativoUtente' => $this->string(255)->null()->comment('Identificativo Utente'),
            'cellulare' => $this->string(255)->null()->comment('Cellulare'),
            'ragioneSociale' => $this->string(255)->null()->comment('Ragione Sociale'),
            'sedeLegale' => $this->string(255)->null()->comment('Sede Legale'),
            'partitaIVA' => $this->string(255)->null()->comment('Partita IVA'),
            'docIdentita' => $this->string(255)->null()->comment('Documento di Identita'),
            'scadDocIdentita' => $this->string(255)->null()->comment('Scadenza Documento'),
            'domicilioFisico' => $this->string(255)->null()->comment('Domicilio Fisico'),
            'domicilioDigitale' => $this->string(255)->null()->comment('Domicilio Digitale'),
            'origineDatiUtente' => $this->string(255)->null()->comment('Origina Dati'),
            'statoValidazioneProfiloUtente' => $this->string(255)->null()->comment('Stato di Validazione Profilo'),
            'idComuneRegistrazione' => $this->string(255)->null()->comment('ID Comune di Registrazione')
        ];
    }
}
