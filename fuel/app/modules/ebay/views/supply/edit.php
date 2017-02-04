<h2>Editing <span class='muted'>Supply</span></h2>
<br>

<?php echo render('supply/_form'); ?>
<p>
	<?php echo Html::anchor('ebay/supply/view/'.$supply->id, 'View'); ?> |
	<?php echo Html::anchor('ebay/supply', 'Back'); ?></p>
