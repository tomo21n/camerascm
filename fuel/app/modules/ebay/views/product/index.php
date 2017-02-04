<h2>Listing <span class='muted'>Products</span></h2>
<br>
<?php echo Form::open(array('action'=>'ebay/product/','class'=>'form-horizontal','method'=>'get')); ?>

<fieldset>
    <!-- ASINコード -->
    <div class="form-group">
        <?php echo Form::label('メーカ', 'maker',array('class'=>'control-label col-md-2 col-xs-12')); ?>
        <div class="controls col-md-2 col-xs-6">
            <?php echo Form::select('maker', Input::get('maker'),\Ebay\Controller_Product::$maker,array('class' => 'col-md-4 form-control')); ?>
        </div>
    </div>
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
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>
<hr>
<?php if ($products): ?>
<?php echo Pagination::instance('pagination')->render();?>
<table class="table table-striped">
	<thead>
		<tr>
            <th>Link</th>
            <th>商品名</th>
            <th>カテゴリ</th>
            <th colspan="3">価格(下/平/上)</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($products as $item): ?>
    <?php $tooltiphtml = ""; ?>
    <?php $tooltiphtml = "<table>"; ?>
    <?php //$tooltiphtml .="<tr><th colspan='5'>". $item->product_name."</th></tr>" ?>
    <?php $tooltiphtml .="<tr><th>ｶﾃｺﾞﾘ</th><td>". $item->category."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>ﾒｰｶ</th><td>". $item->maker."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>ﾓﾃﾞﾙ</th><td>". $item->model."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>ｵﾌﾟｼｮﾝ</th><td>". $item->option_1."</td><td>". $item->option_2."</td><td>". $item->option_3."</td><td>". $item->option_4."</td><td>". $item->option_5."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>売足</th><td>". $item->out_search_count."</td></tr>" ?>
    <?php $tooltiphtml .="<tr><th>備考</th><td colspan='5'>". $item->comment."</td></tr>" ?>
    <?php $tooltiphtml .= "</table>"; ?>

    <tr>
        <td><a data-toggle="popover" id="searchyahoo<?php echo $item->product_id; ?>" data-content="<div id='yahoolist<?php echo $item->product_id; ?>'></div>" data-placement="bottom" data-container="body">Y</a>
        <a data-toggle="popover" id="searchebay<?php echo $item->product_id; ?>" data-content="<div id='ebaylist<?php echo $item->product_id; ?>'></div>" data-placement="bottom" data-container="body">E</a></td>
        <td><a data-toggle="popover" class="pophide" id="popover<?php echo $item->product_id; ?>" data-html="true" title="<?php echo $item->product_name ?>" data-content="<?php echo $tooltiphtml; ?>" data-placement="bottom" data-trigger="click"><?php echo $item->product_name; ?></a></td>
        <td><?php echo $item->category; ?></td>
        <td><?php echo $item->in_upper_price; ?><br /><?php echo $item->out_upper_price; ?></td>
        <td><?php echo $item->in_mean_price; ?><br /><?php echo $item->out_mean_price; ?></td>
        <td><?php echo $item->in_lower_price; ?><br /><?php echo $item->out_lower_price; ?></td>
        <td>
            <div class="btn-toolbar">
                <div class="btn-group">
                    <?php echo Html::anchor('ebay/product/view/'.$item->product_id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                    <?php echo Html::anchor('ebay/product/edit/'.$item->product_id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                    <?php echo Html::anchor('ebay/product/delete/'.$item->product_id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
            </div>

        </td>
    </tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Products.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/product/create', 'Add new Product', array('class' => 'btn btn-success')); ?>

</p>
<script>
    $(function() {
        <?php foreach($products as $item): ?>
        $("#popover<?php echo $item->product_id; ?>").popover();
        //サイトリストを取得
        $("#searchyahoo<?php echo $item->product_id; ?>").popover({html: true})
        $("#searchyahoo<?php echo $item->product_id; ?>").click( function() {
            $('#yahoolist<?php echo $item->product_id; ?>').append('通信中...');
            $.ajax({
                type: "GET",
                url: "/parse/yahooclosedsearch/<?php echo $item->tag_jp; ?>",
                dataType: "text",
                success: function(res){
                    $('#yahoolist<?php echo $item->product_id; ?>').replaceWith(res);
                }
            });
        });
        $("#searchebay<?php echo $item->product_id; ?>").popover({html: true})
        $("#searchebay<?php echo $item->product_id; ?>").click( function() {
            $('#ebaylist<?php echo $item->product_id; ?>').append('通信中...');
            $.ajax({
                type: "GET",
                url: "/parse/ebayclosedsearch/<?php echo $item->tag_jp; ?>",
                dataType: "text",
                success: function(res){
                    $('#ebaylist<?php echo $item->product_id; ?>').replaceWith(res);
                }
            });
        });
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