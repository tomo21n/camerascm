<?php if ($Result): ?>
<div class="col-md-12 container">
    <div class="row topline bottomline">
        <div class="col-md-12 col-xs-10 nopadding"><?php echo "合計".$totalResultsAvailable."件 :".$firstResultPosition."-".($firstResultPosition+$totalResultsReturned-1)."件"; ?></div>
    </div>
    <?php foreach ($Result["Item"] as $item): ?>
    <div class="row topline bottomline">
        <div class="col-md-4 col-xs-4 nopadding"><a data-toggle="popover" id="searchyahoo<?php echo $item["AuctionID"]; ?>" data-html="true" data-content="<div id='yahoolist<?php echo $item["AuctionID"]; ?>'></div>" data-placement="bottom" data-container="body"><?php echo Html::img($item["Image"],array("class"=>"img-responsive")); ?></a></div>
        <div class="col-md-8 col-xs-6 vsmall nopadding"><?php echo $item["Title"]; ?></a></div>
        <div class="col-md-8 col-xs-6 small"><?php echo "現在:<span class='price'>".number_format((int)$item["CurrentPrice"])."</span>円"; ?><br />
        <?php echo isset($item["BidOrBuy"])?"即決:".number_format((int)$item["BidOrBuy"])."円":""; ?><br />
        <i class="glyphicon glyphicon-time"></i><?php echo date('m/d H:i', strtotime($item["EndTime"])) ; ?>
        <i class="glyphicon glyphicon-ok"></i><?php echo $item["Bids"]."件"; ?></div>
    </div>
    <?php endforeach; ?>
    <?php if(isset($EOF)): ?>
        <div class="row topline bottomline">
            <div class="col-md-4 col-xs-10 nopadding"><?php echo "以上　合計".$totalResultsAvailable."件"; ?></div>
                <input name="eof" id="yahooeof" type="hidden" value="1">
            </div>
        </div>
    <?php endif; ?>

</div>
    <script>
        <?php foreach($Result["Item"] as $item): ?>
        //サイトリストを取得
        $("#searchyahoo<?php echo $item["AuctionID"]; ?>").click( function() {
            $('#tab4').append('通信中...');
            $.ajax({
                type: "GET",
                url: "http://dev.world-viewing.com/research/tabresearch/yahoodetail",
                dataType: "html",
                data:"id=<?php echo $item["AuctionID"]; ?>",
                success: function(res){
                    $('html,body').animate({scrollTop:0},'fast');
                    $('#tab4').html(res);
                    $('a[data-toggle="tab"]').parent().removeClass('active');
                    $('a[href=#tab4]').click();
                    $("body").css("zoom","120%");
                }
            });
        });
        <?php endforeach; ?>

        $('body').on('click', function (e) {
            $('.pophide').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
    </script>
<?php endif; ?>

