<?php

class MessageModule extends CWebModule
{

	public $userModel = 'User';
	public $userModelRelation = null;
//	public $defaultController = 'Message';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'message.models.*',
			'message.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if (Yii::app()->user->isGuest) {
			if (Yii::app()->user->loginUrl) {
				$controller->redirect($controller->createUrl(reset(Yii::app()->user->loginUrl)));
			} else {
				$controller->redirect($controller->createUrl('/'));
			}
		} else if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		} else {
			return false;
		}
	}

	public static function t($str='',$params=array(),$dic='user') {
		return Yii::t("MessageModule.".$dic, $str, $params);
	}

}
