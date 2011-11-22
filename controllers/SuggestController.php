<?php

class SuggestController extends Controller {

	public function actionUser() {
		$users = User::model()->findAll();
		$json = CJSON::encode(array('users' => $users));

		if (Yii::app()->request->getParam('callback')) {
		    $callback = Yii::app()->request->getParam('callback');
			$json = $callback . '('. $json . ')';
		}

		header('Cache-Control: no-store');
		header('Pragma: no-store');
		header("Content-type: application/json");
		echo $json;
		Yii::app()->end();
	}

}
