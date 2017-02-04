<div class="col-md-6">
    <?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
        <div class="form-group">
            <?php echo Form::label('仕入日', 'supply_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('supply_date', Input::post('supply_date', isset($supply) ? $supply->supply_date : date('Y-m-d')), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply date')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('オークションID', 'auction_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('auction_id', Input::post('auction_id', isset($supply) ? $supply->auction_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Auction id')); ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<?php echo Form::label('チャネル', 'supply_channel', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('supply_channel', Input::post('supply_channel', isset($supply) ? $supply->supply_channel : 'YahooAuction'), \Ebay\Controller_Supply::$supply_channel,array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('出品者ID', 'supplier_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
				<?php echo Form::input('supplier_id', Input::post('supplier_id', isset($supply) ? $supply->supplier_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supplier id')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('タイトル', 'auction_title', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
				<?php echo Form::input('auction_title', Input::post('auction_title', isset($supply) ? $supply->auction_title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Auction title')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('落札金額', 'supply_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
    				<?php echo Form::input('supply_price', Input::post('supply_price', isset($supply) ? $supply->supply_price : ''), array('class' => 'form-control', 'placeholder'=>'Price')); ?>
                </div>
                <?php echo Form::label('税', 'supply_tax', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('supply_tax', Input::post('supply_tax', isset($supply) ? $supply->supply_tax : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Tax')); ?>
                </div>
                <?php echo Form::label('経', 'supply_cost', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('supply_cost', Input::post('supply_cost', isset($supply) ? $supply->supply_cost : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Cost')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
			<?php echo Form::label('送料', 'supply_shipping', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
		    		<?php echo Form::input('supply_shipping', Input::post('supply_shipping', isset($supply) ? $supply->supply_shipping : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Shipping')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::select('supply_shipping_payment_bank', Input::post('supply_shipping_payment_bank', isset($supply) ? $supply->supply_shipping_payment_bank : '発払'), \Ebay\Controller_Supply::$shipping_cost,array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('商品ID', 'product_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
				<?php echo Form::input('product_id', Input::post('product_id', isset($supply) ? $supply->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product id')); ?>
                </div>
            </div>

		</div>
        <div class="form-group">
            <?php echo Form::label('商品名', 'product_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($supply) ? $supply->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product Name')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="search_detail">検索</button>
                </div>
            </div>

        </div>
		<div class="form-group">
			<?php echo Form::label('状態', 'condition', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
				<?php echo Form::input('condition', Input::post('condition', isset($supply) ? $supply->condition : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Condition')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('(参考)販売価格', 'sale_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('sale_price', Input::post('sale_price', isset($supply) ? $supply->sale_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'SalePrice')); ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<?php echo Form::label('備考', 'comment', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
				<?php echo Form::input('comment', Input::post('comment', isset($supply) ? $supply->comment : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Comment')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
</div>
<div class="col-md-6">
    <table class="table table-bordered">
        <tbody id="detailtable">

        </tbody>
    </table>
</div>
<script>
    //商品名からProductを検索
    $('#search_detail').click(function(){
        var $form = $("#form_product_name").val();
        $.ajax({
            url: "http://dev.world-viewing.com/ebay/productrest/productsearch.json",
            dataType: "json",
            cache: false,
            data: {
                query: $form
            }
        }).done(function(data, textStatus) {
            $('#detailtable').html('');
            $.each(data.products, function(index, value) {
                var html = '<tr><td>' + value.product_name + '</td>';
                html += '    <td><table><tr><td><a href="#" onclick="setproduct(' + value.product_id + ',1);return false;"><i class="glyphicon glyphicon-chevron-left"></i></a></td>' +
                    '                       <td><a href="#" onclick="setproduct(' + value.product_id + ',2);return false;"><i class="glyphicon glyphicon-minus"></i></a></td>' +
                    '                       <td><a href="#" onclick="setproduct(' + value.product_id + ',3);return false;"><i class="glyphicon glyphicon-chevron-right"></i></a></td></tr>';
                html += '    <tr><td>E:¥'+ value.in_lower_price + '&nbsp</td><td>E+:¥'+ value.in_mean_price + '&nbsp</td><td>M:¥'+ value.in_upper_price + '</td></tr>';
                html += '    <tr><td>E:$'+ value.out_lower_price + '&nbsp</td><td>E+:$'+ value.out_mean_price + '&nbsp</td><td>M:$'+ value.out_upper_price + '</td></tr></table>';
                html += '</tr>';
                html += '<input type="hidden" name="product_id" id="product_id-' + value.product_id + '" value="' + value.product_id + '">';
                html += '<input type="hidden" name="product_name" id="product_name-' + value.product_id + '" value="' + value.product_name + '">';
                html += '<input type="hidden" name="in_lower_price" id="in_lower_price-' + value.product_id + '" value="' + value.in_lower_price + '">';
                html += '<input type="hidden" name="in_mean_price" id="in_mean_price-' + value.product_id + '" value="' + value.in_mean_price + '">';
                html += '<input type="hidden" name="in_upper_price" id="in_upper_price-' + value.product_id + '" value="' + value.in_upper_price + '">';
                html += '<input type="hidden" name="out_lower_price" id="out_lower_price-' + value.product_id + '" value="' + value.out_lower_price + '">';
                html += '<input type="hidden" name="out_mean_price" id="out_mean_price-' + value.product_id + '" value="' + value.out_mean_price + '">';
                html += '<input type="hidden" name="out_upper_price" id="out_upper_price-' + value.product_id + '" value="' + value.out_upper_price + '">';
                $('#detailtable').append(html);

            });

        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    });

    //Productから検索した商品ID、商品名をセット
    function setproduct(product_id,condition){
        $('#form_product_id').val(product_id);
        $('#form_product_name').val($("#product_name-"+ product_id).val());
        switch (condition) {
            case 1:
                $('#form_budget_price').val($("#in_lower_price-"+ product_id).val());
                $('#form_sale_price').val($("#out_lower_price-"+ product_id).val());
                $('#form_condition').val("Excellent");
                break;
            case 2:
                $('#form_budget_price').val($("#in_mean_price-"+ product_id).val());
                $('#form_sale_price').val($("#out_mean_price-"+ product_id).val());
                $('#form_condition').val("Excellent+");
                break;
            case 3:
                $('#form_budget_price').val($("#in_upper_price-"+ product_id).val());
                $('#form_sale_price').val($("#out_upper_price-"+ product_id).val());
                $('#form_condition').val("NearMint");
                break;
        };
    }

    //クリア
    $('#clear').click(function(){
        $("#form_auction_id").val("");
        $("#form_auction_title").val("");
        $("#form_current_price").val("");
        $("#form_buyout_price").val("");
        $("#form_start_date").val("");
        $("#form_end_date").val("");

        $('#form_product_id').val("");
        $('#form_product_name').val("");
        $('#form_budget_price').val("");
        $('#form_sale_price').val("");
        $('#form_condition').val("");
    });
</script>