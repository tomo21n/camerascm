<h2>Listing <span class='muted'>Orders</span></h2>
<br>
<?php echo Form::open(array('action'=>'ebay/order/','class'=>'form-horizontal','method'=>'get')); ?>

<fieldset>
    <!-- ワード -->
    <div class="form-group">
        <?php echo Form::label('Word', 'word',array('class'=>'control-label col-md-2 col-xs-12')); ?>
        <div class="controls col-md-4 col-xs-12">
            <?php echo Form::input('word', Input::get('word'),array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Form::label('', '',array('class'=>'control-label col-md-2')); ?>
        <div class="controls col-md-4">
            <?php echo Form::submit('', '検索', array('class' => 'btn btn-primary ')); ?>
            <?php echo Html::anchor('ebay/order/getorders', 'Refresh', array('class' => 'btn btn-success')); ?>
        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>
<hr>
<?php if ($orders): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>商品名</th>
            <th>供給価格</th>
            <th>販売価格</th>
            <th>設定送料</th>
            <th>利益</th>
            <th>売上日</th>
            <th>発送日</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($orders as $item): ?>
    <?php $tooltiphtml = ""; ?>
    <?php $tooltiphtml = "<table>"; ?>
    <?php $tooltiphtml .="<tr><th>ｵｰﾀﾞID</th><td>". $item->order_id."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>購入者国</th><td> ".$item->buyer_country."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>購入者</th><td> ".$item->buyer_name."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>追跡番号</th><td> ".$item->tracking_number."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>ｺﾒﾝﾄ</th><td> ".$item->comment."</td></tr>" ?>
    <?php $tooltiphtml .= "</table>"; ?>
    <tr>
        <td  class="col-md-4"><a data-toggle="popover" class="pophide" id="popover<?php echo $item->order_id; ?>" data-html="true" title="<?php echo $item->sale_title ?>" data-content="<?php echo $tooltiphtml; ?>" data-placement="bottom" data-trigger="click"><?php echo $item->sale_title; ?></a></td>
        <td><?php echo $item->supply_price; ?></td>
        <td><?php echo $item->sale_price; ?></td>
        <td><?php echo $item->sale_shipping; ?></td>
        <td><?php echo $item->profit; ?></td>
        <td><?php echo $item->sale_date; ?></td>
        <td><?php echo !is_null($item->emslabel)?Html::anchor('emslabel/'.$item->user_id.'/'.$item->emslabel, '<i class="glyphicon glyphicon-file"></i>'):'' ?>
            <?php echo $item->shipping_date; ?></td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('ebay/order/view/'.$item->order_id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                    <?php echo Html::anchor('ebay/order/edit/'.$item->order_id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                    <?php echo Html::anchor('ebay/order/delete/'.$item->order_id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
            </div>

        </td>
    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Orders.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/order/create', 'Add new Order', array('class' => 'btn btn-success')); ?>

</p>
<script>
    $(function() {
        <?php foreach($orders as $item): ?>
        $("#popover<?php echo $item->order_id; ?>").popover();
        <?php endforeach; ?>
    });
    $(function() {

    });

    $('body').on('click', function (e) {
        $('.pophide').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
</script>