<h2>Listing <span class='muted'>Netstoreinvent</span></h2>
<br>
<?php echo Form::open(array('action'=>'ebay/netstoreinvent/','class'=>'form-horizontal','method'=>'get')); ?>

<fieldset>
    <!-- ワード -->
    <div class="form-group">
        <?php echo Form::label('Word', 'word',array('class'=>'control-label col-md-2 col-xs-12')); ?>
        <div class="controls col-md-4 col-xs-12">
            <?php echo Form::input('word', Input::get('word'),array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="controls col-md-2">
            <?php echo Form::select('condition', Input::get('condition'), array(''=>'','B'=>'B','A'=>'A','A~AA'=>'A~AA','AA'=>'AA','AA~AAA'=>'AA~AAA','AAA'=>'AAA','新品'=>'新品'),array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo Form::label('', '',array('class'=>'control-label col-md-2')); ?>
        <div class="controls col-md-4">
            <?php echo Form::submit('', '検索', array('class' => 'btn btn-primary ')); ?>
            <?php echo Html::anchor('ebay/netstoreinvent/cameracollectioncheck', 'Refresh', array('class' => 'btn btn-success')); ?>
        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>
<hr>
<?php if ($netstoreinvent): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>メーカー</th>
            <th>製品名</th>
            <th>価格</th>
            <th>状態</th>
            <th>ステータス</th>
            <th>更新日</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($netstoreinvent as $item): ?>

    <tr>
        <td><?php echo $item->maker; ?></td>
        <td><?php echo Html::anchor($item->link, $item->product_name); ?></td>
        <td><?php echo $item->price; ?></td>
        <td><?php echo $item->condition; ?></td>
        <td><?php echo $item->status; ?></td>
        <td><?php echo $item->updated_at; ?></td>

    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Netstoreinvent.</p>

<?php endif; ?><p>

</p>