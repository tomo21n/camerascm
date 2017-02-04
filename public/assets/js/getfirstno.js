var casper = require("casper").create();
var lines;

function getfirstline() {
    var links = document.querySelectorAll('#main-echo tbody tr');
    var No = links[1].querySelectorAll('td');
    return Array.prototype.map.call(No, function(e) {
        return e.innerText;
    });
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
    firstline = this.evaluate(getfirstline);
    ejt_id = firstline[0];
    status = firstline[2];
    name = firstline[3];
    title = firstline[4];
    date = firstline[5];
    var outputobj = {
        ejt_id :ejt_id,
        status :status,
        name :name,
        title :title,
        date :date
    };
    this.echo(JSON.stringify(outputobj));
});

casper.run();

