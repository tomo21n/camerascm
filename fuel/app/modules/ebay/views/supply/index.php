<h2>Listing Supplies</h2>
<br>
<?php if ($supplies): ?>
<?php echo Pagination::instance('pagination')->render();?>
    <?php echo Html::anchor('ebay/supply/create', 'Add new Supply', array('class' => 'btn btn-success')); ?>
    <table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>仕入日</th>
			<th>タイトル</th>
			<th>商品名</th>
			<th>価格(合計)</th>
			<th>販売価格(参考)</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($supplies as $item): ?>		<tr>

			<td><?php echo $item->id; ?></td>
			<td><?php echo $item->supply_date; ?><br><?php echo $item->status;?></td>
			<td><?php echo $item->auction_title; ?></td>
			<td><?php echo $item->product_name; ?></td>
			<td><?php echo $item->supply_price + $item->supply_tax + $item->supply_shipping + $item->supply_cost; ?></td>
			<td><?php echo $item->sale_price; ?></td>
			<td>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?php echo Html::anchor('ebay/inventory/supplytoinv/'.$item->id, '<i class="glyphicon glyphicon-share"></i>'); ?>
                        <?php echo Html::anchor('ebay/supply/view/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                        <?php echo Html::anchor('ebay/supply/edit/'.$item->id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                        <?php echo Html::anchor('ebay/supply/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
                </div>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Supplies.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/supply/create', 'Add new Supply', array('class' => 'btn btn-success')); ?>

</p>
