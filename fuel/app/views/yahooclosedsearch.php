<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>YahooClosedSearch</title>
</head>
<body>
    <div class="container">
        <div class="row">
           <div style="width:250px;">
               <?php foreach( $itemlist as $item ): ?>
                    <div style="clear: left;" >
                        <?php echo Html::anchor($item["item_url"], $item["item_title"],array("target"=>"_blank")); ?>
                    </div>
                   <div style="float:left;width:120px">
                        <?php echo '<img width="100" src="'.$item["item_image"].'">'; ?>
                    </div>
                    <div>
                        <?php echo "<b>".$item["item_price"]."</b></br>"; ?>
                        <?php echo $item["item_time"]; ?>
                    </div>
                <?php endforeach; ?>
           </div>>
        </div>
    </div>
</body>
</html>
