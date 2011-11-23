<ul class="messages-nav">
	<li><a href="<?php echo $this->createUrl('inbox/') ?>">inbox</a></li>
	<li><a href="<?php echo $this->createUrl('sent/sent') ?>">sent</a></li>
	<li><a href="<?php echo $this->createUrl('new/') ?>">compose</a></li>
</ul>

<?php if(Yii::app()->user->hasFlash('messageModule')): ?>
	<div class="success">
		<?php echo Yii::app()->user->getFlash('messageModule'); ?>
	</div>
<?php endif; ?>
