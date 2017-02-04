<?php echo Form::open(array("class"=>"form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('ID', 'auction_id', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-4">
                    <?php echo Form::input('auction_id', Input::post('auction_url', isset($auctionbit) ? $auctionbit->auction_url :@$auction_id), array('class' => 'col-md-4 form-control', 'placeholder'=>'auction_id')); ?>
                </div>
                <div class="col-md-2">
                    <a href="#" id="search_auction" class="btn btn-primary">オークションID検索</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('URL', 'auction_url', array('class'=>'col-md-2 control-label')); ?>
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
            <?php echo Form::label('ﾀｲﾄﾙ', 'auction_title', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-9">
                    <?php echo Form::input('auction_title', Input::post('auction_title', isset($auctionbit) ? $auctionbit->auction_title : ''), array('class' => 'form-control', 'placeholder'=>'auction_title', 'readonly')); ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('開始日', 'start_date', array('class'=>'col-md-2 control-label')); ?>
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
            <?php echo Form::label('現在価', 'current_price', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-3">
                    <?php echo Form::input('current_price','', array('class' => 'col-md-4 form-control', 'placeholder'=>'current_price', 'readonly')); ?>
                </div>
                <?php echo Form::label('即決価', 'buyout_price', array('class'=>'col-md-2 control-label')); ?>
                <div class="col-md-3">
                    <?php echo Form::input('buyout_price', Input::post('buyout_price', isset($auctionbit) ? $auctionbit->buyout_price : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'buyout_price', 'readonly')); ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo Form::label('仕入価', 'budget_price', array('class'=>'col-md-2 control-label')); ?>
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
            <?php echo Form::label('出品価', 'sale_price', array('class'=>'col-md-2 control-label')); ?>
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
            </div>
        </div>
        <div class="form-group">
            <?php echo Form::label('商品名', 'product_name', array('class'=>'col-md-2 control-label')); ?>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Form::input('product_name', Input::post('product_name', isset($auctionbit) ? $auctionbit->product_name : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'product_name')); ?>
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
<?php echo Form::close(); ?>

<script>
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
</script>