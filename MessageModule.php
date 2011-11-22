<?php

class MessageModule extends CWebModule
{

	public $userModel = 'User';
	public $userModelRelation = null;
	public $getNameMethod;
	public $getSuggestMethod;

	public $senderRelation;
	public $receiverRelation;

	public function init()
	{

		if (!$this->getNameMethod) {
			throw new Exception(MessageModule::t("Property MessageModule::getNameMethod not defined"));
		}

		if (!$this->getSuggestMethod) {
		    throw new Exception(MessageModule::t("Property MessageModule::getSuggest not defined"));
		}

		if (!class_exists($this->userModel)) {
		    throw new Exception(MessageModule::t("Class {userModel} not defined", array('{userModel}' => $this->userModel)));
		}

		if (!method_exists($this->userModel, $this->getNameMethod)) {
		    throw new Exception(MessageModule::t("Method {userModel}::{getNameMethod} not defined", array('{userModel}' => $this->userModel, '{getNameMethod}' => $this->getNameMethod)));
		}

		if (!is_callable(array($this->userModel, $this->getNameMethod), true)) {
		    throw new Exception(MessageModule::t("Method {userModel}::{getNameMethod} can not defined", array('{userModel}' => $this->userModel, '{getNameMethod}' => $this->getNameMethod)));
		}

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

	public static function t($str='',$params=array(),$dic='message') {
		return Yii::t("MessageModule.".$dic, $str, $params);
	}

}
