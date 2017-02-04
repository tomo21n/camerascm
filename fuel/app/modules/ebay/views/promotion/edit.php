<h2>Editing <span class='muted'>Promotion</span></h2>
<br>

<?php echo render('promotion/_form'); ?>
<p>
	<?php echo Html::anchor('ebay/promotion/view/'.$promotion->id, 'View'); ?> |
	<?php echo Html::anchor('ebay/promotion', 'Back'); ?></p>
