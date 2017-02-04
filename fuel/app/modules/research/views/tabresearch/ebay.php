<?php if (isset($Error)): ?>
    <div class="container">
            <div class="row topline bottomline">
                <div class="col-md-4 col-xs-10 nopadding"><?php echo $error->message; ?></div>
            </div>
    </div>
<?php elseif (isset($Result)): ?>

    <div class="col-md-12 container">
        <div class="row topline bottomline">
            <div class="col-md-12 col-xs-10 nopadding"><?php echo "合計".$totalEntries."件 ".":".$currentEntries."件"; ?></div>
        </div>
        <?php foreach ($Result as $item): ?>
            <?php $tooltiphtml = ""; ?>
            <?php $tooltiphtml = "<table>"; ?>
            <?php //$tooltiphtml .="<tr><th colspan='5'>". $item->product_name."</th></tr>" ?>
            <?php $tooltiphtml .="<tr><th>ｶﾃｺﾞﾘ</th><td>". $item["title"]."</td></tr>" ?>
            <?php $tooltiphtml .= "</table>"; ?>
        <div class="row topline bottomline">
            <div class="col-md-4 col-xs-4 nopadding"><?php echo Html::img($item["galleryURL"],array("class"=>"img-responsive")); ?></div>
            <div class="col-md-8 col-xs-6 vsmall nopadding"><a data-toggle="popover" class="pophide" id="popover<?php echo $item["itemId"]; ?>" data-html="true" title="<?php echo $item["title"] ?>" data-content="<?php echo $tooltiphtml; ?>" data-placement="bottom" data-trigger="click"><?php echo $item["title"]; ?></a></div>
            <div class="col-md-8 col-xs-6 small"><?php printf("落札:US<span class='price'> %.2f</span>",$item["currentPrice"]); ?><br />
            <?php printf("送料:US %.2f",$item["shippingServiceCost"]); ?><br />
            <i class="glyphicon glyphicon-time"></i><?php echo date('m/d H:i', strtotime($item["endtime"])) ; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if(isset($EOF)): ?>
            <div class="row topline bottomline">
                <div class="col-md-4 col-xs-10 nopadding"><?php echo "以上　合計".$EOF."件"; ?></div>
                <input name="eof" id="ebayeof" type="hidden" value="1">
                </div>
            </div>
        <?php endif; ?>
    </div>
    <script>
        $(function() {
            <?php foreach($Result as $item): ?>
            $("#popover<?php echo $item["itemId"]; ?>").popover();
            <?php endforeach; ?>
        });
         $('body').on('click', function (e) {
            $('.pophide').each(function () {
                if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                    $(this).popover('hide');
                }
            });
        });
    </script>
<?php endif; ?>

