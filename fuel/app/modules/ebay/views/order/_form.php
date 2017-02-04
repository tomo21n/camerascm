<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
        <div class="form-group">
			<?php echo Form::label('オーダID', 'order_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
				<?php echo Form::input('order_id', Input::post('order_id', isset($order) ? $order->order_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'order_id')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('タイトル', 'sale_title', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('sale_title', Input::post('sale_title', isset($order) ? $order->sale_title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'sale_title')); ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<?php echo Form::label('カテゴリ', 'item_pkg_category', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
				<?php echo Form::select('item_pkg_category', Input::post('item_pkg_category', isset($order) ? $order->item_pkg_category : ''),array('used camera lens'=>'used camera lens','used camera'=>'used camera','used camera accessory'=>'used camera accessory'), array('class' => 'col-md-4 form-control', 'placeholder'=>'item_pkg_category')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('在庫ID', 'order_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('inventory_id', Input::post('inventory_id', isset($order) ? $order->inventory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'inventory_id')); ?>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="get_price">Get Price</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('売上日', 'sale_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('sale_date', Input::post('sale_date', isset($order) ? $order->sale_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'sale_date')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('発送日', 'shipping_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('shipping_date', Input::post('shipping_date', isset($order) ? $order->shipping_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'shipping_date')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('発送種別', 'shipping_type', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('shipping_type',Input::post('shipping_type', isset($order) ? $order->shipping_type : ''), array('EMS'=>'EMS','ePacket'=>'ePacket'), array('class' => 'col-md-4 form-control', 'placeholder'=>'shipping_type')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('供給価格', 'supply_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('supply_price', Input::post('supply_price', isset($order) ? $order->supply_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'supply_price')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('販売価格', 'sale_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('sale_price', Input::post('sale_price', isset($order) ? $order->sale_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'sale_price')); ?>
                </div>
                <div class="col-md-1">
                    <?php echo Form::label('販売送料', 'sale_shipping', array('class'=>'control-label')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::input('sale_shipping', Input::post('sale_shipping', isset($order) ? $order->sale_shipping : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'sale_shipping')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('eBay手数料', 'ebay_transaction_fee', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('ebay_transaction_fee', Input::post('ebay_transaction_fee', isset($order) ? $order->ebay_transaction_fee : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'ebay_transaction_fee')); ?>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" id="calcurate_fee">Calcurate Fee</button>
                    <button type="button" class="btn btn-primary" id="yahoo_calcurate_fee">Yahoo Calcurate Fee</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('Paypal手数料', 'paypal_transaction_fee', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('paypal_transaction_fee', Input::post('paypal_transaction_fee', isset($order) ? $order->paypal_transaction_fee : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'paypal_transaction_fee')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('送料', 'shipping_cost', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('shipping_cost', Input::post('shipping_cost', isset($order) ? $order->shipping_cost : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'shipping_cost')); ?>
                    <?php echo Html::anchor('ebay/order/getEjtInfo?id='.$order->order_id.'&inventory_id='.$order->inventory_id, '実績送料取得'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('発送経費', 'shipping_expense', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('shipping_expense', Input::post('shipping_expense', isset($order) ? $order->shipping_expense : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'shipping_expense')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('その他経費', 'other_fee', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('other_fee', Input::post('other_fee', isset($order) ? $order->other_fee : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'other_fee')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('返金', 'return_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('return_price', Input::post('return_price', isset($order) ? $order->return_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'return_price')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('為替レート', 'exchange_rate', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('exchange_rate', Input::post('exchange_rate', isset($order) ? $order->exchange_rate : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'exchange_rate')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('概算利益', 'profit', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('profit', Input::post('profit', isset($order) ? $order->profit : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'profit')); ?>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="calcurate_profit">Calcurate Profit</button>
                </div>
            </div>
        </div>


        <div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
        <?php echo Form::close(); ?>
        <div class="form-group">
            <?php echo Form::open(array("action"=>"ebay/order/getemslabel", "method"=>"post","class"=>"form-horizontal")); ?>
            <?php echo Form::hidden('order_id', isset($order) ? $order->order_id : ''); ?>
            <?php echo Form::submit('submit', 'Get EMS Label', array('class' => 'btn btn-primary')); ?>
            <?php echo Form::close(); ?>
        </div>
        <div class="form-group">
            <?php echo Form::open(array("action"=>"ebay/order/completesale", "method"=>"post","class"=>"form-horizontal")); ?>
            <?php echo Form::hidden('order_id', isset($order) ? $order->order_id : ''); ?>
            <?php echo Form::submit('submit', 'CompleteSale', array('class' => 'btn btn-primary')); ?>
            <?php echo Form::close(); ?>
        </div>
	</fieldset>

<script>

    $('#get_price').click(function(){
        var $inventory_id = $("#form_inventory_id").val();
        $.ajax({
            url: "http://dev.world-viewing.com/ebay/orderrest/inventorysearch.json",
            dataType: "json",
            cache: false,
            data: {
                inventory_id: $inventory_id
            }
        }).done(function(data, textStatus) {
            $.each(data.inventory, function(index, value) {
                $("#form_supply_price").val(value.supply_price);
            });
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    });

    $('#calcurate_fee').click(function(){
        var $sale_price = $("#form_sale_price").val();
        var $sale_shipping = $("#form_sale_shipping").val();

        var $ebay_fee = Math.round((parseFloat($sale_price) + parseFloat($sale_shipping)) * 0.06 * 100 )/100;
        var $paypal_fee = Math.round(((parseFloat($sale_price) + parseFloat($sale_shipping)) * 0.034 + 0.3) * 100 )/100;

        $('#form_ebay_transaction_fee').val($ebay_fee);
        $('#form_paypal_transaction_fee').val($paypal_fee);
    });

    $('#yahoo_calcurate_fee').click(function(){
        var $sale_price = $("#form_sale_price").val();
        var $sale_shipping = $("#form_sale_shipping").val();

        var $yahoo_fee = Math.round((parseInt($sale_price) + parseInt($sale_shipping)) * 0.0864,0) ;

        $('#form_ebay_transaction_fee').val($yahoo_fee);
    });

    $('#calcurate_profit').click(function(){
        var $supply_price = parseFloat($("#form_supply_price").val());
        var $sale_price = parseFloat($("#form_sale_price").val());
        var $sale_shipping = parseFloat($("#form_sale_shipping").val());
        var $ebay_transaction_fee = parseFloat($("#form_ebay_transaction_fee").val());
        var $paypal_transaction_fee = parseFloat($("#form_paypal_transaction_fee").val());
        var $shipping_cost = parseFloat($("#form_shipping_cost").val());
        var $shipping_expense = parseFloat($("#form_shipping_expense").val());
        var $other_fee = parseFloat($("#form_other_fee").val());
        var $return_price = parseFloat($("#form_return_price").val());
        var $exchange_rate = parseFloat($("#form_exchange_rate").val());

        var $profit =Math.round(($sale_price + $sale_shipping - $ebay_transaction_fee -$paypal_transaction_fee - $return_price) * $exchange_rate)
            - $supply_price - $shipping_cost - $shipping_expense - $other_fee;

        $('#form_profit').val($profit);
    });


</script>
