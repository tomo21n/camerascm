<h2>Viewing #<?php echo $supply->id; ?></h2>

<p>
	<strong>User id:</strong>
	<?php echo $supply->user_id; ?></p>
<p>
	<strong>Supply id:</strong>
	<?php echo $supply->supply_id; ?></p>
<p>
	<strong>Auction id:</strong>
	<?php echo $supply->auction_id; ?></p>
<p>
	<strong>Supply channel:</strong>
	<?php echo $supply->supply_channel; ?></p>
<p>
	<strong>Supplier id:</strong>
	<?php echo $supply->supplier_id; ?></p>
<p>
	<strong>Auction title:</strong>
	<?php echo $supply->auction_title; ?></p>
<p>
	<strong>Supply price:</strong>
	<?php echo $supply->supply_price; ?></p>
<p>
	<strong>Supply tax:</strong>
	<?php echo $supply->supply_tax; ?></p>
<p>
	<strong>Supply shipping:</strong>
	<?php echo $supply->supply_shipping; ?></p>
<p>
	<strong>Supply cost:</strong>
	<?php echo $supply->supply_cost; ?></p>
<p>
	<strong>Product id:</strong>
	<?php echo $supply->product_id; ?></p>
<p>
	<strong>Condition:</strong>
	<?php echo $supply->condition; ?></p>
<p>
	<strong>Comment:</strong>
	<?php echo $supply->comment; ?></p>

<?php echo Html::anchor('admin/supply/edit/'.$supply->id, 'Edit'); ?> |
<?php echo Html::anchor('admin/supply', 'Back'); ?>