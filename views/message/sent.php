<?php $this->renderPartial('/message/_navigation') ?>
<?php if ($messagesAdapter->data): ?>
	<table>
		<tr>
			<th>To</th>
			<th>Subject</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $message): ?>
			<tr>
				<td><?php echo $message->receiver_id ?></td>
				<td><?php echo $message->subject ?></td>
			</tr>
		<?php endforeach ?>
	</table>
	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
