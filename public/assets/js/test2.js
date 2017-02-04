var casper = require("casper").create();
casper.start();
casper.open('https://labelprint.ebay.co.jp/views/shared/login.aspx');
casper.then(function() {
    this.echo("待機開始");
    this.capture("/var/www/html/dev_camerascm/public/assets/img/photo/1.png");
});

// 処理を開始する
casper.run();
