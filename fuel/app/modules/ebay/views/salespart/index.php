<h2>Listing <span class='muted'>Salespart</span></h2>
<br>
<hr>
<?php if ($salesparts): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>ID</th>
            <th>名前</th>
            <th>開始価格</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($salesparts as $item): ?>

    <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->title; ?></td>
        <td><?php echo $item->start_price; ?></td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('ebay/salespart/view/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                    <?php echo Html::anchor('ebay/salespart/edit/'.$item->id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                    <?php echo Html::anchor('ebay/salespart/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
            </div>

        </td>
    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Salespart.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/salespart/create', 'Add new Salespart', array('class' => 'btn btn-success')); ?>

</p>