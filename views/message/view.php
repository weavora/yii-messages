<?php $this->renderPartial('/message/_navigation') ?>
<h4><?php echo $viewedMessage->getSenderName() ?></h4>
<h4><?php echo CHtml::encode($viewedMessage->subject) ?></h4>
<div>
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

	<div class="row submit">
		<?php echo CHtml::submitButton(MessageModule::t("Send")); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
