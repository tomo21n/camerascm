<?php if ($itemlist): ?>
<div class="container col-md-12">
    <?php foreach ($itemlist as $item): ?>
        <?php $tooltiphtml = ""; ?>
        <?php $tooltiphtml = "<table>"; ?>
        <?php //$tooltiphtml .="<tr><th colspan='5'>". $item->product_name."</th></tr>" ?>
        <?php $tooltiphtml .="<tr><th>ｶﾃｺﾞﾘ</th><td>". $item["item_title"]."</td></tr>" ?>
        <?php $tooltiphtml .= "</table>"; ?>
    <div class="row topline bottomline">
        <div class="col-md-4 col-xs-4 nopadding"><?php echo Html::img($item["item_image"],array("class"=>"img-responsive")); ?></div>
        <div class="col-md-4 col-xs-6 vsmall nopadding"><a data-toggle="popover" class="pophide" id="popover<?php echo $item["item_id"]; ?>" data-html="true" title="<?php echo $item["item_title"] ?>" data-content="<?php echo $tooltiphtml; ?>" data-placement="bottom" data-trigger="click"><?php echo $item["item_title"]; ?></a></div>
        <div class="col-md-4 col-xs-6 small"><?php echo "落札:<span class='price'>".$item["item_price"]."</span>"; ?><br />
        <i class="glyphicon glyphicon-time"></i><?php echo date('m/d H:i', strtotime($item["item_time"])) ; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
    <script>
        $(function() {
            <?php foreach($itemlist as $item): ?>
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

