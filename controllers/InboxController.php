<?php

class InboxController extends Controller
{
	public $defaultAction = 'inbox';

	public function actionInbox() {
		$messagesAdapter = Message::getAdapterForInbox(Yii::app()->user->getId());
		$pager = new CPagination($messagesAdapter->totalItemCount);
		$pager->pageSize = 10;
		$messagesAdapter->setPagination($pager);

		$this->render('/message/inbox', array(
			'messagesAdapter' => $messagesAdapter
		));
	}
}
