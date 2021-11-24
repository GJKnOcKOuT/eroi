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
 * @package    arter\amos\admin\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\rules;

use arter\amos\core\record\Record;
use arter\amos\core\rules\BasicContentRule;
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloSedi;
use arter\amos\organizzazioni\models\ProfiloSediUserMm;
use arter\amos\organizzazioni\models\ProfiloUserMm;
use arter\amos\organizzazioni\utility\OrganizzazioniUtility;

/**
 * Class ConfirmUserRequestRule
 * @package arter\amos\organizzazioni\rules
 */
class ConfirmUserRequestRule extends BasicContentRule
{
    public $name = 'confirmUserRequest';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var Record $model */
            $model = $params['model'];
            if (!$model->id) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['profiloId'])) {
                    $model = $this->instanceModel($model, $get['profiloId']);
                } elseif (isset($post['profiloId'])) {
                    $model = $this->instanceModel($model, $post['profiloId']);
                } elseif (isset($get['profiloSediId'])) {
                    $model = $this->instanceModel($model, $get['profiloSediId']);
                } elseif (isset($post['profiloSediId'])) {
                    $model = $this->instanceModel($model, $post['profiloSediId']);
                } elseif (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                }
            }
            return $this->ruleLogic($user, $item, $params, $model);
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        if (
            is_null($model) ||
            (
                (!($model instanceof Profilo)) &&
                (!($model instanceof ProfiloSedi)) &&
                (!($model instanceof ProfiloUserMm)) &&
                (!($model instanceof ProfiloSediUserMm))
            )
        ) {
            return false;
        }
        if (!($model instanceof Profilo)) {
            if (($model instanceof ProfiloSedi) || ($model instanceof ProfiloUserMm)) {
                $model = $model->profilo;
            } elseif ($model instanceof ProfiloSediUserMm) {
                $model = $model->profiloSedi->profilo;
            }
        }
        /** @var Profilo $model */
        $organizationReferees = OrganizzazioniUtility::getOrganizationReferees($model->id, true);
        $ok = false;
        if (!is_null($model->rappresentanteLegale) && in_array($model->rappresentanteLegale->user_id, $organizationReferees)) {
            $ok = true;
        } elseif (!is_null($model->referenteOperativo) && in_array($model->referenteOperativo->user_id, $organizationReferees)) {
            $ok = true;
        }
        return $ok;
    }
}
