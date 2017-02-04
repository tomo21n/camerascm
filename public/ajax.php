<?php
if(isset($_GET["url"]) && preg_match("/^https?:/",$_GET["url"])){

    $opts = array('http' =>
        array(
            'method'=> "GET",
            'header' => "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_3 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B511 Safari/9537.53"
        )
    );
    $context = stream_context_create($opts);
    $url = $_GET["url"];
    //$contents = file_get_contents($url);
    $contents = file_get_contents($url, false, $context);
    $pattern = '/<section>(.*?)<\/section>/s';
    //preg_match_all("/<img(.+?)>/", $contents, $matches);
    $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'ASCII, JIS, UTF-8, EUC-JP, SJIS');
    preg_match_all($pattern, $contents, $itemlist);

    //foreach($itemlist[0] as $item){
        $domDocument = new DOMDocument();
        $domDocument->loadHTML($itemlist[0][0]);
        $xmlString = $domDocument->saveXML();
        $xmlObject = simplexml_load_string($xmlString);
    echo '<pre>';
    var_dump($xmlObject->body->section->div);
    echo '</pre>';;
    //};

    //var_dump($contents); // 確認用
}else{
    echo "error";
}