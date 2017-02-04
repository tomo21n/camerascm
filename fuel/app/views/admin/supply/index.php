<h2>Listing Supplies</h2>
<br>
<?php if ($supplies): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Supply id</th>
			<th>Auction id</th>
			<th>Supply channel</th>
			<th>Supplier id</th>
			<th>Auction title</th>
			<th>Supply price</th>
			<th>Supply tax</th>
			<th>Supply shipping</th>
			<th>Supply cost</th>
			<th>Product id</th>
			<th>Condition</th>
			<th>Comment</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($supplies as $item): ?>		<tr>

			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->supply_id; ?></td>
			<td><?php echo $item->auction_id; ?></td>
			<td><?php echo $item->supply_channel; ?></td>
			<td><?php echo $item->supplier_id; ?></td>
			<td><?php echo $item->auction_title; ?></td>
			<td><?php echo $item->supply_price; ?></td>
			<td><?php echo $item->supply_tax; ?></td>
			<td><?php echo $item->supply_shipping; ?></td>
			<td><?php echo $item->supply_cost; ?></td>
			<td><?php echo $item->product_id; ?></td>
			<td><?php echo $item->condition; ?></td>
			<td><?php echo $item->comment; ?></td>
			<td>
				<?php echo Html::anchor('admin/supply/view/'.$item->id, 'View'); ?> |
				<?php echo Html::anchor('admin/supply/edit/'.$item->id, 'Edit'); ?> |
				<?php echo Html::anchor('admin/supply/delete/'.$item->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Supplies.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('admin/supply/create', 'Add new Supply', array('class' => 'btn btn-success')); ?>

</p>
