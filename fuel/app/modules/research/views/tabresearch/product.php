<?php if ($products): ?>
<div class="container col-md-12">
    <?php foreach ($products as $item): ?>
        <?php $tooltiphtml = ""; ?>
        <?php $tooltiphtml = "<table>"; ?>
        <?php //$tooltiphtml .="<tr><th colspan='5'>". $item->product_name."</th></tr>" ?>
        <?php $tooltiphtml .="<tr><th>ｶﾃｺﾞﾘ</th><td>". $item["product_name"]."</td></tr>" ?>
        <?php $tooltiphtml .= "</table>"; ?>
    <div class="row topline bottomline">
        <div class="col-md-4 col-xs-4 vsmall nopadding"><a data-toggle="popover" class="pophide" id="popover<?php echo $item["product_id"]; ?>" data-html="true" title="<?php echo $item["product_name"] ?>" data-content="<?php echo $tooltiphtml; ?>" data-placement="bottom" data-trigger="click"><?php echo $item["product_name"]; ?></a></div>
        <div class="col-md-2 col-xs-2 small nopadding"><?php echo $item["category"]; ?><br /><?php echo $item["maker"]; ?></div>
        <div class="col-md-2 col-xs-2 small"><?php echo "上:".$item["in_upper_price"]; ?><br />
            <?php echo "中:".$item["in_mean_price"]; ?><br />
            <?php echo "下:".$item["in_lower_price"]; ?><br />
        </div>
        <div class="col-md-2 col-xs-2 small"><?php echo "上:".$item["out_upper_price"]; ?><br />
            <?php echo "中:".$item["out_mean_price"]; ?><br />
            <?php echo "下:".$item["out_lower_price"]; ?><br />
        </div>
    </div>
    <?php endforeach; ?>
</div>
    <script>
        $(function() {
            <?php foreach($products as $item): ?>
            $("#popover<?php echo $item["item_id"]; ?>").popover();
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

