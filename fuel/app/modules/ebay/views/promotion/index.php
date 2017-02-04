<h2>Listing Promotions</h2>
<br>
<?php if ($promotions): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>セール名</th>
			<th>タイプ</th>
			<th>値</th>
			<th>タイプ２</th>
			<th>期間</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($promotions as $item): ?>		<tr>

			<td><?php echo $item->promotion_id; ?><br></td>
			<td><?php echo $item->promotional_sale_name; ?></td>
			<td><?php echo $item->discount_type; ?></td>
			<td><?php echo $item->discount_value; ?></td>
			<td><?php echo $item->promotional_sale_type; ?></td>
			<td><?php echo $item->promotional_sale_starttime.' 〜 '.$item->promotional_sale_endtime ?></td>
			<td>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?php echo Html::anchor('ebay/inventory/promotiontoinv/'.$item->id, '<i class="glyphicon glyphicon-share"></i>'); ?>
                        <?php echo Html::anchor('ebay/promotion/view/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                        <?php echo Html::anchor('ebay/promotion/edit/'.$item->id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                        <?php echo Html::anchor('ebay/promotion/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
                </div>
			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Supplies.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/promotion/create', 'Add new Promotion', array('class' => 'btn btn-success')); ?>

</p>
