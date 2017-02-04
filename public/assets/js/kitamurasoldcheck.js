var casper = require("casper").create();
var fs = require('fs');
var input_url = "http://www.net-chuko.com/buy/detail.do?ac=2147840046169";
casper.userAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_2) AppleWebKit/537.74.9 (KHTML, like Gecko) Version/7.0.2 Safari/537.74.9");
if (casper.cli.has(0)){
    input_url = casper.cli.get(0);
}
casper.start();

casper.thenOpen(input_url,function() {
    this.echo(this.getTitle());
});
casper.run();
