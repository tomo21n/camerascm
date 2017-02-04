<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Research" ?></title>
    <?php echo Asset::css(array(
        'bootstrap.min.css',
        'to-top.css')); ?>
    <?php echo Asset::js(array(
        'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
        'bootstrap.js',
        'to-top.js'
    )); ?>
    <STYLE type="text/css">
        <!--
        .vsmall { font-size: 80% }      /* 80% */
        .small { font-size: 80% }      /* 80% */
        .topline{
            border-top: 1px solid gray;
            padding-top: 3px;
        }
        .bottomline{
            padding-bottom: 3px;
        }
        .nopadding{
            padding-left: 4px;
            padding-right: 2px;
        }
        .price{
            color: red;
            font-weight:bold;
        }
        -->
    </STYLE>
</head>
<body>
<input name="query" id="query" class="col-md-4 col-xs-8">
<input name="tab1page" id="tab1page" type="hidden" value="1">
<input name="tab2page" id="tab2page" type="hidden" value="1">
<input name="currenttab" id="currenttab" type="hidden" value="tab1">
<input name="visible" id="visible" type="hidden" value="1">
<button id="querybutton" class="btn btn-primary">検索</button>
    <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Yahoo</a></li>
    <li><a href="#tab2" data-toggle="tab">eBay</a></li>
    <li><a href="#tab3" data-toggle="tab">Closed</a></li>
    <li><a href="#tab4" data-toggle="tab">Detail</a></li>
    <li><a href="#tab5" data-toggle="tab">Product</a></li>
    <li><a href="#tab6" data-toggle="tab">PEdit</a></li>
    <li><a href="#tab7" data-toggle="tab">AucAdd</a></li>
    <li><a href="#tab8" data-toggle="tab">Watch</a></li>
    <li><a href="#tab9" data-toggle="tab">eBay(Active)</a></li>

    </ul>
<div class="tab-content" id="tabcontent">
    <div class="tab-pane active" id="tab1"></div>
    <div class="tab-pane" id="tab2"></div>
    <div class="tab-pane" id="tab3"></div>
    <div class="tab-pane" id="tab4"></div>
    <div class="tab-pane" id="tab5"></div>
    <div class="tab-pane" id="tab6"></div>
    <div class="tab-pane" id="tab7"></div>
    <div class="tab-pane" id="tab8"></div>
    <div class="tab-pane" id="tab9"></div>
</div>
<!-- ここからTOPに戻るボタン -->
<div id="page-top">
    <p><a id="move-page-top">▲</a></p>
</div>
<!-- ここまでTOPに戻るボタン -->
<script>

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var tabName = e.target.href;
        var items = tabName.split("#"); // activated tab
        var previustabName = e.relatedTarget.href;
        var previusitems = previustabName.split("#"); // activated tab
        $("#currenttab").val(items[1]);
        $('#tab4').html('...');
        // e.target // 有効化したタブ
        // e.relatedTarget // 前のタブ
    })
    // 操作対象のフォーム要素を取得
    $('#querybutton').click(function(){
        var $form = $("#query");
        var $currenttab = $("#currenttab").val();
        var $visible = $("#visible").val();

        //if($visible == 1 ){
            $("#visible").val(0);
            if($currenttab == "tab1"){
                $("#tab1").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/yahoo",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab1").html(data);
                    $("#tab1page").val(1);
                    $("#visible").val(1);
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }else if($currenttab == "tab2"){
                $("#tab2").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/ebay",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab2").html(data);
                    $("#tab2page").val(1);
                    $("#visible").val(1);
                    //alert(data.$("#EOF"));
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }else if($currenttab == "tab3"){
                $("#tab3").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/yahooclosed",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab3").html(data);
                    $("#visible").val(1);
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }else if($currenttab == "tab5"){
                    $("#tab3").html('loading...');
                    $.ajax({
                        url: "http://dev.world-viewing.com/research/tabresearch/product",
                        dataType: "html",
                        cache: false,
                        data: $form.serialize()
                    }).done(function(data, textStatus) {
                        $("#tab5").html(data);
                        $("#visible").val(1);
                    }).fail(function(xhr, textStatus, errorThrown) {
                        // エラー処理
                    });
            }else if($currenttab == "tab6"){
                $("#tab6").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/productedit",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab6").html(data);
                    $("#visible").val(1);
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }else if($currenttab == "tab7"){
                $("#tab7").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/auctionadd",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab7").html(data);
                    $("#visible").val(1);
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }else if($currenttab == "tab8"){
                $("#tab8").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/yahoomywatch",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab8").html(data);
                    $("#visible").val(1);
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }else if($currenttab == "tab9"){
                $("#tab9").html('loading...');
                $.ajax({
                    url: "http://dev.world-viewing.com/research/tabresearch/ebay/active",
                    dataType: "html",
                    cache: false,
                    data: $form.serialize()
                }).done(function(data, textStatus) {
                    $("#tab9").html(data);
                    $("#tab9page").val(1);
                    $("#visible").val(1);
                    //alert(data.$("#EOF"));
                }).fail(function(xhr, textStatus, errorThrown) {
                    // エラー処理
                });
            }

        //}



    });
    $(window).bind("scroll", function() {
        scrollHeight = $(document).height();
        scrollPosition = $(window).height() + $(window).scrollTop();
        var $visible = $("#visible").val();
        if($visible == 1 ){
            if ( (scrollHeight - scrollPosition) / scrollHeight <= 0.10) {
                $("#visible").val(0);
                var $currenttab = $("#currenttab").val();
                if($currenttab == "tab1"){
                    var $eof = $("#yahooeof").val();
                    if($eof == null){
                        //スクロールの位置が下部5%の範囲に来た場合
                        var $form = $("#query");
                        var $nextpage = Number($("#tab1page").val())+ 1;
                        $.ajax({
                            url: "http://dev.world-viewing.com/research/tabresearch/yahoo",
                            dataType: "html",
                            cache: false,
                            data: $form.serialize() + "&page="+$nextpage
                        }).done(function(data, textStatus) {
                            $("#tab1").append(data);
                            $("#tab1page").val($nextpage);
                            $("#visible").val(1);
                        }).fail(function(xhr, textStatus, errorThrown) {
                            // エラー処理
                        });
                    }
                }else if($currenttab == "tab2"){
                    var $eof = $("#ebayeof").val();
                    if($eof == null){
                        var $form = $("#query");
                        var $nextpage = Number($("#tab2page").val())+ 1;
                        $.ajax({
                            url: "http://dev.world-viewing.com/research/tabresearch/ebay",
                            dataType: "html",
                            cache: false,
                            data: $form.serialize()+ "&page="+$nextpage
                        }).done(function(data, textStatus) {
                            $("#tab2").append(data);
                            $("#tab2page").val($nextpage);
                            $("#visible").val(1);
                        }).fail(function(xhr, textStatus, errorThrown) {
                            // エラー処理
                        });
                    }
                }
            } else {
                //それ以外のスクロールの位置の場合
            }



        }
    });
</script>
</body>
</html>
