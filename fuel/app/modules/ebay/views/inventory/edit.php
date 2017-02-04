<h2>Editing <span class='muted'>Inventory</span></h2>
<br>
<?php echo Html::anchor('ebay/inventory', 'Back'); ?></p>
<?php echo render('inventory/_form'); ?>
<p>
	<?php echo Html::anchor('ebay/inventory/view/'.$inventory->id, 'View'); ?> |
	<?php echo Html::anchor('ebay/inventory', 'Back'); ?></p>
