var fs = require('fs');
var links;
var casper = require("casper").create();
if (casper.cli.has(0)){
    id = casper.cli.get(0);
}else{
    id = '1';
}

casper.start();
casper.open('http://www.east-japan-trade.jp/oss/login.php', {
    method: 'post',
    data:   {
        'email': 'eb.tom.signum@gmail.com',
        'pass':  'toporon'
    }
});

casper.thenOpen('http://www.east-japan-trade.jp/oss/main.php',function() {
    Specifiedline = this.evaluate(function(id){
        var links = document.querySelectorAll('#main-echo tbody tr');
        var Number = 1;
        var Linetext;
        var LineNode;
        var Specifiedline;
        do{
            Number = Number + 1;
            LineNode = links[Number].querySelectorAll('td');
            Linetext = Array.prototype.map.call(LineNode, function(e) {
                return e.innerText;
            });
            var gaityunoExp = new RegExp(id);
            if ( Linetext[0].match(gaityunoExp)) {
                Specifiedline = Linetext;
                break;
            }

        }while(Number < 200);

        return Specifiedline;

        }
    ,id);
    ejt_id = Specifiedline[0];
    status = Specifiedline[1];
    title = Specifiedline[3];
    weight = Specifiedline[4];
    shippingcost = Specifiedline[8];
    trackingno = Specifiedline[10];
    var outputobj = {
        ejt_id :ejt_id,
        status :status,
        title :title,
        weight :weight,
        shippingcost :shippingcost,
        trackingno :trackingno
    };
    this.echo(JSON.stringify(outputobj));
    //this.echo(ejt_id);
});

casper.run();


