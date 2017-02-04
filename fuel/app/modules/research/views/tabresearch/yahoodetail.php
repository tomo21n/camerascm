<button id="aucaddbutton" class="btn btn-primary">Bit</button>
</br>
<img src="<?php echo $Result["Img"]["Image1"] ?>" />
<img src="<?php echo $Result["Img"]["Image2"] ?>" />
<img src="<?php echo $Result["Img"]["Image3"] ?>" />
<input type="hidden" id="auction_id" name="auction_id" value="<?php echo $Result["AuctionID"] ?>">
<?php echo(htmlspecialchars_decode($Result["Description"]));?>
<script>
    $('#aucaddbutton').click(function(){
        var $form = $("#query");
        var $currenttab = $("#currenttab").val();
        var $auction_id = $("#auction_id").val();
        var $visible = $("#visible").val();
        $("#visible").val(0);

        $("#tab7").html('loading...');
        $.ajax({
            url: "http://dev.world-viewing.com/research/tabresearch/auctionadd",
            dataType: "html",
            cache: false,
            data: $form.serialize()
        }).done(function(data, textStatus) {
            $("#tab7").html(data);
            $("#visible").val(1);
            $("#form_auction_id").val($auction_id);
            $('a[href=#tab7]').click();
            $("#search_auction").click();
        }).fail(function(xhr, textStatus, errorThrown) {
            // エラー処理
        });
        });
</script>
