<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Inbox"),
	);

?>
<?php $this->renderPartial('/message/_navigation') ?>
<?php if ($messagesAdapter->data): ?>

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>

	<table>
		<tr>
			<th>From</th>
			<th>Subject</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr>
				<td>
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getSenderName(); ?>
				</td>
				<td><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
			</tr>
		<?php endforeach ?>
	</table>

	<div class="row submit">
		<?php echo CHtml::submitButton(MessageModule::t("Delete Selected")); ?>
	</div>

<?php $this->endWidget(); ?>

	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
