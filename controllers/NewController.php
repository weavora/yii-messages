<?php

class NewController extends Controller
{

	public $defaultAction = 'compose';

	public function actionCompose() {
		$message = new Message();
		if (Yii::app()->request->getPost('Message')) {
		    $message->attributes = Yii::app()->request->getPost('Message');
			$message->sender_id = Yii::app()->user->getId();
			if ($message->save()) {
				Yii::app()->user->setFlash('success', MessageModule::t('Message has been sent'));
			    $this->redirect('inbox');
			}
		}
		$this->render('/message/compose', array('model' => $message));
	}
}
