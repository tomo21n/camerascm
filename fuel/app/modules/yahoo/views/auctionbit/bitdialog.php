<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Research" ?></title>
    <?php echo Asset::css(array(
        'bootstrap.min.css',
    )); ?>
    <?php echo Asset::js(array(
        'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
        'bootstrap.js',
    )); ?>
</head>
<body>
<form id="regform">
    <input name="auction_id" id="auction_id" class="col-md-4 col-xs-8">
    <input name="auction_name" id="auction_name" class="col-md-4 col-xs-8">
    <input name="budget_price" id="budget_price" class="col-md-4 col-xs-8">
    <button id="querybutton" class="btn btn-primary">検索</button>
</form>
<script>

    // 操作対象のフォーム要素を取得
    $('#querybutton').click(function(){
        $.ajax({
            url: "http://dev.world-viewing.com/yahoo/auctionrest/auctionbitcreate.json",
            dataType: "html",
            cache: false,
            data: $('form#regform').serialize()
        }).done(function(data, textStatus) {
            $("#tab1").html(data);
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
        });
    });
</script>
</body>
</html>
