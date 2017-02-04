var casper = require("casper").create();
//var input_url = "https://member.kitamura.jp/sso/login.html";
casper.userAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.74.9 (KHTML, like Gecko) Version/7.0.2 Safari/537.74.9");

casper.start();

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
    var item = document.querySelectorAll('.htmtableborders tr');
    return Array.prototype.map.call(item, function(e) {
       return  { item_html:  e.innerHTML
           // price: e.querySelector('td').innerText
            //link: e.querySelector('a').getAttribute('href')
        };
    });
}

casper.thenOpen('http://asbe-z.co.jp/stock/index.html',function() {
    item_dom = this.evaluate(getitem);
    this.echo(JSON.stringify(item_dom));
});

casper.run();
