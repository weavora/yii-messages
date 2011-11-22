<?php

class ViewController extends Controller {

	public $defaultAction = 'view';

	public function actionView() {
		$messageId = (int)Yii::app()->request->getParam('message_id');
		$viewedMessage = Message::model()->findByPk($messageId);
		$userId = Yii::app()->user->getId();

		if ($viewedMessage->sender_id != $userId && $viewedMessage->receiver_id != $userId) {
		    throw new CHttpException(403, MessageModule::t('You can not view this message'));
		}
		$message = new Message();

		if ($viewedMessage->receiver_id == Yii::app()->user->getId()) {
		    $message->subject = 'Re:' . $viewedMessage->subject;
			$message->receiver_id = $viewedMessage->sender_id;
		} else {
			$message->sender_id = $viewedMessage->receiver_id;
		}

		if (Yii::app()->request->getPost('Message')) {
			$message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = Yii::app()->user->getId();
			if ($message->save()) {
				Yii::app()->user->setFlash('success', MessageModule::t('Message has been sent'));
			    if ($viewedMessage->receiver_id == Yii::app()->user->getId()) {
					$this->redirect($this->createUrl('inbox/'));
			    } else {
					$this->redirect($this->createUrl('sent/'));
				}
			}
		}

		$this->render('/message/view', array('viewedMessage' => $viewedMessage, 'message' => $message));
	}

}
