<h2>Editing Supply</h2>
<br>

<?php echo render('admin/supply/_form'); ?>
<p>
	<?php echo Html::anchor('admin/supply/view/'.$supply->id, 'View'); ?> |
	<?php echo Html::anchor('admin/supply', 'Back'); ?></p>
