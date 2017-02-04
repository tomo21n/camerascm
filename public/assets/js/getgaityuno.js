var casper = require("casper").create();
var name;
var title;
var memo;
var flug;

if (casper.cli.has(0)){
    name = casper.cli.get(0);
}else{
    ret = false;
}
if (casper.cli.has(1)){
    title = casper.cli.get(1);
}else{
    title = ' ';
}
if (casper.cli.has(2)){
    flug = casper.cli.get(2);
}else{
    flug = 0;
}

if (casper.cli.has(3)){
    memo = casper.cli.get(3);
}else{
    memo = ' ';
}


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

casper.thenOpen('http://www.east-japan-trade.jp/oss/regist.php',{
    method: 'post',
    data:   {
        'name1': '[' + title +']' + name,
        'flug1': flug,
        'syupin_title1': title,
        'memo1': memo,
        'method': '登録'
    }
});
/*
casper.then(function() {
    this.echo(this.getHTML('form')); // => 'Plop'
});
*/
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

