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


namespace app\models;

use raoul2000\workflow\source\file\IWorkflowDefinitionProvider;

/**
 * This is the workflow definition. Metadata is used at each wizard step
 * to store model and view names.
 */
class Wizflow implements IWorkflowDefinitionProvider
{
    public function getDefinition()
    {
        return [
            'initialStatusId' => 'welcome',
            'status' => [
                'welcome' => [
                    'transition' => ['step1'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\WelcomeForm'
                        ],
                        'view' => 'step-welcome'
                    ]
                ],
                'step1' => [
                    'transition' => ['blue', 'green'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\Step1Form'
                        ],
                        'view' => 'step-1'
                    ]
                ],
                'blue' => [
                    'transition' => ['final'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\BlueForm'
                        ],
                        'view' => 'step-blue'
                    ]
                ],
                'green' => [
                    'transition' => ['final'],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\GreenForm'
                        ],
                        'view' => 'step-green'
                    ]
                ],
                'final' => [
                    'transition' => [],
                    'metadata' => [
                        'model' => [
                            'class' => '\app\models\FinalForm'
                        ],
                        'view' => 'step-final'
                    ]
                ]
            ]
        ];
    }
}
