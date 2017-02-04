<h2>Editing <span class='muted'>Salespart</span></h2>
<br>
<?php echo render('salespart/_form'); ?>
<p>
	<?php echo Html::anchor('ebay/salespart/view/'.$salespart->id, 'View'); ?> |
	<?php echo Html::anchor('ebay/salespart', 'Back'); ?></p>
