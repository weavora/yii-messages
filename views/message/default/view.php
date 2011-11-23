<?php $this->pageTitle=Yii::app()->name . ' - ' . MessageModule::t("Compose Message"); ?>
<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<?php
	$this->breadcrumbs = array(
		MessageModule::t("Messages"),
		($isIncomeMessage ? MessageModule::t("Inbox") : MessageModule::t("Sent")) => ($isIncomeMessage ? 'inbox' : 'sent'),
		CHtml::encode($viewedMessage->subject),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'message-delete-form',
	'enableAjaxValidation'=>false,
	'action' => $this->createUrl('delete/', array('id' => $viewedMessage->id))
)); ?>
	<button class="btn danger"><?php echo MessageModule::t("Delete") ?></button>
<?php $this->endWidget(); ?>

<?php if ($isIncomeMessage): ?>
	<h2 class="message-from">From: <?php echo $viewedMessage->getSenderName() ?></h2>
<?php else: ?>
	<h2 class="message-to">To: <?php echo $viewedMessage->getReceiverName() ?></h2>
<?php endif; ?>

<h3 class="message-subject"><?php echo CHtml::encode($viewedMessage->subject) ?></h3>

<span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($viewedMessage->created_at)) ?></span>

<div class="message-body">
	<?php echo CHtml::encode($viewedMessage->body) ?>
</div>

<h2><?php echo MessageModule::t('Reply') ?></h2>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<?php echo $form->errorSummary($message); ?>

	<div class="row">
		<?php echo $form->hiddenField($message,'receiver_id'); ?>
		<?php echo $form->error($message,'receiver_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($message,'subject'); ?>
		<?php echo $form->textField($message,'subject'); ?>
		<?php echo $form->error($message,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($message,'body'); ?>
		<?php echo $form->textArea($message,'body'); ?>
		<?php echo $form->error($message,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Reply")); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
