<h2>Editing <span class='muted'>Shipping</span></h2>
<br>

<?php echo render('shipping/_form'); ?>
<p>
	<?php echo Html::anchor('ebay/shipping/view/'.$shipping->id, 'View'); ?> |
	<?php echo Html::anchor('ebay/shipping', 'Back'); ?></p>
