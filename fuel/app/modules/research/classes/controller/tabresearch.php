<?php
namespace Research;
use \Ebay;
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Finding\Services;
use \DTS\eBaySDK\Finding\Types;
use \DTS\eBaySDK\Finding\Enums;
use \Goutte\Client;

class Controller_Tabresearch extends \Controller
{
    public function action_index()
    {
        Return \View::forge('tabresearch/index');

    }

    public function action_yahoo()
    {

        // APIのトークン
        $token = 'dj0zaiZpPUZLTFlOR2tOVGJjcCZzPWNvbnN1bWVyc2VjcmV0Jng9NTg-';
        $query = \Input::get('query');
        $page = \Input::get('page')?\Input::get('page'):1;
        if($query){
            // Request_Curlを生成
            $curl = \Request::forge('http://auctions.yahooapis.jp/AuctionWebService/V2/search','curl');
            // HTTPメソッドを指定
            $curl->set_method('get');
            // パラメータを設定
            $curl->set_params(array('appid'=>$token,'output' => 'xml','sort' =>"end",'query' => $query,'page' => $page));
            // 実行
            $response = $curl->execute()->response();
            // レスポンスコードチェック
            $data=array();
            if ($response->status == 200)
            {
                $data = \Format::forge($response->body,'xml')->to_array();
                $data["totalResultsAvailable"] = $data["@attributes"]["totalResultsAvailable"];
                $data["totalResultsReturned"] = $data["@attributes"]["totalResultsReturned"];
                $data["firstResultPosition"] = $data["@attributes"]["firstResultPosition"];
                if($data["totalResultsAvailable"]<=($data["totalResultsReturned"]+ $data["firstResultPosition"])){
                    $data["EOF"] = $data["totalResultsAvailable"];
                }
                // 中身をチェック
                //echo '<pre>';
                //var_dump($data["@attributes"]);
                //echo '</pre>';
            }

            $data["title"] = "YahooSearch";
            Return \View::forge('tabresearch/yahoo',$data);
        }
    }

    public function action_yahoodetail()
    {

        // APIのトークン
        $token = 'dj0zaiZpPUZLTFlOR2tOVGJjcCZzPWNvbnN1bWVyc2VjcmV0Jng9NTg-';
        $auctionid = \Input::get('id');
        if($auctionid){
            // Request_Curlを生成
            $curl = \Request::forge('http://auctions.yahooapis.jp/AuctionWebService/V2/auctionItem','curl');
            // HTTPメソッドを指定
            $curl->set_method('get');
            // パラメータを設定
            $curl->set_params(array('appid'=>$token,'output' => 'xml','auctionid' => $auctionid));
            // 実行
            $response = $curl->execute()->response();
            // レスポンスコードチェック
            $data=array();
            if ($response->status == 200)
            {
                $data = \Format::forge($response->body,'xml')->to_array();
                // 中身をチェック
                //echo '<pre>';
                //var_dump($data["Result"]);
                //echo '</pre>';
            }

            $data["title"] = "YahooDetail";
            Return \View::forge('tabresearch/yahoodetail',$data);
        }


    }


    public function action_ebay($sold = 'sold')
    {

        $data=array();
        $query = \Input::get('query');
        $page = \Input::get('page')?\Input::get('page'):1;

        if($query){
            $config =  array(
                'sandbox' => array(
                    'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                    'appId' => 'TomokiNa-9797-4eda-af65-afed6013a8d8',
                    'certId' => '9c26a657-0ce1-44de-b6e1-03b15300ff45',
                    'userToken' => 'AgAAAA**AQAAAA**aAAAAA**Vdc5VA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJiGqQ2dj6x9nY+seQ**whADAA**AAMAAA**547n2SGblWqVk1YOVjMNoxF6mAvcbUVxpyPuOLe6RwnWA4q5XrTHkc5/1MwnTe4dBx/jZmsqFRBdwuIn6aDnCO8kLxWOzB2YwB0GzMqZE+KveNvs/1vW3dPdpu+JHs2P46QVMDC7IjgYvzaioiBB5gjBTVZwurv0Hso2RE0VIcAko4mz3UfQEBFjbDFvr0mlam5UnLjfiOJQ7QVN7JP8R3Ia7a10JxS0E+u/2lNLZRDeOOlndwlFH89f0rLd+3WM8cNZedGWIayc2TugFcmWBtEYfi1EcLG0hqnzzZoHgLp+OMDWKYh4WSKwmI0Q4IkpxjaP7mHYbI02UU4PehFE9NBOatIm2bx/LNQ3aaUZ+lIcTCz0MF3l/W/Jm7r6txoHc2Q1stDrYCQHSdqG/JhuqKDdw9zwhC/lA/ljZGdB7vWQ8mHZAC8z8RHNIAGKqmUwFBoOGJE4eu4KmTX+C74BesTaAASmFwvdZv1IpocU1XB6qxOiHhnhIRSAP+JIXTioLxOWxKgbfY2FmWEdLBh9MC9cvKQ/T1JSJ4FySAxPkczP/KZV7xpnQkEVyYpwDDfMBojuG1FGMvDY7cbRLU6xfvwJzGBm1g+XSCoiPY9+uvTVPBz9b6qPJt17+ktxi0tPSZnatm+dtbm+LWlLb3B8/bp4YjCltDgE8oiIAIEuNNpWlHOqiOPLKWv7lXAIAGzwaVkQeEtZahpR1FLYlxF0l6rtVdVHupDUY+k/xVwZjBQzq0dg9vJv4X4eqb/tLjuS'
                ),
                'production' => array(
                    'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                    'appId' => 'TomokiNa-b1e9-4e0b-b610-02e89c6545a9',
                    'certId' => '91f50789-7d06-43da-9c99-73096c0fa85b',
                    'userToken' => 'AgAAAA**AQAAAA**aAAAAA**o6OmVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**6nezNrf7PISDaLKR0R8YhfpBVgpgWKtr3zL+0bcpR7vu79SUYZ4Tp0XnVE3/g/odXa3ji1FTVk0ECEkH11zfafkrg9A3yKLubXR+nX3po6IeG9B8UOBg+Omn7WdApp09aQtk0b9Dr1bj+QX9BRUOv/EswHqsdMJ1uhPCIttYIxqGWTcHRMRExMjTt1+1nbgP6bvfq3ZOpnE0UdgSBkhc6Lk0/jl5AV82ynpiprIPKkCGSDgSIILmqAdd5AQwK5lAzLB0kETTKjVXg/HkEzS22+01Agn0hDLQrIRmxEhznJa/QgiW0Rd2nUK4pm7xTB93qee5PzCc6cFy/pnyesDRbWSLt6YcM7k795A0UXafbP5G+atzvleE1ud7Gyk9tyKtndV8rByXUVJ77EH/ceUsU131Q1z0dqni1ZMfNy82ns4cmaxHiYyng/J8gj8hrqq4QFlk/cC3URShkttzZORw6uelySITGCy3MCZY/twgBKDK/hCIoRzkKfNBzVBq1r6UrpxwKEOBFgO8C3w34An/IAwqZVuY0Kfw3MVn/3Evh5CUWCE2yxDaAAWnzFQ6DZnayggfvlf1tiDFkzQbaPQtmnSXyomJdBPZnX9a7X5Xf5l8mbH2qfeAZ2ul5DkvTx4GDdKG9soZI9PG2PIFUF1BHAUWMabM+WTcNCbWewwyozJIGRZx1pcjQR0BtNdBt7LmGtbLx5xeRaAcOJ0bdDiGMCZleWHfoTic4KlP/HI8cPjhcmboHzOuNFfh98G/4XIY'
                ),
                'findingApiVersion' => '1.12.0',
                'tradingApiVersion' => '871',
                'shoppingApiVersion' => '871',
                'halfFindingApiVersion' => '1.2.0'
            );

            /**
             * Create the service object.
             *
             * For more information about creating a service object, see:
             * http://devbay.net/sdk/guides/getting-started/#service-object
             */
            $service = new Services\FindingService(array(
                'appId' => $config['production']['appId'],
                'apiVersion' => $config['findingApiVersion'],
                //'sandbox' => true,
                'globalId' => Constants\SiteIds::US
            ));

            $request = new Types\FindCompletedItemsRequest();

            $request->keywords = $query;

            if($sold==='sold'){
                $request->sortOrder = 'EndTimeSoonest';
                $request->itemFilter[] = new Types\ItemFilter(array(
                    'name' => 'SoldItemsOnly',
                    'value' => array("true")
                ));
            }else{
                $request->sortOrder = 'StartTimeNewest';
                $request->itemFilter[] = new Types\ItemFilter(array(
                    'name' => 'SoldItemsOnly',
                    'value' => array("false")
                ));
            }

            $request->paginationInput = new Types\PaginationInput();
            $request->paginationInput->entriesPerPage = 50;
            $request->paginationInput->pageNumber = (int)$page;

            $response = $service->findCompletedItems($request);

            //echo "==================\nResults for page $pageNum\n==================\n";
            if ($response->ack !== 'Success') {
                if (isset($response->errorMessage)) {
                    foreach ($response->errorMessage->error as $error) {
                        $data["Error"][] =$error->message;
                        //printf("Error: %s\n", $error->message);
                    }
                }
            } else {

                foreach ($response->searchResult->item as $item) {
                    $itemarray = array();
                    $itemarray["itemId"] = $item->itemId;
                    $itemarray["galleryURL"] = $item->galleryURL;
                    $itemarray["viewItemURL"] = $item->viewItemURL;
                    $itemarray["location"] = $item->location;
                    $itemarray["title"] = $item->title;
                    $itemarray["currentPrice"] = $item->sellingStatus->currentPrice->value;
                    $itemarray["shippingServiceCost"] = isset($item->shippingInfo->shippingServiceCost)? $item->shippingInfo->shippingServiceCost->value : 0;
                    $itemarray["endtime"] = isset($item->listingInfo->endTime)? $item->listingInfo->endTime->format('Y-m-d H:i:s') : "";
                    $data["Result"][] =$itemarray;

                    //echo "<pre>";var_dump($item->listingInfo->endTime->format('Y-m-d H:i:s'));
                }
                $data["pageNumber"] =$response->paginationOutput->pageNumber;
                $data["totalEntries"] =$response->paginationOutput->totalEntries;
                $data["totalPages"] =$response->paginationOutput->totalPages;
                $data["entriesPerPage"] =$response->paginationOutput->entriesPerPage;
                if($data["pageNumber"] == $data["totalPages"]){
                    $data["currentEntries"] = (($data["pageNumber"]-1) * $data["entriesPerPage"]+1)."-".$data["totalEntries"];
                }else{
                    $data["currentEntries"] = (($data["pageNumber"]-1) * $data["entriesPerPage"]+1)."-".(($data["pageNumber"]-1) * $data["entriesPerPage"]+$data["entriesPerPage"]);
                }
                if($response->paginationOutput->pageNumber >= $response->paginationOutput->totalPages){
                    $data["EOF"] =$response->paginationOutput->totalEntries;
                }

            }
            //echo "<pre>";var_dump($response);

            $data["title"] = "eBaySearch";
            Return \View::forge('tabresearch/ebay',$data);
        }


    }

    public function action_yahooclosed()
    {
        $data=array();
        $query = \Input::get('query');
        //$page = \Input::get('page')?\Input::get('page'):1;

        if($query){
            $client = new Client();
            // UserAgent Setting
            $client->setHeader('User-Agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 7_0_3 like Mac OS X) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11B511 Safari/9537.53');
            $post = $client->request('GET', "http://closedsearch.auctions.yahoo.co.jp/jp/closedsearch?n=100&p=".$query);

            $videos = $post->filter('section')->each(function( $node )use (&$itemlist){
                $url_array = explode("/",$node->filter('div.tb a')->attr('href'));
                $itemlist[] = array(
                    'item_url' => $node->filter('div.tb a')->attr('href'),
                    'item_image' => $node->filter('img')->attr('src'),
                    'item_title' => $node->filter('h2')->text(),
                    'item_price' => $node->filter('div.elPrice b')->text(),
                    'item_time' => $node->filter('p.time span')->text(),
                    'item_id' => $url_array[5],
                );
            });
            //var_dump($itemlist);
            $data["itemlist"] =$itemlist;
            return \Response::forge(\View::forge('tabresearch/yahooclosed',$data));
        }
    }

    public function action_product(){
        \Module::load('Ebay');

        $user_info = \Auth::get_user_id();
        $where_array = array();
        //$where_array[] = array('inventories.user_id','=',$user_info[1]);
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('query'), 's'), -1, PREG_SPLIT_NO_EMPTY);

        //ユーザIDの指定
        //$where_array[] = array( 'user_id', '=', $user_info[1] );
        //キーワードの指定
        foreach($ary_keyword as $keyword){
            $where_array[] = array('PRODUCT_NAME','like','%'.$keyword.'%');
        };
        //メーカの指定
        if(\Input::get('maker')){
            $where_array[] = array('MAKER','=',\Input::get('maker'));
        }
        $condition = array('where'=> $where_array);
        $data['count'] = Ebay\Model_Product::query($condition)->count();
        $data['products'] = Ebay\Model_Product::find('all',$condition);

        $data["title"] = "Products";
        Return \View::forge('tabresearch/product',$data);
    }

    public function action_productedit(){
        \Module::load('Ebay');

        if (\Input::method() == 'POST')
        {
            $val = Ebay\Model_Product::validate('create');

            if ($val->run())
            {
                $user_info = \Auth::get_user_id();
                $product = Ebay\Model_Product::forge(array(
                    'user_id' => '8',
                    'product_name' => \Input::post('product_name'),
                    'category' => \Input::post('category'),
                    'maker' => \Input::post('maker'),
                    'model' => \Input::post('model'),
                    'option_1' => \Input::post('option_1'),
                    'option_2' => \Input::post('option_2'),
                    'in_upper_price' => \Input::post('in_upper_price'),
                    'in_mean_price' => \Input::post('in_mean_price'),
                    'in_lower_price' => \Input::post('in_lower_price'),
                    'out_upper_price' => \Input::post('out_upper_price'),
                    'out_mean_price' => \Input::post('out_mean_price'),
                    'out_lower_price' => \Input::post('out_lower_price'),
                    'out_search_count' => \Input::post('out_search_count'),
                    'comment' => \Input::post('comment'),
                ));

                if ($product and $product->save())
                {
                    \Session::set_flash('success', 'Added product #'.$product->product_id.'.');

                    \Response::redirect('research/tabresearch');
                }

                else
                {
                    \Session::set_flash('error', 'Could not save product.');
                }
            }
            else
            {
                \Session::set_flash('error', $val->error());
            }
        }

        $data["title"] = "Products";
        Return \View::forge('tabresearch/productedit',$data);
    }

    public function action_auctionadd(){
        \Module::load('Yahoo');

        if (\Input::method() == 'GET')
        {
            $data['auction_id'] = \Input::get('auction_id');

        }
        if (\Input::method() == 'POST')
        {
            $val = \Yahoo\Model_Auctionbit::validate('create');

            if ($val->run())
            {
                $user_info = \Auth::get_user_id();

                $auctionbit = \Yahoo\Model_Auctionbit::forge(array(
                    'user_id' => $user_info[1],
                    'auction_id' => \Input::post('auction_id'),
                    'auction_url' => \Input::post('auction_url'),
                    'auction_title' => \Input::post('auction_title'),
                    'current_price' => \Input::post('current_price'),
                    'buyout_price' => \Input::post('buyout_price'),
                    'start_date' => \Input::post('start_date'),
                    'end_date' => \Input::post('end_date'),
                    'bitreservation' => \Input::post('bitreservation'),
                    'budget_price' => \Input::post('budget_price'),
                    'sale_price' => \Input::post('sale_price'),
                    'product_id' => \Input::post('product_id'),
                    'product_name' => \Input::post('product_name'),
                    'condition' => \Input::post('condition'),
                    'comment' => \Input::post('comment')
                ));

                if ($auctionbit and $auctionbit->save())
                {
                    \Session::set_flash('success', 'Added product #'.$auctionbit->id.'.');
                }

                else
                {
                    \Session::set_flash('error', 'Could not save product.');
                }
            }
            else
            {
                \Session::set_flash('error', $val->error());
            }
        }

        $data["title"] = "auctionbit";
        Return \View::forge('tabresearch/auctionadd',$data);
    }

    public function action_yahoomywatch()
    {
        \Module::load('Yahoo');

        $yauction = new \Yahoo\Yauction();
        $yauction->setRequestUri(\Uri::base().'yahoo/myauction/index');

        $open_id = 'DGKC2IO4SR6W3HG6IKFKISTI6U';
        if($open_id){
            $env = \Yahoo\Model_Yauctiontoken::getAccessToken($open_id);
            $yauction->setTokenFromDb($env);

            $result = $yauction->myWatchList();
            if($result === 'Invalid Token'){
                $yauction->refreshToken();

                $env = \Yahoo\Model_Yauctiontoken::getAccessToken($open_id);
                $yauction->setTokenFromDb($env);

                $result= $yauction->myWatchList();

            }else if($result === 'Invalid Request'||$result === 'Other Error'){
                \Session::set_flash('error', e('Error :' . $result));

            }else if($result){
                \Session::set_flash('success', e('Updated myauction '));

            }
            //var_dump($result);
            $data = $result;

            $data["title"] = "MyWatch";
            Return \View::forge('tabresearch/mywatch',$data);
        }
    }

}
