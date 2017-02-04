<h2>Listing <span class='muted'>Itemspecific</span></h2>
<br>
<hr>
<?php if ($itemspecific): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>ID</th>
            <th>製品名</th>
            <th>名前</th>
            <th>値</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($itemspecific as $item): ?>

    <tr>
        <td><?php echo $item->specific_id; ?></td>
        <td><?php echo $item->product_name; ?></td>
        <td><?php echo $item->name; ?></td>
        <td><?php echo $item->value; ?></td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('ebay/itemspecific/view/'.$item->specific_id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                    <?php echo Html::anchor('ebay/itemspecific/edit/'.$item->specific_id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                    <?php echo Html::anchor('ebay/itemspecific/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
            </div>

        </td>
    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Itemspecific.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/itemspecific/create', 'Add new Specific', array('class' => 'btn btn-success')); ?>

</p>