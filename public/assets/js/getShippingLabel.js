var fs = require('fs')
var count = 1;
var casper = require("casper").create({viewportSize: { width: 1800, height: 768 }});

casper.userAgent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36");
casper.on('page.resource.received', function (resource) {
    "use strict";
    if ((resource.url.indexOf("Invoice") !== -1) ) {
        count = count +1;
        this.echo(resource.url);
        this.echo(resource.contentType);
        var url, file;
        url = resource.url;
        fs.write(count + '1.pdf', page.content, 'w');
        file = count + "stats.pdf";
        try {
            this.echo("Attempting to download file " + file);
            var fs = require('fs');
            casper.download(resource, fs.workingDirectory+'/'+file);
        } catch (e) {
            this.echo(e);
        }
    }
});
casper.on("downloaded.file", function(targetPath){
    this.echo("dl.file: " + targetPath);
});
casper.start();
casper.open('https://labelprint.ebay.co.jp/views/shared/login.aspx');

casper.then(function() {
    this.echo("待機開始");
    this.waitFor(function check() {
        return this.evaluate(function() {
            return document.querySelectorAll('input[name="ctl06"]').length >= 1;
        });
    }, function() {
        this.echo("待機終了");
        casper.capture("1.png");
        this.mouseEvent("click", 'input[name="ctl06"]');
    });

});

casper.then(function() {
    this.waitFor(function check() {
        return this.evaluate(function() {
            return document.querySelectorAll('input[placeholder="Email or username"].fld').length >= 1;
        });
    }, function() {
        this.echo("待機終了2");
        this.evaluate(function(Email,Password) {
            document.querySelector('input[placeholder="Email or username"].fld').value = Email;
            document.querySelector('input[placeholder="Password"].fld').value = Password;
            document.querySelector('form[name="SignInForm"]').submit();
            return true;
        },"eb.tom.signum@gmail.com","E-Neurf-Al");
    });
});

casper.then(function() {
    this.wait(5000, function() {
        this.echo("オープン");
        casper.capture("3.png");
        var cookies = JSON.stringify(phantom.cookies)
        fs.write("cookie2.txt", cookies, 644)
    });
});


casper.then(function(){
    this.sendKeys('input[name="itemName0"]', "used camera");
    this.sendKeys('input[name="weight0"]', "500");
    this.sendKeys('input[name="amount0"]', "100");
    this.evaluate(function(origin) {
        //document.querySelector('input[ng-model="item.checked"]').value = itemName;
        //document.querySelector('input[name="itemName0"]').value = itemName;
        //document.querySelector('input[name="weight0"]').value = weight;
        //document.querySelector('input[name="amount0"]').value = amount;
        document.querySelector('input[name="origin0"]').value = origin;
        return true;
    },"JP");
});

casper.then(function(){
    this.mouseEvent("click", 'input[ng-model="item.checked"]');
});

casper.then(function() {
    this.wait(500, function() {
        this.echo("チェック");
        casper.capture("3.png");
    });
});

casper.then(function() {
    this.wait(500, function() {
        casper.capture("4.png");
        this.mouseEvent("click", 'button[title="ラベルを発行します。"]');
    });
});

casper.then(function() {
    this.wait(500, function() {
        this.echo("ダウンロード");
        casper.capture("5.png");
    });
});
casper.then(function() {
    this.wait(10000, function() {
        this.echo("ダウンロード10秒後");
        casper.capture("6.png");
    });
});

casper.run();


