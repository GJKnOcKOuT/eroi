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
 * @package    arter\amos\admin\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\widgets\graphics;

use yii\helpers\Html;
use arter\amos\core\widget\WidgetGraphic;
use arter\amos\admin\AmosAdmin;
use arter\amos\admin\assets\ModuleAdminAsset;
use arter\amos\admin\models\Admin;
use arter\amos\admin\models\UserProfile;
use arter\amos\admin\models\search\UserProfileSearch;

/**
 * Class WidgetGraphicsUsers
 * @package arter\amos\admin\widgets\graphics
 */
class WidgetGraphicsUsers extends WidgetGraphic {
    /**
     * @var string $widgetTitle
     */
    public $widgetTitle = '';

    /**
     * @var string|array $linkReadAll
     */
    public $linkReadAll = '';

    /**
     * @var int $pageSize
     */
    public $pageSize = 6;

    /**
     * @var int $maxButtonCount
     */
    public $maxButtonCount = 5;
	
    /**
     * @var array $dataProviderViewWidgetConf
     */
	public $dataProviderViewWidgetConf = [];

    /**
     * @inheritdoc
     */
    public function init() {
        $this->widgetTitle = AmosAdmin::tHtml('amosadmin', 'Utenti');
        $this->linkReadAll = ['/admin'];

        parent::init();

        $this->setCode('UTENTI_GRAPHIC');
        $this->setLabel(AmosAdmin::tHtml('amosadmin', 'Utenti'));
        $this->setDescription(AmosAdmin::t('amosadmin', 'Lista utenti'));
    }

    /**
     * @inheritdoc
     */
    public function getHtml() {
        ModuleAdminAsset::register($this->getView());
		$usersList = $this->getDataProvider();
        $viewToRender = '@vendor/arter/amos-admin/src/widgets/graphics/views/users_list';

        return $this->render($viewToRender, [
			'widget' => $this,
			'searchButtons' => $this->getSearchButtons(),
			'maxButtonCount' => $this->maxButtonCount,
            'toRefreshSectionId' => 'widgetGraphicUsers',
			'dataProviderViewWidgetConf' => [
				'dataProvider' => $usersList,
				'currentView' => [
					'name' => 'icon'
				],
				'iconView' => [
					'itemView' => '_user',
					'options' => [
						'class' => 'list-items-wrapper'
					],
					'containerOptions' => [
						'class' => 'list-items'
					],
					'itemOptions' => [
						'class' => 'list-item'
					]
				]
			]
        ]);
    }

    /**
     * Returns the widget data provider.
     * @return \yii\data\ActiveDataProvider
     */
    protected function getDataProvider() {
		$userProfileSearch = new UserProfileSearch();
        return $userProfileSearch->searchOnceValidatedUsers([], $this->pageSize);
	}
	
	protected function getSearchButtons () {
		if(empty(\Yii::$app->params['serchCompaniesAndUsersBtns'])) {
			return null;
		}

		return [
			'users' =>	
				Html::a(AmosAdmin::t('amosadmin', 'Cerca utenti'), 
					[ '/admin/user-profile/index?enableSearch=1&UserProfileSearch%5B%5D='], [
						'class' => 'btn btn-navigation-primary btn-search-users',
						'title' => AmosAdmin::t('amosadmin', 'Ricerca utenti'),
						'role' 	=> 'button',
					]),
			'companies' => 
				Html::a(AmosAdmin::t('amosadmin', 'Cerca aziende'), 
					['/organizzazioni/profilo/index?enableSearch=1&ProfiloSearch%5B%5D='], [
						'class' => 'btn btn-navigation-primary btn-search-companies',
						'title' => AmosAdmin::t('amosadmin', 'Ricerca aziende'),
					])
		];
	}
}
