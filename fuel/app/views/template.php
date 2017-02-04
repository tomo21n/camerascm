<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<?php echo Asset::css('bootstrap.min.css'); ?>
    <?php echo Asset::css('extension.css'); ?>
    <style>
		body { margin: 50px 0px 10px; }
    </style>
	<?php echo Asset::js(array(
		'http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js',
		'bootstrap.js'
	)); ?>
	<script>
		$(function(){ $('.topbar').dropdown(); });
	</script>
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">WorldViewing</a>
			</div>
            <?php if ($current_user): ?>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
                    <li class="<?php echo Uri::segment(2) == '' ? 'active' : '' ?>">
                        <?php echo Html::anchor('user', 'Dashboard') ?>
                    </li>
                    <?php if(Auth::get_groups() > 3): ?>

                        <?php
                        $files = new GlobIterator(APPPATH.'classes/controller/admin/*.php');
                        foreach($files as $file)
                        {
                            $section_segment = $file->getBasename('.php');
                            $section_title = Inflector::humanize($section_segment);
                            ?>
                            <li class="<?php echo Uri::segment(2) == $section_segment ? 'active' : '' ?>">
                                <?php echo Html::anchor('admin/'.$section_segment, $section_title) ?>
                            </li>
                        <?php
                        }
                        ?>
                    <?php endif; ?>
                    <?php if(Auth::get_groups() > 2): ?>
                        <li class="dropdown <?php echo Uri::segment(2) == 'myinventory' ? 'active' : '' ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">eBay<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo Html::anchor('ebay/product/', '商品一覧') ?></li>
                                <li><?php echo Html::anchor('ebay/supply/', '仕入一覧') ?></li>
                                <li><?php echo Html::anchor('ebay/inventory/', '在庫一覧') ?></li>
                                <li><?php echo Html::anchor('ebay/salespart/', '出品') ?></li>
                                <li><?php echo Html::anchor('ebay/order/', '販売一覧') ?></li>
                                <li><?php echo Html::anchor('ebay/itemspecific/', '製品特徴') ?></li>
                                <li><?php echo Html::anchor('ebay/shipping/', '送料') ?></li>
                                <li><?php echo Html::anchor('ebay/ejtinvent/', '仕入れサイト') ?></li>
                                <li><?php echo Html::anchor('ebay/netstoreinvent/', 'ネットストア') ?></li>
                            </ul>
                        </li>
                        <li class="dropdown <?php echo Uri::segment(2) == 'myauction' ? 'active' : '' ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">ヤフオク<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo Html::anchor('yahoo/myauction/accesstokenlist', 'アクセストークン') ?></li>
                                <li><?php echo Html::anchor('yahoo/myauction/', '落札一覧') ?></li>
                                <li><?php echo Html::anchor('yahoo/soldlist/', '出品落札済一覧') ?></li>
                                <li><?php echo Html::anchor('yahoo/auctionbit/', '入札') ?></li>
                            </ul>
                        </li>

                        <li class="dropdown <?php echo Uri::segment(2) == 'useraccount' ? 'active' : '' ?>">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">アカウント<b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><?php echo Html::anchor('account/user/useraccount/edit', 'アカウント編集') ?></li>
                                <li><?php echo Html::anchor('account/user/useraccount/changepassword', 'パスワード変更') ?></li>
                            </ul>
                        </li>
                    <?php endif; ?>
				</ul>
				<ul class="nav navbar-nav pull-right">
					<li class="dropdown">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $current_user->nickname ?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
                            <?php if(Uri::segment(1) == 'user'): ?>
                            <li><?php echo Html::anchor('user/logout', 'Logout') ?></li>
                            <?php elseif(Uri::segment(1) == 'admin'): ?>
                            <li><?php echo Html::anchor('user/logout', 'Logout') ?></li>
                            <?php endif; ?>

                        </ul>
					</li>
				</ul>
			</div>
            <?php endif; ?>
        </div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- <h1><?php echo $title; ?></h1> -->
				<!-- <hr> -->
<?php if (Session::get_flash('success')): ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('success')); ?>
					</p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert alert-danger alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<p>
					<?php echo implode('</p><p>', (array) Session::get_flash('error')); ?>
					</p>
				</div>
<?php endif; ?>
			</div>
			<div class="col-md-12">
<?php echo $content; ?>
			</div>
		</div>
		<hr/>
		<footer>
			<p class="pull-right">Amazon Viewing  all right reserved.</p>
		</footer>
	</div>


    <!---  extension search ----->
    <div class="check-extension">
        <div class="check-extension__content">
            <input name="query" id="query" class="col-md-10 col-xs-8">
            <input name="tab1page" id="tab1page" type="hidden" value="1">
            <input name="tab2page" id="tab2page" type="hidden" value="1">
            <input name="currenttab" id="currenttab" type="hidden" value="tab1">
            <input name="visible" id="visible" type="hidden" value="1">
            <button id="querybutton" class="btn btn-primary">検索</button>
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">ebay</a></li>
                <li><a href="#tab2" data-toggle="tab">Yahoo</a></li>
                <li><a href="#tab3" data-toggle="tab">Closed</a></li>
                <li><a href="#tab4" data-toggle="tab">Detail</a></li>
                <li><a href="#tab5" data-toggle="tab">Product</a></li>
                <li><a href="#tab6" data-toggle="tab">PEdit</a></li>
                <li><a href="#tab7" data-toggle="tab">AucAdd</a></li>
            </ul>
            <div class="tab-content" id="tabcontent">
                <div class="tab-pane active" id="tab1"></div>
                <div class="tab-pane" id="tab2"></div>
                <div class="tab-pane" id="tab3"></div>
                <div class="tab-pane" id="tab4"></div>
                <div class="tab-pane" id="tab5"></div>
                <div class="tab-pane" id="tab6"></div>
                <div class="tab-pane" id="tab7"></div>

            </div>
            <!-- ここからTOPに戻るボタン -->
            <div id="page-top">
                <p><a id="move-page-top">▲</a></p>
            </div>
            <!-- ここまでTOPに戻るボタン -->
        </div>
        <div class="check-extension__button">S</div>
    </div>




<script>
    $('div.check-extension__button').on('click', function() {
        $('div.check-extension').toggleClass('check-extension--hidden');
    });

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
                url: "http://dev.world-viewing.com/research/tabresearch/ebay",
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
                url: "http://dev.world-viewing.com/research/tabresearch/yahoo",
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
        }

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
