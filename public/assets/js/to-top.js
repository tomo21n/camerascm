$(function(){
	//ボタン[id:page-top]を出現させるスクロールイベント
	$(window).scroll(function(){
		//最上部から現在位置までの距離を取得して、変数[now]に格納
		var now = $(window).scrollTop();

		//最下部から現在位置までの距離を計算して、変数[under]に格納
		var under = $('body').height() - (now + $(window).height());
 
		//最上部から現在位置までの距離(now)が1500以上かつ
		//最下部から現在位置までの距離(under)が200px以上だったら
		if(now > 400 && under > 50){
			//[#page-top]をゆっくりフェードインする
			$('#page-top').fadeIn('fast');
		//それ以外だったらフェードアウトする
		}else{
			$('#page-top').fadeOut('fast');
		}
	});
 
	//ボタン(id:move-page-top)のクリックイベント
	$('#move-page-top').click(function(){
		//ページトップへ移動する
		$('html,body').animate({scrollTop:0},'fast');
	});
});
