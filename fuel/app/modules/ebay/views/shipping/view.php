<h2>Viewing <span class='muted'>#<?php echo $inventory->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $inventory->user_id; ?></p>
<p>
	<strong>Inventory id:</strong>
	<?php echo $inventory->inventory_id; ?></p>
<p>
	<strong>Product id:</strong>
	<?php echo $inventory->product_id; ?></p>
<p>
	<strong>Supply id:</strong>
	<?php echo $inventory->supply_id; ?></p>
<p>
	<strong>Product name:</strong>
	<?php echo $inventory->product_name; ?></p>
<p>
	<strong>Status:</strong>
	<?php echo $inventory->status; ?></p>
<p>
	<strong>Grade:</strong>
	<?php echo $inventory->grade; ?></p>
<p>
	<strong>Condition:</strong>
	<?php echo $inventory->condition; ?></p>
<p>
	<strong>Including:</strong>
	<?php echo $inventory->including; ?></p>
<p>
	<strong>Weight:</strong>
	<?php echo $inventory->weight; ?></p>
<p>
	<strong>Supply date:</strong>
	<?php echo $inventory->supply_date; ?></p>
<p>
	<strong>Comfirm date:</strong>
	<?php echo $inventory->comfirm_date; ?></p>
<p>
	<strong>Sale start date:</strong>
	<?php echo $inventory->sale_start_date; ?></p>
<p>
	<strong>Sold date:</strong>
	<?php echo $inventory->sold_date; ?></p>

<?php echo Html::anchor('ebay/inventory/edit/'.$inventory->id, 'Edit'); ?> |
<?php echo Html::anchor('ebay/inventory', 'Back'); ?>