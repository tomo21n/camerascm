var fs = require('fs');
var links;
var casper = require("casper").create();
if (casper.cli.has(0)){
    id = casper.cli.get(0);
}else{
    id = '1';
}

function getLinks() {
    var links = document.querySelectorAll('center img');
    return Array.prototype.map.call(links, function(e) {
        return e.getAttribute('src');
    });
}
function getphoto(links){
    //var path = (fs.workingDirectory) + "/" + id;
    var path ="/var/www/html/dev_camerascm/public/assets/img/photo/" + id;
    var photoarray = [];
    fs.makeDirectory(path);
    for (var i=0;i<links.length;i++){
        casper.download(links[i],path + "/" + id + "-" + (i+1) + ".jpg");
        photoarray.push(id + "-" + (i+1) + ".jpg");
    }
    return photoarray;
}
casper.start();
casper.open('http://www.east-japan-trade.jp/oss/login.php', {
    method: 'post',
    data:   {
        'email': 'eb.tom.signum@gmail.com',
        'pass':  'toporon'
    }
});

casper.thenOpen('http://www.east-japan-trade.jp/oss/photo_html.php?no='+ id);
casper.then(function() {
    links = this.evaluate(getLinks);
});
casper.then(function() {
    photoname = getphoto(links);
    var outputobj = {
        download_name :photoname,
        download_url   :links
    };
    this.echo(JSON.stringify(outputobj));

});

casper.run();


