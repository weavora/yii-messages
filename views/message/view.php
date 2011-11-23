<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Message {From/To} {Subject}"),
	);
?>

<?php $isIncomeMessage = $viewedMessage->receiver_id == Yii::app()->user->getId() ?>

<?php $this->renderPartial('/message/_navigation') ?>

<h2><?php echo MessageModule::t('Message {From/To} {Subject} {Date} TBD'); ?></h2>

<?php if ($isIncomeMessage): ?>
	<h3 class="message-from"><?php echo $viewedMessage->getSenderName() ?></h3>
<?php else: ?>
	<h3 class="message-to"><?php echo $viewedMessage->getReceiverName() ?></h3>
<?php endif; ?>

<h4 class="message-subject"><?php echo CHtml::encode($viewedMessage->subject) ?></h4>
<div class="message-body">
	<?php echo CHtml::encode($viewedMessage->body) ?>
</div>

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
		<?php echo CHtml::submitButton(MessageModule::t($isIncomeMessage ? "Reply" : "Send Another One")); ?>
	</div>

	<?php $this->endWidget(); ?>
</div>
