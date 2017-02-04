<h2>New <span class='muted'>SupplytoInventory</span></h2>
<br>

<?php echo Asset::js(array(
    'intense.min.js'
)); ?>
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
                                <?php echo Form::input('id', Input::post('id', isset($inventory) ? $inventory->id : ''), array('class' => 'col-md-6 form-control', 'placeholder'=>'id','readonly')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo Form::label('在庫ID', 'inventory_id', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-4">
                                <?php echo Form::input('inventory_id', Input::post('id', isset($inventory) ? $inventory->inventory_id : ''), array('class' => 'col-md-6 form-control', 'placeholder'=>'inventory_id','readonly')); ?>
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
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<div class="col-md-7">
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('在庫ID', 'inventory_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('inventory_id', Input::post('inventory_id', isset($inventory) ? $inventory->inventory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Inventory id')); ?>
                </div>
                <?php echo Form::label('仕入', 'supply_id', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('supply_id', Input::post('supply_id', isset($inventory) ? $inventory->supply_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply id')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('仕入日', 'supply_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('supply_date', date("Y-m-d"), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply date')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('ステータス', 'status', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::select('status', '仕入済', \Ebay\Controller_Inventory::$status,array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>
                </div>
            </div>

        </div>

        <div class="form-group">
            <?php echo Form::label('商品', 'product_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="col-md-2">
                <?php echo Form::input('product_id', Input::post('product_id', isset($inventory) ? $inventory->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product id')); ?>
            </div>
            <?php echo Form::label('外注ID', 'ejt_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="col-md-2">
                <?php echo Form::input('ejt_id', Input::post('ejt_id', isset($inventory) ? $inventory->ejt_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'外注 id')); ?>
            </div>
            <?php echo '<a data-toggle="modal" data-target="#myModal" id="ejt_edit"><i class="glyphicon glyphicon-send icon-white"></i></a>';?>
        </div>
        <div class="form-group">
            <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-7">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($inventory) ? $inventory->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product name')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="search_detail">検索</button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('仕入価格', 'supply_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('supply_price', Input::post('supply_price', isset($inventory) ? $inventory->supply_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply Price')); ?>
                </div>
                <?php echo Form::label('出品価格(参)', 'status', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-3">
                    <?php echo Form::input('reference_sale_price', Input::post('reference_sale_price', isset($inventory) ? $inventory->reference_sale_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Sale Price')); ?>
                </div>
            </div>
        </div>
    </fieldset>
</div>
<div class="col-md-1">
    <button type="button" class="btn btn-primary" id="clear">クリア</button>
</div>
<div class="col-md-5">
    <table class="table table-bordered">
        <tbody id="detailtable">
        </tbody>
    </table>
</div>


<div class="form-group">
    <label class='control-label'>&nbsp;</label>
    <?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
</fieldset>
<?php echo Form::close(); ?>

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
                $('#form_reference_sale_price').val($("#out_lower_price-"+ product_id).val());
                break;
            case 2:
                $('#form_reference_sale_price').val($("#out_mean_price-"+ product_id).val());
                break;
            case 3:
                $('#form_reference_sale_price').val($("#out_upper_price-"+ product_id).val());
                break;
        };
    }

    //クリア
    $('#clear').click(function(){
        $('#detailtable').html('');
    });


    $(document).ready(function(){
        var form_including_en = $('#form_including_en').val();
        var form_appearance_en_1 = $('#form_appearance_en_1').val();
        var form_functional_en_1 = $('#form_functional_en_1').val();
        var form_optical_en_1 = $('#form_optical_en_1').val();
        $("input#including").each(function(i, elem) {
            if ( form_including_en.indexOf($(elem).val()) != -1) {
                $(elem).prop('checked', true);
            }
        });
        $("input#appearance").each(function(i, elem) {
            if ( form_appearance_en_1.indexOf($(elem).val()) != -1) {
                $(elem).prop('checked', true);
            }
        });
        $("input#functional").each(function(i, elem) {
            if ( form_functional_en_1.indexOf($(elem).val()) != -1) {
                $(elem).prop('checked', true);
            }
        });
        $("input#optical").each(function(i, elem) {
            if ( form_optical_en_1.indexOf($(elem).val()) != -1) {
                $(elem).prop('checked', true);
            }
        });
    });

    $('input#including').click(function(){
        var beforeform_en = $('#form_including_en').val();
        var beforeform_ja = $('#form_including_ja').val();
        var targetText_en = $(this).val();
        var targetText_ja = $(this).attr('name_ja');

        if($(this).prop('checked')){
            if ( beforeform_en.indexOf(targetText_en) == -1) {
                $('#form_including_en').val(beforeform_en + targetText_en + '\n');
                $('#form_including_ja').val(beforeform_ja + targetText_ja + '\n');
            }
        }else{
            var afterform_en = beforeform_en.replace(targetText_en +'\n','');
            var afterform_ja = beforeform_ja.replace(targetText_ja +'\n','');
            $('#form_including_en').val(afterform_en);
            $('#form_including_ja').val(afterform_ja);
        }
    });

    $('input#appearance').click(function(){
        var beforeform_en = $('#form_appearance_en_1').val();
        var beforeform_ja = $('#form_appearance_ja_1').val();
        var targetText_en = $(this).val();
        var targetText_ja = $(this).attr('name_ja');
        if($(this).prop('checked')){
            if ( beforeform_en.indexOf(targetText_en) == -1) {
                $('#form_appearance_en_1').val(beforeform_en + targetText_en + '\n');
                $('#form_appearance_ja_1').val(beforeform_ja + targetText_ja + '\n');
            }
        }else{
            var afterform_en = beforeform_en.replace(targetText_en +'\n','');
            var afterform_ja = beforeform_ja.replace(targetText_ja +'\n','');
            $('#form_appearance_en_1').val(afterform_en);
            $('#form_appearance_ja_1').val(afterform_ja);
        }
    });

    $('input#functional').click(function(){
        var beforeform_en = $('#form_functional_en_1').val();
        var beforeform_ja = $('#form_functional_ja_1').val();
        var targetText_en = $(this).val();
        var targetText_ja = $(this).attr('name_ja');
        if($(this).prop('checked')){
            if ( beforeform_en.indexOf(targetText_en) == -1) {
                $('#form_functional_en_1').val(beforeform_en + targetText_en + '\n');
                $('#form_functional_ja_1').val(beforeform_ja + targetText_ja + '\n');
            }
        }else{
            var afterform_en = beforeform_en.replace(targetText_en +'\n','');
            var afterform_ja = beforeform_ja.replace(targetText_ja +'\n','');
            $('#form_functional_en_1').val(afterform_en);
            $('#form_functional_ja_1').val(afterform_ja);
        }
    });

    $('input#optical').click(function(){
        var beforeform_en = $('#form_optical_en_1').val();
        var beforeform_ja = $('#form_optical_ja_1').val();
        var targetText_en = $(this).val();
        var targetText_ja = $(this).attr('name_ja');
        if($(this).prop('checked')){
            if ( beforeform_en.indexOf(targetText_en) == -1) {
                $('#form_optical_en_1').val(beforeform_en + targetText_en + '\n');
                $('#form_optical_ja_1').val(beforeform_ja + targetText_ja + '\n');
            }
        }else{
            var afterform_en = beforeform_en.replace(targetText_en +'\n','');
            var afterform_ja = beforeform_ja.replace(targetText_ja +'\n','');
            $('#form_optical_en_1').val(afterform_en);
            $('#form_optical_ja_1').val(afterform_ja);
        }
    });

    $('a#ejt_photo_get').click(function(){
        //alert($(this).attr("item_id"));
        $("#photoget_id").val('');
        $("#photoget_ejt_id").val('');
        $("#photoget_product_name").val('');
        $("#photoget_id").val($(this).attr("item_id"));
        $("#photoget_ejt_id").val($(this).attr("ejt_id"));
        $("#photoget_product_name").val($(this).attr("product_name"));
    });

    window.onload = function() {
        // Intensify all images with the 'intense' classname.
        var elements = document.querySelectorAll( '.intense' );
        Intense( elements );
    }

    $('a#ejt_edit').click(function(){
        $("#detail_product_name").val($("#form_product_name").val());
    });
</script>

<p><?php echo Html::anchor('ebay/inventory', 'Back'); ?></p>
