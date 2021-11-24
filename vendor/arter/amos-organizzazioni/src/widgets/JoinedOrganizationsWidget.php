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
 * @package    arter\amos\organizzazioni\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\widgets;

use arter\amos\core\forms\editors\m2mWidget\M2MWidget;
use arter\amos\core\helpers\Html;
use arter\amos\projectmanagement\models\Projects;
use arter\amos\projectmanagement\Module;
use yii\base\InvalidConfigException;
use yii\base\Widget;

/**
 * Class JoinedOrganizationsWidget
 * @package arter\amos\organizzazioni\widgets
 */
class JoinedOrganizationsWidget extends Widget
{
    /**
     * @var Projects $model
     */
    public $model = null;

    /**
     * (eg. ['PARTICIPANT'] - thw widget will show only member with role participant)
     * @var array Array of roles to show
     */
    public $showRoles = null;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (!$this->model) {
            throw new InvalidConfigException($this->throwErrorMessage('model'));
        }
    }

    protected function throwErrorMessage($field)
    {
        return Module::t('amosproject_management', 'Wrong widget configuration: missing field {field}', [
            'field' => $field
        ]);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $model = $this->model;
        $widget = M2MWidget::widget([
            'model' => $model,
            'modelId' => $model->id,
            'modelData' => $model->getJoinedOrganizations(),
            'overrideModelDataArr' => true,
            'forceListRender' => true,
            'createAssociaButtonsEnabled' => true,
            'disableCreateButton' => true,
            'btnAssociaLabel' => Module::t('amosproject_management', 'Invite organization'),
            'actionColumnsTemplate' => '{deleteRelation}',
            'deleteRelationTargetIdField' => 'id',
            'targetUrl' => '/organizzazioni/profilo/associate-organizations-to-project-m2m',
            'targetUrlParams' => [
                'viewM2MWidgetGenericSearch' => true
            ],
            'createNewTargetUrl' => '/admin/user-profile/create',
            'moduleClassName' => Module::className(),
            'targetUrlController' => 'projects',
            'deleteActionName' => 'delete-joined-organization-m2m',
            'postName' => 'Project',
            'postKey' => 'Organization',
            'permissions' => [
                'add' => 'PROJECT_MANAGER',
            ],
            'actionColumnsButtons' => [

            ],
            'itemsMittente' => [
                'name' => [
                    'attribute' => 'name',
                    'label' => Module::t('amosproject_management', 'Name'),
                    'headerOptions' => [
                        'id' => Module::t('amosproject_management', 'name'),
                    ],
                    'contentOptions' => [
                        'headers' => Module::t('amosproject_management', 'name'),
                    ]
                ],
                'indirizzo',
                [
                    'attribute' => 'organization',
                    'format' => 'raw',
                    'label' => Module::t('amosproject_management', 'Reference Organization'),
                    'value' => function ($model, $index, $dataColumn) {
                        $labelClass = 'hidden';
                        $buttonClass = '';
                        $refferenceOrganization = $this->model->organization;
                        if (isset($refferenceOrganization->id)) {
                            if ($refferenceOrganization->id == $model->id) {
                                $labelClass = '';
                                $buttonClass = 'hidden';
                            } else {
                                $labelClass = 'hidden';
                                $buttonClass = '';
                            }
                        }
                        return
                            Html::tag('span', Module::t('amosproject_management', 'Refference Organization'), [
                                'class' => 'refference-label ' . $labelClass,
                                'data-id' => $model->id
                            ]) .
                            Html::button(Module::t('amosproject_management', 'Set As Reference'), [
                                'class' => 'btn btn-primary refference-button ' . $buttonClass,
                                'data-id' => $model->id
                            ]);
                    }
                ],
            ],
        ]);

        return $widget;
    }
}
