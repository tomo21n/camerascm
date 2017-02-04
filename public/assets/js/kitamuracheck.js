var casper = require("casper").create();
var input_url = "https://member.kitamura.jp/sso/login.html";
casper.userAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.74.9 (KHTML, like Gecko) Version/7.0.2 Safari/537.74.9");

casper.start("https://member.kitamura.jp/sso/login.html?s=0&_f=1");

//casper.thenOpen("https://member.kitamura.jp/sso/login.html", {
//    method: 'post',
//    data:   {
//        'command' : "do_auth",
//        's' : "0",
//        '_f' : "1",
//        'login_id' : "eb.tom.signum@gmail.com",
//        'password': "toporon"
//    }
//});


function getitem() {
    var item = document.querySelectorAll('li.kotohaco-item');
    return Array.prototype.map.call(item, function(e) {
        return  { maker: e.querySelector('span.item-narrow1').innerText,
            product_name: e.querySelector('span.item-title').innerText ,
            price: e.querySelector('div.item-price').innerText,
            link: e.querySelector('span.item-title a').getAttribute('href'),
            condition: e.querySelectorAll('div.item-specstr')[1].innerText
                };
    });
}

casper.thenOpen('http://search.net-chuko.com/?q=&limit=30&o=0&path=フィルムカメラ&sort=Number2,Number1',function() {
    item_dom = this.evaluate(getitem);
    this.echo(JSON.stringify(item_dom));
});

casper.run();
