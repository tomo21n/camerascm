<h2>Listing <span class='muted'>Inventories</span></h2>
<br>
<?php echo Form::open(array('action'=>'ebay/inventory/','class'=>'form-horizontal','method'=>'get')); ?>
<fieldset>
    <!-- ワード -->
    <div class="form-group">
        <?php echo Form::label('Word', 'word',array('class'=>'control-label col-md-2 col-xs-12')); ?>
        <div class="controls col-md-4 col-xs-12">
            <?php echo Form::input('word', Input::get('word'),array('class' => 'col-md-4 form-control')); ?>
        </div>
        <div class="controls col-md-2">
            <?php echo Form::select('status', Input::get('status'), \Ebay\Controller_Inventory::$status,array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>
        </div>
        <div class="controls col-md-2">
            <?php echo Form::select('order', Input::get('order'), \Ebay\Controller_Inventory::$order,array('class' => 'col-md-4 form-control', 'placeholder'=>'Order')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo Form::label('', '',array('class'=>'control-label col-md-2')); ?>
        <div class="controls col-md-4">
            <?php echo Form::submit('', '検索', array('class' => 'btn btn-primary ')); ?>
        </div>
        <div class="controls col-md-3">
            <?php echo Html::anchor('ebay/inventory/getMultiCurrentStatus','Refresh',  array('class' => 'btn btn-primary ')); ?>
        </div>
        <div class="controls col-md-3">
            <a data-toggle="modal" data-target="#Modal_summary" class="btn btn-primary">サマリ</a>'
        </div>
    </div>
</fieldset>
<?php echo Form::close(); ?>
<hr>
<?php if ($inventories): ?>
<!--
    外注依頼操作
-->
    <?php echo Form::open(array('action' => 'ebay/inventory/getEjtId', 'method' => 'POST',"id"=>"ejt_edit_form","class"=>"form-horizontal")); ?>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">外注番号取得</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('ID', 'detail_id', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <input name="id" id="detail_id" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('在庫ID', 'inventory_id', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <input name="inventory_id" id="detail_inventory_id" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-9">
                                    <input name="product_name" id="detail_product_name" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('フラグ', 'flug', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <?php echo Form::select('flug', '0', array('0'=>'写真撮影','1'=>'検品付'),array('id'=>'detail_flug','class' => 'col-md-4 form-control')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('メモ', 'memo', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-9">
                                    <input name="memo" id="detail_memo" class="col-md-6 form-control" placeholder="メモ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    <button type="submit" id="ejt_submit" class="btn btn-primary">GET</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <!--
    Relist
    -->
    <?php echo Form::open(array('action' => 'ebay/inventory/relist', 'method' => 'POST',"id"=>"relist_form","class"=>"form-horizontal")); ?>
    <div id="Modal_relist" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Relist</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('ID', 'detail_id', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <input name="id" id="relist_id" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('在庫ID', 'inventory_id', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <input name="inventory_id" id="relist_inventory_id" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('eBay ItemID', 'eBay_item_number', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <input name="eBay_item_number" id="relist_eBay_item_number" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-9">
                                    <input name="product_name" id="relist_product_name" class="col-md-6 form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('期間', 'listing_duration', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-4">
                                    <?php echo Form::select('listing_duration', '0', EBAY\Controller_SalesPart::$listing_duration,array('id'=>'relist_listing_duration','class' => 'col-md-4 form-control')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php echo Form::label('価格', 'price', array('class'=>'col-md-3 control-label')); ?>
                                <div class="col-md-3">
                                    <input name="price" id="relist_price" class="col-md-6 form-control" placeholder="Price">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="relist_submit" class="btn btn-primary">Relist</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <!--
    SalesHistory
    -->
    <div id="Modal_history" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">販売履歴</h4>
                </div>
                <div class="modal-body" id="sales_history">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    <button type="submit" id="ejt_submit" class="btn btn-primary">GET</button>
                </div>
            </div>
        </div>
    </div>
    <!--
    Supplylist
    -->
    <div id="Modal_supplylist" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Supplylist</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ﾀｲﾄﾙ</th>
                            <th>価格</th>
                        </tr>
                        </thead>
                        <tbody id="original_supply">
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>ﾀｲﾄﾙ</th>
                            <th>状態</th>
                            <th>供給</th>
                            <th>出品</th>
                        </tr>
                        </thead>
                        <tbody id="supply_list">
                        </tbody>
                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                    <button type="submit" id="ejt_submit" class="btn btn-primary">GET</button>
                </div>
            </div>
        </div>
    </div>

    <div id="Modal_summary" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">サマリ</h4>
                </div>
                <div class="modal-body" id="summary">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ｽﾃｰﾀｽ</th>
                        <th>数量</th>
                        <th>合計額</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($summary as $summrayitem): ?>
                       <tr>

                            <td><?php echo $summrayitem['status']; ?></td>
                            <td><?php echo $summrayitem['count_st']; ?></td>
                            <td><?php echo $summrayitem['total']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                   </tbody>
                </table>
                </div>
            </div>

        </div>
    </div>

    <?php echo Pagination::instance('pagination')->render();?>
    <table class="table table-striped">
	<thead>
		<tr>
			<th>SKU</th>
			<th>商品名</th>
			<th>ｽﾃｰﾀｽ</th>
			<th>ｸﾞﾚｰﾄﾞ</th>
            <th>出品開始日</th>
            <th>仕入</th>
            <th>出品(参)</th>
			<th>Price</th>
			<th>View</th>
			<th>Watch</th>
			<th>Status</th>
			<th class="col-md-1">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($inventories as $item): ?>
    <?php $getejtHtml = '<a data-toggle="modal" data-target="#myModal" id="ejt_edit" item_id="'.$item->id.'" product_name="'.$item->product_name.'" inventory_id="'.$item->inventory_id.'"><i class="glyphicon glyphicon-send icon-white"></i></a>';?>
    <?php $getrelistHtml = '<a data-toggle="modal" data-target="#Modal_relist" id="relist_edit" item_id="'.$item->id.'" product_name="'.$item->product_name.'" inventory_id="'.$item->inventory_id.'" price="'.$item->sale_price.'" listing_duration="'.$item->listing_duration.'" eBay_item_number="'.$item->eBay_item_number.'"><i class="glyphicon glyphicon-step-backward icon-white"></i></a>';?>
    <?php $getsaleshistHtml = '<a data-toggle="modal" data-target="#Modal_history" id="saleshist_edit" item_id="'.$item->id.'" product_name="'.$item->product_name.'" inventory_id="'.$item->inventory_id.'"><i class="glyphicon glyphicon-sort-by-attributes icon-white"></i></a>';?>
    <?php $getsupplylistHtml = '<a data-toggle="modal" data-target="#Modal_supplylist" id="supplysearch_edit" supply_id="'.$item->supply_id.'"><i class="glyphicon glyphicon-th-list icon-white"></i></a>';?>
    <tr>

			<td><?php echo $item->inventory_id; ?></td>
			<td><?php echo $item->product_name; ?></td>
			<td><?php echo $item->status; ?></td>
			<td><?php echo $item->grade; ?></td>
            <td><?php echo $item->sale_start_date; ?></td>
			<td><?php echo $item->supply_price; ?></td>
			<td><?php echo $item->reference_sale_price; ?></td>
			<td><?php echo $item->sale_price; ?></td>
			<td><?php echo $item->hit_count; ?></td>
			<td><?php echo $item->watch_count; ?></td>
			<td><?php echo $item->listing_status; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
                        <?php echo Html::anchor('ebay/salespart/invtosales/'.$item->id, '<i class="glyphicon glyphicon-share"></i>'); ?>
                        <?php //echo Html::anchor('ebay/inventory/view/'.$item->id, '<i class="glyphicon glyphicon-eye-open"></i>'); ?>
                        <?php echo Html::anchor('ebay/inventory/edit/'.$item->id, '<i class="glyphicon glyphicon-wrench"></i>'); ?>
                        <?php echo Html::anchor('ebay/inventory/delete/'.$item->id, '<i class="glyphicon glyphicon-trash icon-white"></i>', array('onclick' => "return confirm('Are you sure?')")); ?>					</div>
                        <?php echo Html::anchor('ebay/inventory/getCurrentStatus/'.$item->id, '<i class="glyphicon glyphicon-flash icon-white"></i>'); ?>
                        <?php echo ($item->ejt_id) ? '' : $getejtHtml  ; ?>
                        <?php echo ($item->listing_status == 'UnSold') ?  $getrelistHtml: ''  ; ?>
                        <?php echo $getsaleshistHtml ?>
                        <?php echo $getsupplylistHtml ?>
                        <?php echo ($item->listing_status == 'UnSold') ?  Html::anchor('ebay/salespart/edit/'.$item->salespart_id, '<i class="glyphicon glyphicon-share-alt"></i>'): ''  ; ?></div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Inventories.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('ebay/inventory/create', 'Add new Inventory', array('class' => 'btn btn-success')); ?>

</p>
<script>
    $('a#ejt_edit').click(function(){
        $("#detail_id").val('');
        $("#detail_inventory_id").val('');
        $("#detail_product_name").val('');
        $("#detail_id").val($(this).attr("item_id"));
        $("#detail_inventory_id").val($(this).attr("inventory_id"));
        $("#detail_product_name").val($(this).attr("product_name"));
     });
    $('a#relist_edit').click(function(){
        $("#relist_id").val('');
        $("#relist_inventory_id").val('');
        $("#relist_product_name").val('');
        $("#relist_price").val('');
        $("#relist_eBay_item_number").val('');
        $("#relist_id").val($(this).attr("item_id"));
        $("#relist_inventory_id").val($(this).attr("inventory_id"));
        $("#relist_product_name").val($(this).attr("product_name"));
        $("#relist_price").val($(this).attr("price"));
        $("#relist_eBay_item_number").val($(this).attr("eBay_item_number"));
        $("#relist_listing_duration").val($(this).attr("listing_duration"));
    });
    $('a#saleshist_edit').click(function(){
        var inventory_id = $(this).attr("inventory_id");
        $.ajax({
            url: "http://dev.world-viewing.com/ebay/orderrest/salesparthistsearch.json",
            dataType: "html",
            cache: false,
            data: {inventory_id : inventory_id }
        }).done(function(data, textStatus) {
            var obj = JSON.parse(data);
            var list = obj.salesparthist;
            $("#sales_history").html('');
            for(var i in list){
                //alert(list[i].start_date);
                $("#sales_history").append(list[i].start_date);
                $("#sales_history").append('〜');
                $("#sales_history").append(list[i].end_date);
                $("#sales_history").append('　　Price：');
                $("#sales_history").append(list[i].sale_price);
                $("#sales_history").append('   Hit:');
                $("#sales_history").append(list[i].hit_count);
                $("#sales_history").append(' Watch：');
                $("#sales_history").append(list[i].watch_count);
                $("#sales_history").append('　');
                $("#sales_history").append(list[i].relist);
                $("#sales_history").append('</br>');

            }

        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
        });
    });
    $('a#supplysearch_edit').click(function(){
        var supply_id = $(this).attr("supply_id");
        $.ajax({
            url: "http://dev.world-viewing.com/ebay/orderrest/supplysearch.json",
            dataType: "html",
            cache: false,
            data: {supply_id : supply_id }
        }).done(function(data, textStatus) {
            var obj = JSON.parse(data);
            var list = obj.supplylist;
            var original_supply = obj.original_supply;
            var supply_total_price = parseFloat(original_supply.supply_price) + parseFloat(original_supply.supply_shipping);
            $("#supply_list").html('');
            $("#original_supply").html('');
            $("#original_supply").append("<tr>");
            $("#original_supply").append("<td>" + original_supply.id + "</td>");
            $("#original_supply").append("<td><a href='http://aucview.aucfan.com/yahoo/" +original_supply.auction_id+ "' target='_blank'>" + original_supply.auction_title + "</a></td>");
            $("#original_supply").append("<td>¥" + supply_total_price.toLocaleString()+ "</td>");
            $("#original_supply").append("</tr>");
            for(var i in list){
                $("#supply_list").append("<tr>");
                $("#supply_list").append("<td>" + list[i].inventory_id + "</td>");
                $("#supply_list").append("<td>" + list[i].product_name + "</td>");
                $("#supply_list").append("<td>" + list[i].status + "</td>");
                $("#supply_list").append("<td>¥ " + parseFloat(list[i].supply_price).toLocaleString() + "</td>");
                $("#supply_list").append("<td>$ " + parseFloat(list[i].sale_price) + "</td>");
                $("#supply_list").append("</tr>");
            }

        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
        });
    });
    $('#relist_submit').submit(function () {
        $(this).find(':submit').attr('disabled', 'disabled');
    });
</script>
