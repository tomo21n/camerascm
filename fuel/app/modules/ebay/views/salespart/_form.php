<script src="//cdn.ckeditor.com/4.5.2/full/ckeditor.js"></script>
<link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<?php if (\Uri::segment(3) =='invtosales'): ?>
<?php echo Form::open(array('action' => 'ebay/salespart/create',"class"=>"form-horizontal")); ?>
<?php else: ?>
    <?php echo Form::open(array("class"=>"form-horizontal")); ?>
<?php endif ?>
	<fieldset>
        <div class="form-group">
			<?php echo Form::label('eBay Item Number', 'eBay_item_number', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
				<?php echo Form::input('eBay_item_number', Input::post('eBay_item_number', isset($salespart) ? $salespart->eBay_item_number : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'eBay_item_number')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('在庫ID', 'inventory_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('inventory_id', Input::post('inventory_id', isset($salespart) ? $salespart->inventory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'inventory_id')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('出品タイプ', 'selling_type', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('selling_type', Input::post('selling_type', isset($salespart) ? $salespart->selling_type : ''),\Ebay\Controller_SalesPart::$listing_type, array('class' => 'col-md-4 form-control', 'placeholder'=>'selling_type')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('出品期間', 'listing_duration', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('listing_duration', Input::post('listing_duration', isset($salespart) ? $salespart->listing_duration : ''), \Ebay\Controller_SalesPart::$listing_duration,array('class' => 'col-md-4 form-control', 'placeholder'=>'listing_duration')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('開始価格', 'start_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('start_price', Input::post('start_price', isset($salespart) ? $salespart->start_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'start_price')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="get_price">Get Price</button>
                </div>
                <div class="col-md-5">
                    <?php echo Form::label('', '', array('class' => 'col-md-4', 'id'=>'supply_price','placeholder'=>'supply_price')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('BestOffer', 'BestOffer', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-1">
                    <?php echo Form::checkbox('best_offer',true ,Input::post('', isset($salespart) ? $salespart->best_offer : false), array('class' => 'col-md-1 form-control', 'placeholder'=>'best_offer')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::label('BO自動承認', 'BestOffer', array('class'=>'control-label')); ?>
                    <?php echo Form::input('best_offer_auto_accept', Input::post('best_offer_auto_accept', isset($salespart) ? $salespart->best_offer_auto_accept : ''), array('class' => 'col-md-2 form-control', 'placeholder'=>'BestOfferAutoAcceptPrice')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::label('BO最低価格', 'BestOffer最低価格', array('class'=>'control-label')); ?>
                    <?php echo Form::input('best_offer_minimum', Input::post('best_offer_minimum', isset($salespart) ? $salespart->best_offer_minimum : ''), array('class' => 'col-md-2 form-control', 'placeholder'=>'MinimumBestOfferPrice')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('タイトル', 'title', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Form::input('title', Input::post('title', isset($salespart) ? $salespart->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'title','onkeyup="ShowLength(value);"')); ?>
                </div>
                <p id="inputlength"></p>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('内容', 'description', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php echo Form::textarea('description', Input::post('description', isset($salespart) ? $salespart->description : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'description')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('SKU', 'sku', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('sku', Input::post('sku', isset($salespart) ? $salespart->sku : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'sku')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('シリアルNo', 'serialno', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('serialno', Input::post('sku', isset($salespart) ? $salespart->serialno : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'serialno')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('カテゴリID', 'category_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('category_id', Input::post('category_id', isset($salespart) ? $salespart->category_id : ''), \Ebay\Controller_SalesPart::$sales_category,array('id'=>'category_id','class' => 'col-md-4 form-control', 'placeholder'=>'category_id')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('商品ID', 'product_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-1">
                    <?php echo Form::input('product_id', Input::post('product_id', isset($salespart) ? $salespart->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_id')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($salespart) ? $salespart->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_name')); ?>
                </div>
            </div>
        </div><div class="form-group">
            <?php echo Form::label('製品特徴ID', 'specific_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-1">
                    <?php echo Form::input('specific_id', Input::post('specific_id', isset($salespart) ? $salespart->specific_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'specific_id')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="get_specific">Get</button>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="specific" style="display: none">
            <div class="form-group">
                <?php echo Form::label('特徴詳細', 'specific_item', array('id'=>'specific_item_name','class'=>'col-md-2 control-label')); ?>
                <div class="row">
                    <div class="col-md-2">
                        <?php echo Form::input('specific_item_id[]','', array('id'=>'specific_item_id','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo Form::input('specific_item_value[]','', array('id'=>'specific_item_value','class' => 'col-md-4 form-control', 'placeholder'=>'specific_item')); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('コンディション', 'condition_description', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('condition_description', Input::post('condition_description', isset($salespart) ? $salespart->condition_description : ''), \Ebay\Controller_SalesPart::$condition_description,array('class' => 'col-md-4 form-control', 'placeholder'=>'condition_description')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('ストアカテゴリ', 'store_category_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('store_category_name', Input::post('store_category_name', isset($salespart) ? $salespart->store_category_name : ''), \Ebay\Controller_SalesPart::$store_category,array('class' => 'col-md-4 form-control', 'placeholder'=>'store_category_name')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('送料', 'shipping_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('shipping_id', Input::post('shipping_id', isset($salespart) ? $salespart->shipping_id : ''), \Ebay\Controller_Shipping::$shipping_list,array('class' => 'col-md-4 form-control', 'placeholder'=>'shipping_id')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="get_weight">Get Weight</button>
                </div>
                <div class="col-md-5">
                    <?php echo Form::label('', '', array('class' => 'col-md-4', 'id'=>'weight','placeholder'=>'weight')); ?>
                </div>
            </div>

        </div>

        <div class="form-group">
            <?php echo Form::label('出品開始日', 'start_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('start_date', Input::post('start_date', isset($salespart) ? $salespart->start_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'start_date')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('出品終了日', 'end_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('end_date', Input::post('end_date', isset($salespart) ? $salespart->end_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'end_date')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('付属品', 'including', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::textarea('including', Input::post('including', isset($salespart) ? $salespart->including : ''), array('rows'=>3,'cols'=>50,'class' => 'form-control', 'placeholder'=>'including')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('写真URL', 'picture_url', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Form::textarea('picture_url', Input::post('picture_url', isset($salespart) ? $salespart->picture_url : ''), array('rows'=>10,'cols'=>50,'class' => 'form-control', 'placeholder'=>'including')); ?>
                </div>
            </div>
        </div>

		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<div id="specific_clone"></div>
<?php echo Form::close(); ?>
<script>
//    CKEDITOR.config.toolbar = [
//        ['Source','Templates']
//        ,['Undo','Redo','-','SelectAll','RemoveFormat']
//        ,['Bold','Italic','Underline','Strike','-','Subscript','Superscript']
//        ,['NumberedList','BulletedList','-','Outdent','Indent']
//        ,['Format','FontSize']
//        ,['TextColor','BGColor']
//        ,['ShowBlocks']
//        ,['FontSize']
//        ,['Table','HorizontalRule']
//        ,['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock']
//    ];
    CKEDITOR.replace( 'form_description' );



    var $itemspecific_list = <?php echo json_encode(\Ebay\Controller_Itemspecific::$category_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

    $("select#category_id").change(function() {
        var $itemspecific = $itemspecific_list[$(this).val()];
        var inputText = $("div#specific").map(function (index, el) {
            if($itemspecific[index]){
                var $key = Object.keys($itemspecific[index])
                $(this).find("input#specific_item_id").val($key);
                $(this).find("input#specific_item_value").val("");
                $(this).find("input#specific_item_value").autocomplete({
                    source: $itemspecific[index][$key],
                    minLength: 0,
                    autoFocus:true
                });
                $(this).show();
            }else{
                $(this).find("input#specific_item_id").val("");
                $(this).find("input#specific_item_value").val("");
                $(this).hide();
            }
        });

    });

    <?php if(isset($itemspecific)): ?>
        var $itemspecific_load = <?php echo json_encode($itemspecific, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
    <?php endif; ?>

    $(document).ready(function(){
        var inputText = $("div#specific").map(function (index, el) {
            if($itemspecific_load[index]){
                var $key = Object.keys($itemspecific_load[index])
                $(this).find("input#specific_item_id").val($key);
                $(this).find("input#specific_item_value").val($itemspecific_load[index][$key]);
                $(this).show();
            }else{
                $(this).find("input#specific_item_id").val("");
                $(this).hide();
            }
        });
    });

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
                $("#supply_price").text('仕入：' + value.supply_price + '円');
            });
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    });
    $('#get_weight').click(function(){
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
                $("#weight").text('重量：' + value.weight + 'g');
            });
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    });

    $('#get_specific').click(function(){
        var $specific_id = $("#form_specific_id").val();
        $.ajax({
            url: "http://dev.world-viewing.com/ebay/orderrest/specificsearch.json",
            dataType: "json",
            cache: false,
            data: {
                specific_id: $specific_id
            }
        }).done(function(data, textStatus) {
            $.each(data.specific, function(index, value) {
                var inputText = $("div#specific").map(function (index, el) {
                    if($(this).find("input#specific_item_id").val() == value.name){
                        $(this).find("input#specific_item_value").val(value.value);
                    }
                });
            });
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    });

    function ShowLength( str ) {
        document.getElementById("inputlength").innerHTML = 80 - str.length + " Characters Left";
    }


</script>