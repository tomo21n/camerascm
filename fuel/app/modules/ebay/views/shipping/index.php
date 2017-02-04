<h2>Listing <span class='muted'>Shipping</span></h2>
<br>
<hr>
<?php if ($shipping): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>ID</th>
            <th>名前</th>
            <th>米 送料</th>
            <th>除外国</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($shipping as $item): ?>

    <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->shipping_name; ?></td>
        <td><?php echo $item->domestic_cost_1; ?></td>
        <td><?php echo $item->exclude_location; ?></td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('ebay/shipping/view/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                    <?php echo Html::anchor('ebay/shipping/edit/'.$item->id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                    <?php echo Html::anchor('ebay/shipping/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
            </div>

        </td>
    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Shippings.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/shipping/create', 'Add new Shipping', array('class' => 'btn btn-success')); ?>

</p>