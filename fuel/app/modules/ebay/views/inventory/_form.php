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
<!--
    画面からのアップロード操作
-->
<?php echo Form::open(array('action' => 'ebay/inventory/uploadphoto', 'method' => 'POST',"id"=>"upload_form","class"=>"form-horizontal","enctype"=>"multipart/form-data")); ?>
<div id="UploadModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">写真アップロード</h4>
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
                            <?php echo Form::label('ファイル', 'inventory_id', array('class'=>'col-md-3 control-label')); ?>
                            <div class="col-md-8">
                                <input type="file" name="uploadFile[]" multiple="multiple" class="form-control" id="selectedFile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                <button type="submit" id="ejt_submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>
<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<div class="col-md-7">
	<fieldset>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2 control-label"><strong>Picture</strong></br>
                    <?php echo '<a data-toggle="modal" data-target="#UploadModal" id="uploadphoto"><i class="glyphicon glyphicon-send icon-white"></i></a>';?>
                    <?php echo Html::anchor('ebay/inventory/getEjtphoto?id='.$inventory->id.'&ejt_id='.$inventory->ejt_id, '写真取得'); ?><br />
                    <?php echo Html::anchor('ebay/inventory/getEjtInfo?id='.$inventory->id.'&ejt_id='.$inventory->ejt_id, '重量取得'); ?>
                </div>
                <div class="col-md-10 control-label" style="text-align: left">
                    <?php $picture_urls = @explode("\n", $inventory->picture_url); ?>
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <?php for ($count = 0; $count < count($picture_urls); $count++): ?>
                                <?php if($count == 6) echo "</tr><tr>"; ?>
                                <td class="col-md-1"><?php echo @Html::img($picture_urls[$count],array( "class" =>"img-thumbnail intense" )); ?></td>
                            <?php endfor;?>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <?php echo Form::hidden('picture_url', $inventory->picture_url); ?>
            </div>
        </div>
		<div class="form-group">
			<?php echo Form::label('在庫ID', 'inventory_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
				<?php echo Form::input('inventory_id', Input::post('inventory_id', isset($inventory) ? $inventory->inventory_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Inventory id')); ?>
                </div>
                <?php echo Form::label('商品', 'product_id', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('product_id', Input::post('product_id', isset($inventory) ? $inventory->product_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product id')); ?>
                </div>
                <?php echo Form::label('仕入', 'supply_id', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('supply_id', Input::post('supply_id', isset($inventory) ? $inventory->supply_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply id')); ?>
                </div>
            </div>
		</div>
        <div class="form-group">
            <?php echo Form::label('eBayItemID', 'eBay_item_number', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('eBay_item_number', Input::post('eBay_item_number', isset($inventory) ? $inventory->eBay_item_number : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'eBay_item_number')); ?>
                </div>
                <?php echo Form::label('出品', '出品', array('class'=>'col-md-1 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('salespart_id', Input::post('salespart_id', isset($inventory) ? $inventory->salespart_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'salespart_id')); ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
				<?php echo Form::input('product_name', Input::post('product_name', isset($inventory) ? $inventory->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Product name')); ?>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-primary" id="search_detail">検索</button>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('ステータス', 'status', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
				<?php echo Form::select('status', Input::post('status', isset($inventory) ? $inventory->status : ''), \Ebay\Controller_Inventory::$status,array('class' => 'col-md-4 form-control', 'placeholder'=>'Status')); ?>
                </div>
                <?php echo Form::label('外注ID', 'ejt_id', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-2">
                    <?php echo Form::input('ejt_id', Input::post('ejt_id', isset($inventory) ? $inventory->ejt_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'外注 id')); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::select('ejt_check', Input::post('ejt_check', isset($inventory) ? $inventory->ejt_check : ''),array(''=>'検品依頼無','外注検品'=>'外注検品'), array('class' => 'col-md-4 form-control', 'placeholder'=>'外注')); ?>
                </div>
                <?php echo '<a data-toggle="modal" data-target="#myModal" id="ejt_edit"><i class="glyphicon glyphicon-send icon-white"></i></a>';?>

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
		<div class="form-group">
			<?php echo Form::label('仕入日', 'supply_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
				<?php echo Form::input('supply_date', Input::post('supply_date', isset($inventory) ? $inventory->supply_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Supply date')); ?>
                </div>
                <?php echo Form::label('確認日', 'comfirm_date', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-3">
                    <?php echo Form::input('comfirm_date', Input::post('comfirm_date', isset($inventory) ? $inventory->comfirm_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Comfirm date')); ?>
                </div>
            </div>
		</div>
		<div class="form-group">
			<?php echo Form::label('出品開始日', 'sale_start_date', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
				<?php echo Form::input('sale_start_date', Input::post('sale_start_date', isset($inventory) ? $inventory->sale_start_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Sale start date')); ?>
                </div>
                <?php echo Form::label('売上日', 'sold_date', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-3">
                    <?php echo Form::input('sold_date', Input::post('sold_date', isset($inventory) ? $inventory->sold_date : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Sold date')); ?>
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
<div class="col-md-12">
<fieldset>
        <hr>
        <div class="form-group">
            <?php echo Form::label('グレード', 'grade', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('grade', Input::post('grade', isset($inventory) ? $inventory->grade : ''), \Ebay\Controller_Inventory::$grade,array('class' => 'col-md-4 form-control', 'placeholder'=>'Grade')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('メーカー', 'maker', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::select('maker', Input::post('maker', isset($inventory) ? $inventory->maker : ''), \Ebay\Controller_Product::$maker,array('class' => 'col-md-4 form-control', 'placeholder'=>'Maker')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('シリアルNo', 'serialno', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('serialno', Input::post('serialno', isset($inventory) ? $inventory->serialno : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Serial No')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('重量', 'weight', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::input('weight', Input::post('weight', isset($inventory) ? $inventory->weight : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Weight')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('付属品', 'including', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php foreach(\Ebay\Controller_Inventory::$including as $includingkey => $includingvalue ): ?>
                        <div class="col-md-3">
                            <?php echo Form::checkbox('including', $includingkey,'',array('id'=>'including','name_ja'=>$includingvalue)); ?>
                            <?php echo Form::label($includingvalue, $includingkey); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('', 'including', array('class'=>'col-md-2 control-label')); ?>

            <div class="col-md-4">
                <?php echo Form::textarea('including_ja', Input::post('including_ja', isset($inventory) ? $inventory->including_ja : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'functional')); ?>
            </div>
            <div class="col-md-4">
                <?php echo Form::textarea('including_en', Input::post('including_en', isset($inventory) ? $inventory->including_en : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'functional')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('------------------　　外観　　-------------------', 'Optical', array('class'=>'col-md-7 control-label')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('写真任せ', 'all', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('写真を参照して下さい','Please check on the photos for detailed condition of the product.', '',array('id'=>'appearance','name_ja'=>'写真を参照して下さい')); ?>
                    <?php echo Form::label('写真を参照して下さい', 'Please check on the photos for detailed condition of the product. '); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('全体', 'all', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('状態は完璧です','Condition looks perfect.', '',array('id'=>'appearance','name_ja'=>'状態は完璧です')); ?>
                    <?php echo Form::label('状態は完璧です', 'Condition looks perfect.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('全体的にキレイ','Totally Clean.', '',array('id'=>'appearance','name_ja'=>'全体的に綺麗です')); ?>
                    <?php echo Form::label('全体的にキレイ', 'Totally Clean.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('使用感があります','There is usually abrasion by the use. ', '',array('id'=>'appearance','name_ja'=>'使用感があります')); ?>
                    <?php echo Form::label('使用感があります', 'There is usually abrasion by the use.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('傷', 'scratches', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('傷なし','Body has no scratches.', '',array('id'=>'appearance','name_ja'=>'傷はありません')); ?>
                    <?php echo Form::label('傷なし', 'Body has no scratches.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('小スレ有','Body has tiny scratches.', '',array('id'=>'appearance','name_ja'=>'小さなスレあります')); ?>
                    <?php echo Form::label('小スレ有', 'Body has tiny scratches.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('大スレ有','Body has scratches.', '',array('id'=>'appearance','name_ja'=>'スレがあります')); ?>
                    <?php echo Form::label('大スレ有', 'Body has scratches.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('ベタつき', 'stickiness', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::checkbox('グリップベタつき有り','Grip of body has stickiness.', '',array('id'=>'appearance','name_ja'=>'グリップにベタつきがあります')); ?>
                    <?php echo Form::label('グリップベタつき有り', 'Grip of body has stickiness.'); ?>
                </div>
                <div class="col-md-4">
                    <?php echo Form::checkbox('裏蓋にベタつき有り','Grip of body has stickiness.', '',array('id'=>'appearance','name_ja'=>'裏蓋にベタつきがあります')); ?>
                    <?php echo Form::label('裏蓋にベタつき有り', 'Grip of body has stickiness.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('アタリ', 'dent', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('アタリ有 ','Body has a tiny dent.', '',array('id'=>'appearance','name_ja'=>'アタリがあります')); ?>
                    <?php echo Form::label('アタリ有', 'Body has a tiny dent.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('ペンタ部にアタリ有','There is a dent on the top of camera.', '',array('id'=>'appearance','name_ja'=>'ペンタ部にアタリがあります')); ?>
                    <?php echo Form::label('ペンタ部にアタリ有', 'There is a dent on the top of camera.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('底部にアタリ有','There is a dent on the bottom of camera.', '',array('id'=>'appearance','name_ja'=>'底部にアタリがあります')); ?>
                    <?php echo Form::label('底部にアタリ有', 'There is a dent on the bottom of camera.'); ?>
                </div>
            </div>
        </div>


        <div class="form-group">
            <?php echo Form::label('シャッター幕', 'Shutter curtain', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('シャッター幕汚れ有','Shutter curtain is dirty.', '',array('id'=>'appearance','name_ja'=>'シャッター幕が汚れています')); ?>
                    <?php echo Form::label('シャッター幕汚れ有', 'Shutter curtain is dirty.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('シャッター幕ヨレ有','Shutter curtain has wrinkles.', '',array('id'=>'appearance','name_ja'=>'シャッター幕にヨレがあります')); ?>
                    <?php echo Form::label('シャッター幕ヨレ有', 'Shutter curtain has wrinkles.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('シャッター幕不良','Shutter curtain does not work.', '',array('id'=>'appearance','name_ja'=>'シャッター幕が正常動作しません')); ?>
                    <?php echo Form::label('シャッター幕不良', 'Shutter curtain does not work.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('モルトプレーン', 'Moltoprene', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox( 'モルト不良','Moltoprene is in a bad condition.','',array('id'=>'appearance','name_ja'=>'モルトの状態が悪いです')); ?>
                    <?php echo Form::label('モルト不良', 'Moltoprene is in a bad condition.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('モルト劣化','Moltoprene is deteriorated.', '',array('id'=>'appearance','name_ja'=>'モルトが劣化しています')); ?>
                    <?php echo Form::label('モルト劣化', 'Moltoprene is deteriorated.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('モルト少し劣化','Moltoprene is slightly deteriorated.', '',array('id'=>'appearance','name_ja'=>'モルトが少し劣化しています')); ?>
                    <?php echo Form::label('モルト少し劣化', 'Moltoprene is slightly deteriorated.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('モルト良好','Moltoprene is in a good condition.', '',array('id'=>'appearance','name_ja'=>'モルトの状態は良好です')); ?>
                    <?php echo Form::label('モルト良好', 'Moltoprene is in a good condition.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('', 'appearance', array('class'=>'col-md-2 control-label')); ?>

            <div class="col-md-4">
                <?php echo Form::textarea('appearance_ja_1', Input::post('appearance', isset($inventory) ? $inventory->appearance_ja_1 : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Appearance (Japanese)')); ?>
            </div>
            <div class="col-md-4">
                <?php echo Form::textarea('appearance_en_1', Input::post('appearance', isset($inventory) ? $inventory->appearance_en_1 : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Appearance (English)')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('------------------　　動作　　-------------------', 'Optical', array('class'=>'col-md-7 control-label')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('全体', 'all', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('動作に問題はありません','It works properly.','',array('id'=>'functional','name_ja'=>'動作に問題はありません')); ?>
                    <?php echo Form::label('動作に問題なし', 'It works properly.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('電源は入るか', 'power', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('電源問題なし','The power works well.','',array('id'=>'functional','name_ja'=>'電源問題なし')); ?>
                    <?php echo Form::label('電源問題なし', 'The power works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('電源入らない','The power does not turn on.','',array('id'=>'functional','name_ja'=>'電源が入りません')); ?>
                    <?php echo Form::label('電源入らない', 'The power does not turn on.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('シャッターは切れるか', 'shutter worka', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('シャッターOK','The shutter works well.', '',array('id'=>'functional','name_ja'=>'シャッターは正常に切れます')); ?>
                    <?php echo Form::label('シャッターOK', 'The shutter works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('The shutter does not work.', 'シャッター切れない','',array('id'=>'functional','name_ja'=>'シャッターが切れません')); ?>
                    <?php echo Form::label('シャッター切れない', 'The shutter does not work.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('シャッター速度', 'shutter speed', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('シャッタースピードOK ','The shutter speed is accurate.', '',array('id'=>'functional','name_ja'=>'シャッタースピードは正常です')); ?>
                    <?php echo Form::label('シャッタースピードOK', 'The shutter speed is accurate.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('低速異常','The shutter speed is not accurate on slow range.', '',array('id'=>'functional','name_ja'=>'シャッター低速が正常動作しません')); ?>
                    <?php echo Form::label('低速異常', 'The shutter speed is not accurate on slow range.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('高速異常','The shutter speed is not accurate on fast range.', '',array('id'=>'functional','name_ja'=>'シャッター高速が正常動作しません')); ?>
                    <?php echo Form::label('高速異常', 'The shutter speed is not accurate on fast range.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('全速異常','The shutter speed is not accurate.', '',array('id'=>'functional','name_ja'=>'シャッターが正常動作しません')); ?>
                    <?php echo Form::label('全速異常', 'The shutter speed is not accurate.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('露出計の作動', 'Exposure meter', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('露出計OK ','Exposure meter works well.', '',array('id'=>'functional','name_ja'=>'露出計は動作します')); ?>
                    <?php echo Form::label('露出計OK', 'Exposure meter works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('露出計不良','Eexposure meter does not work.', '',array('id'=>'functional','name_ja'=>'露出計は動作しません')); ?>
                    <?php echo Form::label('露出計不良', 'Eexposure meter does not work.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('未チェック','Exposure meter is not checked.', '',array('id'=>'functional','name_ja'=>'露出計は確認しておりません')); ?>
                    <?php echo Form::label('未チェック', 'Exposure meter is not checked.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('距離計の作動', 'Range finder', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('距離計OK ','Range finder works well.', '',array('id'=>'functional','name_ja'=>'距離計は動作します')); ?>
                    <?php echo Form::label('距離計OK', 'Range finder works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('距離計不良','Range finder is not good.', '',array('id'=>'functional','name_ja'=>'距離計不良です')); ?>
                    <?php echo Form::label('距離計不良', 'Range finder is not good.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('距離計縦ズレ','Double image of rangefinder are shifted in the vertical.', '',array('id'=>'functional','name_ja'=>'距離計は縦ズレしています')); ?>
                    <?php echo Form::label('距離計縦ズレ', 'Double image of rangefinder are shifted in the vertical.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('距離計重ならない','Double image in the finder are not overlap.', '',array('id'=>'functional','name_ja'=>'距離計は重なりません')); ?>
                    <?php echo Form::label('距離計重ならない', 'Double image in the finder are not overlap.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('フイルム巻き上げ', 'film winding', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('フイルム巻き上げOK ','The film winding works well.', '',array('id'=>'functional','name_ja'=>'フィルム巻上は正常です')); ?>
                    <?php echo Form::label('フイルム巻き上げOK', 'The film winding works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('フイルム巻き上げ不良','The film winding does not work.', '',array('id'=>'functional','name_ja'=>'フィルム巻上出来ません')); ?>
                    <?php echo Form::label('フイルム巻き上げ不良', 'The film winding does not work.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('AFは正常か', 'auto focus', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('AF OK ','The auto focus works well.', '',array('id'=>'functional','name_ja'=>'AFは正常動作します')); ?>
                    <?php echo Form::label('AF OK', 'The auto focus works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('AF不良','The auto focus does not work.', '',array('id'=>'functional','name_ja'=>'AFが動作しません')); ?>
                    <?php echo Form::label('AF不良', 'The auto focus does not work.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('液晶', 'LCD', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('問題なし','LCD is in a good condition.', '',array('id'=>'functional','name_ja'=>'液晶は良好です')); ?>
                    <?php echo Form::label('問題なし', 'LCD is in a good condition.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('漏れ有り','LCD has a leakage.', '',array('id'=>'functional','name_ja'=>'液晶漏れがあります')); ?>
                    <?php echo Form::label('漏れ有り', 'LCD has a leakage.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('液晶不良','LCD does not work.', '',array('id'=>'functional','name_ja'=>'液晶不良です')); ?>
                    <?php echo Form::label('液晶不良', 'LCD does not work.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('ストロボ', 'Flash', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('問題なし','Flash works well.', '',array('id'=>'functional','name_ja'=>'ストロボは良好です')); ?>
                    <?php echo Form::label('問題なし', 'Flash works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('動作不良','Flash does not work.', '',array('id'=>'functional','name_ja'=>'ストロボが動作不良です')); ?>
                    <?php echo Form::label('動作不良', 'Flash does not work.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('焦げ有るが問題なし','There is a singe on the stroboscope, but its luminescence is normal.', '',array('id'=>'functional','name_ja'=>'ストロボに焦げはありますが、動作に問題ありません')); ?>
                    <?php echo Form::label('焦げ有るが問題なし', 'There is a singe on the stroboscope, but its luminescence is normal.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('フォーカシングスクリーン', 'Focusing screen', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('方眼','Focusing screen is a grid type.', '',array('id'=>'functional','name_ja'=>'方眼スクリーンです')); ?>
                    <?php echo Form::label('方眼', 'Focusing screen is a grid type.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('', 'functional', array('class'=>'col-md-2 control-label')); ?>

            <div class="col-md-4">
                <?php echo Form::textarea('functional_ja_1', Input::post('functional_ja_1', isset($inventory) ? $inventory->functional_ja_1 : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Functional (Japanese)')); ?>
            </div>
            <div class="col-md-4">
                <?php echo Form::textarea('functional_en_1', Input::post('functional_en_1', isset($inventory) ? $inventory->functional_en_1 : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Functional (English)')); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('------------------　　光学　　-------------------', 'Optical', array('class'=>'col-md-7 control-label')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('ファインダー', 'finder', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('カビ有り','Finder has a fungus.', '',array('id'=>'optical','name_ja'=>'ファインダーにカビがあります')); ?>
                    <?php echo Form::label('カビ有り', 'Finder has a fungus.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('チリ有り','Finder has a dusts.', '',array('id'=>'optical','name_ja'=>'ファインダーにチリがあります')); ?>
                    <?php echo Form::label('チリ有り', 'Finder has a dusts.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('僅かにチリ有り','Finder has a little bit dusts.', '',array('id'=>'optical','name_ja'=>'ファインダーに僅かにチリがあります')); ?>
                    <?php echo Form::label('僅かにチリ有り', 'Finder has a little bit dusts.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox( '問題なし','Finder is clean.','',array('id'=>'optical','name_ja'=>'ファインダー良好です')); ?>
                    <?php echo Form::label('問題なし', 'Finder is clean.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('レンズのカビ', 'fungus', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('カビ無','Lens has no fungus.', '',array('id'=>'optical','name_ja'=>'レンズにカビはありません')); ?>
                    <?php echo Form::label('カビ無', 'Lens has no fungus.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('小カビ有','Lens has small fungus.', '',array('id'=>'optical','name_ja'=>'レンズに僅かなカビがあります')); ?>
                    <?php echo Form::label('小カビ有', 'Lens has small fungus.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('大カビ有','Lens has fungus.', '',array('id'=>'optical','name_ja'=>'レンズに大きなカビがあります')); ?>
                    <?php echo Form::label('大カビ有', 'Lens has fungus.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('周辺カビ有','Lens has fungus.', '',array('id'=>'optical','name_ja'=>'レンズ周辺にカビがあります')); ?>
                    <?php echo Form::label('周辺カビ有', 'Lens has fungus.'); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('レンズのクモリ', 'haze', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('クモリ無 ','Lens has no haze.', '',array('id'=>'optical','name_ja'=>'レンズにクモリはありません')); ?>
                    <?php echo Form::label('クモリ無', 'Lens has no haze.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('クモリ有','Lens has haze.', '',array('id'=>'optical','name_ja'=>'レンズにクモリがあります')); ?>
                    <?php echo Form::label('クモリ有', 'Lens has haze.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('わずかにクモリ','Lens has slight haze', '',array('id'=>'optical','name_ja'=>'レンズに僅かにクモリがあります')); ?>
                    <?php echo Form::label('わずかにクモリ', 'Lens has slight haze'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('周辺クモリ','Lens has haze on the around the middle element.', '',array('id'=>'optical','name_ja'=>'レンズ周辺にクモリがあります')); ?>
                    <?php echo Form::label('周辺クモリ', 'Lens has haze on the around the middle element.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('レンズのバルサム切れ', 'balsam seperation', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('バルサム切れ無し ','Lens has no balsam seperation.', '',array('id'=>'optical','name_ja'=>'レンズにバルサム切れはありません')); ?>
                    <?php echo Form::label('バルサム切れ無し', 'Lens has no balsam seperation.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('バルサム切れ有り','Lens has balsam seperation.', '',array('id'=>'optical','name_ja'=>'レンズにバルサム切れがあります')); ?>
                    <?php echo Form::label('バルサム切れ有り', 'Lens has balsam seperation.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('僅かにバルサム切れ','Lens has slight balsam seperation.', '',array('id'=>'optical','name_ja'=>'僅かにバルサム切れがあります')); ?>
                    <?php echo Form::label('僅かにバルサム切れ', 'Lens has slight balsam seperation.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('周辺バルサム切れ','Lens has balsam seperation around the middle element.', '',array('id'=>'optical','name_ja'=>'レンズ周辺にバルサム切れがあります')); ?>
                    <?php echo Form::label('周辺バルサム切れ', 'Lens has balsam seperation around the middle element.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('レンズのチリや埃', 'dusts', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('チリ・埃無し ','There are no dusts inside the lens.', '',array('id'=>'optical','name_ja'=>'レンズにチリ・埃ありません')); ?>
                    <?php echo Form::label('チリ・埃無し', 'There are no dusts inside the lens.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('小チリ有','There are little dusts inside the lens.', '',array('id'=>'optical','name_ja'=>'レンズに小チリがあります')); ?>
                    <?php echo Form::label('小チリ有', 'There are little dusts inside the lens.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('チリ有','There are dusts inside the lens.', '',array('id'=>'optical','name_ja'=>'レンズにチリがあります')); ?>
                    <?php echo Form::label('チリ有', 'There are dusts inside the lens.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('レンズの傷（前玉）', 'scratch on the front', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::label('', 'There is no scratches.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('小キズ有 ','There is a tiny  element.', '',array('id'=>'optical','name_ja'=>'レンズ前玉に小キズがあります')); ?>
                    <?php echo Form::label('小キズ有', 'There is a tiny scratch on the front element.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ有','There is a scratch on the front element.', '',array('id'=>'optical','name_ja'=>'レンズ前玉にキズがあります')); ?>
                    <?php echo Form::label('キズ有', 'There is a scratch on the front element.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ有（複数）','There are scratches on the front element.', '',array('id'=>'optical','name_ja'=>'レンズ前玉に複数のキズがあります')); ?>
                    <?php echo Form::label('キズ有（複数）', 'There are scratches on the front element.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('レンズの傷（中玉）', 'scratch on the middle', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ無 ','There is no scratches.', '',array('id'=>'optical','name_ja'=>'キズはありません')); ?>
                    <?php echo Form::label('キズ無', 'There is no scratches.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('小キズ有 ','There is a tiny scratch on the middle element.', '',array('id'=>'optical','name_ja'=>'レンズ中玉に小キズがあります')); ?>
                    <?php echo Form::label('小キズ有', 'There is a tiny scratch on the middle element.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ有','There is a scratch on the middle element.', '',array('id'=>'optical','name_ja'=>'レンズ中玉にキズがあります')); ?>
                    <?php echo Form::label('キズ有', 'There is a scratch on the middle element.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ有（複数）','There are scratches on the middle element.', '',array('id'=>'optical','name_ja'=>'レンズ中玉に複数のキズがあります')); ?>
                    <?php echo Form::label('キズ有（複数）', 'There are scratches on the middle element.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('レンズの傷（後玉）', 'scratch on the rear', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::label('', 'There is no scratches.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('小キズ有 ','There is a tiny scratch on the rear element.', '',array('id'=>'optical','name_ja'=>'レンズ後玉に小キズがあります')); ?>
                    <?php echo Form::label('小キズ有', 'There is a tiny scratch on the rear element.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ有','There is a scratch on the rear element.', '',array('id'=>'optical','name_ja'=>'レンズ後玉にキズがあります')); ?>
                    <?php echo Form::label('キズ有', 'There is a scratch on the rear element.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('キズ有（複数）','There are scratches on the rear element.', '',array('id'=>'optical','name_ja'=>'レンズ後玉に複数のキズがあります')); ?>
                    <?php echo Form::label('キズ有（複数）', 'There are scratches on the rear element.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('絞り羽根', 'Aperture blade', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-2">
                    <?php echo Form::checkbox('絞り良好 ','Aperture blade works well.', '',array('id'=>'optical','name_ja'=>'絞りが正常に動作します')); ?>
                    <?php echo Form::label('絞り良好', 'Aperture blade works well.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('絞り不良 ','Aperture blade does not work.', '',array('id'=>'optical','name_ja'=>'絞りが正常に動作しません')); ?>
                    <?php echo Form::label('絞り不良', 'Aperture blade does not work.'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo Form::checkbox('油浮き','Aaperture blade has a little oozing oil.', '',array('id'=>'optical','name_ja'=>'絞りに油浮きがあります')); ?>
                    <?php echo Form::label('油浮き', 'Aaperture blade has a little oozing oil.'); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('写りに影響するか', 'affects images', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::checkbox('撮影に影響する不良は無い','This lens does not have any defect which affects images.', '',array('id'=>'optical','name_ja'=>'撮影に影響する不良はありません')); ?>
                    <?php echo Form::label('撮影に影響する不良は無い', 'This lens does not have any defect which affects images.'); ?>
                </div>
                <div class="col-md-3">
                    <?php echo Form::checkbox('逆光では撮影に影響するかもしれない','When you take a photo against the sun, it may affect images.', '',array('id'=>'optical','name_ja'=>'逆光では撮影に影響するかもしれません')); ?>
                    <?php echo Form::label('逆光では撮影に影響するかもしれない', 'When you take a photo against the sun, it may affect images.'); ?>
                </div>
                <div class="col-md-3">
                    <?php echo Form::checkbox('撮影に影響が出ると思います','This lens have defect which affect images.', '',array('id'=>'optical','name_ja'=>'撮影に影響するかもしれません')); ?>
                    <?php echo Form::label('撮影に影響が出ると思います', 'This lens have defect which affect images.'); ?>
                </div>
            </div>
        </div>


        <div class="form-group">
            <?php echo Form::label('', 'optical', array('class'=>'col-md-2 control-label')); ?>

            <div class="col-md-4">
                 <?php echo Form::textarea('optical_ja_1', Input::post('optical_ja_1', isset($inventory) ? $inventory->optical_ja_1 : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Optical (Japanese)')); ?>
            </div>
            <div class="col-md-4">
                <?php echo Form::textarea('optical_en_1', Input::post('optical_en_1', isset($inventory) ? $inventory->optical_en_1 : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Optical (English)')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('状態', 'condition', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::textarea('condition_other_ja', Input::post('condition_other_en', isset($inventory) ? $inventory->condition_other_en : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Condition (Japanese)')); ?>
                </div>
                <div class="col-md-4">
                    <?php echo Form::textarea('condition_other_en', Input::post('condition_other_en', isset($inventory) ? $inventory->condition_other_en : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'Condition (English)')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('写真URL', 'picture_url', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-8">
                    <?php echo Form::textarea('picture_url', Input::post('picture_url', isset($inventory) ? $inventory->picture_url : ''), array('rows' => 5,'class' => 'col-md-4 form-control', 'placeholder'=>'picture_url')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('重量', 'weight', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('weight', Input::post('weight', isset($inventory) ? $inventory->weight : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Weight')); ?>
                </div>
            </div>
        </div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>
<div class="form-group">
    <?php echo Html::anchor('ebay/salespart/invtosales/'.$inventory->id,'出品',array('class' => 'btn btn-primary')); ?>
</div>

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
                var html = '<tr><td><a href="/ebay/product/edit/' + value.product_id + '" target="_blank">' + value.product_name + '</a></td>';
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

