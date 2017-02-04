<h2>Listing <span class='muted'>AuctionBit</span></h2>
<br>
<?php echo Form::open(array('action'=>'yahoo/auctionbit/','class'=>'form-horizontal','method'=>'get')); ?>

<fieldset>
    <!-- ワード -->
    <div class="form-group">
        <?php echo Form::label('Word', 'word',array('class'=>'control-label col-md-2 col-xs-12')); ?>
        <div class="controls col-md-4 col-xs-12">
            <?php echo Form::input('word', Input::get('word'),array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="controls col-md-2">
            <?php echo Form::select('bitreservation', Input::get('bitreservation'), array(''=>'','Reserve'=>'Reserve','Registered'=>'Registered','NotRegistered'=>'NotRegistered','Closed'=>'Closed'),array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Form::label('', '',array('class'=>'control-label col-md-2')); ?>
        <div class="controls col-md-4">
            <?php echo Form::submit('', '検索', array('class' => 'btn btn-primary ')); ?>
        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>
<hr>
<p>
    <?php echo Html::anchor('yahoo/auctionbit/create', 'Add new Bit', array('class' => 'btn btn-success')); ?>
</p>
<?php if ($auctionbit): ?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>ヤフオクタイトル</th>
            <th>商品名</th>
            <th>予想販売価格</th>
            <th>仕入上限価格</th>
            <th>終了時刻</th>
            <th>予約</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($auctionbit as $item): ?>
    <tr>
        <td><?php echo $item->auction_title; ?></td>
        <td><?php echo $item->product_name; ?></td>
        <td><?php echo "$".$item->sale_price; ?></td>
        <td><?php echo "¥".$item->budget_price; ?></td>
        <td><?php echo $item->end_date; ?></td>
        <td><?php echo $item->bitreservation; ?></td>

        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('yahoo/auctionbit/edit/'.$item->id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                    <?php echo Html::anchor('yahoo/auctionbit/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
            </div>

        </td>
    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Bits.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('yahoo/auctionbit/create', 'Add new Bit', array('class' => 'btn btn-success')); ?>

</p>