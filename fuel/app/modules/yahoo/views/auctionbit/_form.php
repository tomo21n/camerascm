<!--
    Modalの中身
-->
<?php echo Form::open(array("id"=>"product_edit","class"=>"form-horizontal")); ?>
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">商品登録</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('商品ID', 'product_id', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-3">
                                <input name="product_id" id="detail_product_id" class="col-md-6 form-control" placeholder="新規" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-9">
                                <input name="product_name" id="detail_product_name" class="col-md-6 form-control" placeholder="商品名">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('カテゴリ', 'category', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-4">
                                <?php echo Form::select('category', '', \Ebay\Controller_Product::$category,array('id'=>'detail_category','class' => 'col-md-4 form-control', 'placeholder'=>'Category')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('メーカー', 'maker', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-4">
                                <?php echo Form::select('maker',  '', \Ebay\Controller_Product::$maker,array('id'=>'detail_maker','class' => 'col-md-4 form-control', 'placeholder'=>'Maker')); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('仕入相場', 'title', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-3">
                                <input name="in_lower_price" id="detail_in_lower_price" class="form-control" placeholder="¥ Excellent">
                            </div>
                            <div class="col-md-3">
                                <input name="in_mean_price" id="detail_in_mean_price" class="form-control" placeholder="¥ Excellent+">
                            </div>
                            <div class="col-md-3">
                                <input name="in_upper_price" id="detail_in_upper_price" class="form-control" placeholder="¥ NearMint">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('予想出品価格', 'out_price', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-3">
                                <input name="out_lower_price" id="detail_out_lower_price" class="form-control" placeholder="$ Excellent">
                            </div>
                            <div class="col-md-3">
                                <input name="out_mean_price" id="detail_out_mean_price" class="form-control" placeholder="$ Excellent+">
                            </div>
                            <div class="col-md-3">
                                <input name="out_upper_price" id="detail_out_upper_price" class="form-control" placeholder="$ NearMint">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                <button type="button" id="product_edit_submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>
<!-- /.modal -->

<div class="col-md-6">
    <?php echo Form::open(array("class"=>"form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('オークションID', 'auction_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('auction_id', Input::post('auction_id', isset($auctionbit) ? $auctionbit->auction_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'auction_id')); ?>
                </div>
                <div class="col-md-2">
                    <a href="#" id="search_auction" class="btn btn-primary">オークションID検索</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('オークションURL', 'auction_url', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-7">
                    <?php echo Form::input('auction_url', Input::post('auction_url', isset($auctionbit) ? $auctionbit->auction_url : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'auction_url')); ?>
                </div>
                <div class="col-md-2">
                    <a href="#" id="search_auction_url" class="btn btn-primary">URL検索</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('タイトル', 'auction_title', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php echo Form::input('auction_title', Input::post('auction_title', isset($auctionbit) ? $auctionbit->auction_title : ''), array('class' => 'form-control', 'placeholder'=>'auction_title', 'readonly')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('開始日時', 'start_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('start_date', Input::post('start_date', isset($auctionbit) ? $auctionbit->start_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'start_date', 'readonly')); ?>
                </div>
                <?php echo Form::label('終', 'end_date', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-4">
                    <?php echo Form::input('end_date', Input::post('end_date', isset($auctionbit) ? $auctionbit->end_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'end_date', 'readonly')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('現在価格', 'current_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('current_price','', array('class' => 'col-md-4 form-control', 'placeholder'=>'current_price', 'readonly')); ?>
                </div>
                <?php echo Form::label('即決価格', 'buyout_price', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-3">
                    <?php echo Form::input('buyout_price', Input::post('buyout_price', isset($auctionbit) ? $auctionbit->buyout_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'buyout_price', 'readonly')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('仕入価格', 'budget_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('budget_price', Input::post('budget_price', isset($auctionbit) ? $auctionbit->budget_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'budget_price')); ?>
                </div>
                <?php echo Form::label('入札予約', 'bitreservation', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-3">
                    <?php echo Form::select('bitreservation', Input::post('bitreservation', isset($auctionbit) ? $auctionbit->bitreservation : 'Reserve'), \Yahoo\Controller_AuctionBit::$bitstatus,array('class' => 'col-md-4 form-control')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('出品価格', 'sale_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('sale_price', Input::post('sale_price', isset($auctionbit) ? $auctionbit->sale_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'sale_price')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('商品ID', 'product_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('product_id', Input::post('product_id', isset($auctionbit) ? $auctionbit->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_id' ,'readonly')); ?>
                </div>
                <div class="col-md-1">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="product_edit_start">登録</a>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="clear">クリア</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($auctionbit) ? $auctionbit->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_name')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="search_detail">検索</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('コンディション', 'condition', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('condition', Input::post('condition', isset($auctionbit) ? $auctionbit->condition : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'condition')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('コメント', 'comment', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php echo Form::input('comment', Input::post('comment', isset($auctionbit) ? $auctionbit->comment : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'comment')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
        <?php echo Form::close(); ?>
    </fieldset>
</div>
<div class="col-md-6">
    <table class="table table-bordered">
        <tbody id="detailtable">

        </tbody>
    </table>
</div>
<script>
    $('#product_edit_start').click(function(){
        var $product_id = $("#form_product_id").val();
        if($product_id){
            $.ajax({
                url: "http://dev.world-viewing.com/ebay/productrest/productdetail.json",
                dataType: "json",
                cache: false,
                data: {
                    product_id: $product_id
                }
            }).done(function(data, textStatus) {
                $("#detail_product_id").val(data.product.product_id);
                $("#detail_product_name").val(data.product.product_name);
                $("#detail_category").val(data.product.category);
                $("#detail_maker").val(data.product.maker);
                $("#detail_in_lower_price").val(data.product.in_lower_price);
                $("#detail_in_mean_price").val(data.product.in_mean_price);
                $("#detail_in_upper_price").val(data.product.in_upper_price);
                $("#detail_out_lower_price").val(data.product.out_lower_price);
                $("#detail_out_mean_price").val(data.product.out_mean_price);
                $("#detail_out_upper_price").val(data.product.out_upper_price);

                $('#myModal').modal('show');
            }).fail(function(xhr, textStatus, errorThrown) {
                // エラー処理
                alert('取得エラー');
            });
        }
    });

    $('#product_edit_submit').click(function(){
        var $form = $("#product_edit");
        console.log($form.serialize());

        $.ajax({
            url: "http://dev.world-viewing.com/ebay/productrest/productedit.json",
            dataType: "json",
            cache: false,
            data: $form.serialize()
        }).done(function(data, textStatus) {
            $("#form_product_id").val(data.Result.product_id);
            $("#form_product_name").val(data.Result.product_name);
            alert('「' + data.Result.product_name + '」を登録しました');
            $('#myModal').modal('hide');
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    });

    $('#search_auction').click(function(){
        search_auction();
    });

    $('#search_auction_url').click(function(){
        $path = $("#form_auction_url").val().split( "/" );
        $("#form_auction_id").val($path[5]);
        search_auction();
    });

    function search_auction(){
        var $form = $("#form_auction_id").val();
        $.ajax({
            url: "http://dev.world-viewing.com/yahoo/Auctionrest/auctiondetail.json",
            dataType: "json",
            cache: false,
            data: {
                auction_id: $form
            }
        }).done(function(data, textStatus) {
            $("#form_auction_id").val(data.Result.AuctionID);
            $("#form_auction_url").val(data.Result.AuctionItemUrl);
            $("#form_auction_title").val(data.Result.Title);
            $("#form_current_price").val(parseInt(data.Result.Price));
            $("#form_buyout_price").val(parseInt(data.Result.Bidorbuy));
            $("#form_start_date").val(data.Result.StartTime);
            $("#form_end_date").val(data.Result.EndTime);
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
            alert('取得エラー');
        });
    }

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

