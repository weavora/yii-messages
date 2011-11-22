<?php

class ViewController extends Controller {

	public $defaultAction = 'view';

	public function actionView() {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$message = Message::model()->findByPk($messageId);
		$userId = Yii::app()->user->getId();

		if ($message->sender_id != $userId && $message->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}

		$this->render('/message/view', array('message' => $message));
	}

}
