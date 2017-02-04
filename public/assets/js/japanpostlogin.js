var inputdata;
var casper = require("casper").create();
casper.start();
casper.open('http://dev.world-viewing.com/ebay/orderrest.json', {
    method: 'post',
    data:   {
        'order_id': '251772080470-1576890799015',
        'user_id':  '8'
    }
});

casper.then(function() {
    inputdata = JSON.parse(casper.getPageContent());
    this.echo(inputdata.sale_title);
});

casper.run();

/*
//日本語環境に変更
casper.then(function() {
    this.evaluate(function() {
        document.querySelector("select[name='localeSel']").value = 'ja';
        return true;
    });
    this.waitFor(function check() {
        return this.evaluate(function() {
            return document.querySelectorAll('input.txt_form_button').length >= 1;
        });
    }, function() {
        this.mouseEvent("click", "input.txt_form_button");
    });

});

casper.then(function() {
    this.sendKeys("input[name='loginBean.id']", "monkey.tom.signum@gmail.com");
    this.sendKeys("input[name='loginBean.pw']", "rjfr4299");
    this.waitFor(function check() {
        return this.evaluate(function() {
            return document.querySelectorAll('input.txt_form_button').length >= 1;
        });
    }, function() {
        this.mouseEvent("click", x('//*[@id="loaded"]/table/tbody/tr[2]/td[2]/table/tbody/tr[2]/td/table/tbody/tr[1]/td/table/tbody/tr[2]/td[1]/table[1]/tbody/tr[2]/td[2]/div/table[2]/tbody/tr/td[2]/a'));
    });
});

fs.write("cookie.txt", cookies, 644);
*/

// 処理を開始する
casper.run();