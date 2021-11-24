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
 * @package    arter\amos\events\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\widgets;

use yii\base\Widget;

/**
 * Class EventsPublishedByWidget
 * Shows the entities name publishing the content and the selected publication rule
 * @package arter\amos\events\widgets
 */
class EventsPublishedByWidget extends Widget
{
    /**
     * @var string $layout The layout view
     */
    public $layout = '@vendor/arter/amos-events/src/views/event-wizard/layouts/event_published_by_widget.php';

    /**
     * @var array $entities The list of entities publishing a specific content (news, topic, etc)
     */
    public $entities;

    /**
     * @var integer $publicationRule The id of the publication rule for the specific content
     */
    public $publicationRule;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $i = 0;
        $publishingEntities = '-';
        $recipients = '-';
        if (!is_null($this->entities) && (count($this->entities) > 0)) {
            $publishingEntities = '';
            $moduleCwh = \Yii::$app->getModule('cwh');
            foreach ($this->entities as $publishingEntity) {
                if (isset($moduleCwh)) {
                    $entity = \arter\amos\cwh\models\CwhNodi::findOne($publishingEntity);
                }
                
                if ($i > 0) {
                    $publishingEntities .= ', ';
                }
                
                if (!empty($entity)) {
                    $publishingEntities .= $entity->text;
                }
                
                $i++;
            }
        }
        
        if (!is_null($this->publicationRule)) {
            $pubblicationRule = \arter\amos\cwh\models\base\CwhRegolePubblicazione::findOne($this->publicationRule);
            $recipients = (!is_null($pubblicationRule) ? $pubblicationRule->nome : '-');
        }
        
        return $this->renderFile(
            $this->layout,
            [
                'publishingEntities' => $publishingEntities,
                'recipients' => $recipients
            ]
        );
    }
}
