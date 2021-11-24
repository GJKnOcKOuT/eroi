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

namespace arter\expo;

use yii\base\Component;

class ExpoPush extends Component
{

    const EXPO_PUSH_ENDPOINT = 'https://exp.host/--/api/v2/push/send';

    
    private $_ch;
    
    /**
     * 
     * @param type $token
     * @param type $message
     * @return type
     */
    public function notify($token, $message)
    {
        $postData[] = $message + ['to' => $token];

        $ch = $this->prepareCurl();

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));

        $response = $this->executeCurl($ch);

        return $response;
    }

    /**
     * 
     * @return type
     */
    private function prepareCurl()
    {
        $this->_ch = $this->_ch ?? curl_init();

        $ch = $this->_ch;

        // Set opts
        curl_setopt($ch, CURLOPT_URL, self::EXPO_PUSH_ENDPOINT);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: application/json',
            'content-type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        return $ch;
    }

    /**
     * 
     * @param type $ch
     * @return type
     */
    private function executeCurl($ch)
    {
        $response = [
            'body' => curl_exec($ch),
            'status_code' => curl_getinfo($ch, CURLINFO_HTTP_CODE)
        ];

        return json_decode($response['body'], true)['data'];
    }
}

?>
