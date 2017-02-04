<?php
//namespace Ebay;

/**
 * The namespaces provided by the SDK.
 */
use \Goutte\Client;

class Controller_Parse extends \Controller{

	public function action_index()
	{

	}

    public function action_yahooclosedsearch($word)
    {
        $client = new Client();
        // UserAgent Setting
        $client->setHeader('User-Agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_3 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B511 Safari/9537.53');
        $post = $client->request('GET', "http://closedsearch.auctions.yahoo.co.jp/jp/closedsearch?p=".$word);

        $videos = $post->filter('section')->each(function( $node )use (&$itemlist){
            $itemlist[] = array(
                'item_url' => $node->filter('div.tb a')->attr('href'),
                'item_image' => $node->filter('img')->attr('src'),
                'item_title' => $node->filter('h2')->text(),
                'item_price' => $node->filter('div.elPrice b')->text(),
                'item_time' => $node->filter('p.time span')->text(),
            );
        });
        //var_dump($itemlist);
        $data["itemlist"] =$itemlist;
        return Response::forge(View::forge('yahooclosedsearch',$data));

    }

    public function action_ebayclosedsearch($word)
    {
        $client = new Client();
        // UserAgent Setting
        $client->setHeader('User-Agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_3 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B511 Safari/9537.53');
        $post = $client->request('GET', "http://m.ebay.com/sch/i.html?_nkw=".$word."&_pgn=1&LH_ItemCondition=4&LH_Complete=1&_sop=1&LH_Sold=1&from=refine");
        $videos = $post->filter('div.srchNtry')->each(function( $node )use (&$itemlist){
            $itemlist[] = array(
                'item_url' => $node->filter('a')->attr('href'),
                'item_image' => $node->filter('img')->attr('src'),
                'item_title' => $node->filter('div.myEbayStamps ')->text(),
                'item_price' => $node->filter('div.prcTxt')->text(),
                'item_time' => $node->filter('span.tmLft')->attr('endutctime'),
            );
        });
        //var_dump($itemlist);
        $data["itemlist"] =$itemlist;
        return Response::forge(View::forge('yahooclosedsearch',$data));

    }

    public function action_view($id = null)
	{
		$data['salesPart'] = Model_SalesPart::find($id);

		$this->template->title = "SalesPart";
		$this->template->content = View::forge('salespart/view', $data);

	}

}