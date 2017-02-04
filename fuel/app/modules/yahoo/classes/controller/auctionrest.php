<?php
namespace Yahoo;
class Controller_Auctionrest extends \Controller_Rest
{

    public function get_auctiondetail()
    {
        // APIのトークン
        $token = 'dj0zaiZpPUZLTFlOR2tOVGJjcCZzPWNvbnN1bWVyc2VjcmV0Jng9NTg-';
        $auctionid = \Input::get('auction_id');
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
                $start_time = new \DateTime($data["Result"]["StartTime"]);
                $end_time = new \DateTime($data["Result"]["EndTime"]);
                $data["Result"]["StartTime"]= $start_time->format('Y-m-d H:i:s');
                $data["Result"]["EndTime"]= $end_time->format('Y-m-d H:i:s');
                // 中身をチェック
                //echo '<pre>';
                //var_dump($data["Result"]["StartTime"]);
                //echo '</pre>';
            }

        }
        $this->response($data);

    }

    public function get_auctionbit()
    {
        Controller_AuctionBit::update_detail();


        $where_array=array();

        $where_array[] = array('bitreservation','=',\Input::get('bit'));
        $condition = array('where'=> $where_array);

        $data = Model_Auctionbit::find('first',$condition);

        if(count($data) <> 0){

            $this->response($data);

        }else{
            $data["Error"] = "No more Reserve list";

            $this->response($data);

        }

    }

    public function get_bitchange()
    {
        $where_array=array();

        if(\Input::get('id')
            && isset(Controller_AuctionBit::$bitstatus[\Input::get('frombit')])
            && isset(Controller_AuctionBit::$bitstatus[\Input::get('tobit')])){

            $auctionbit = Model_Auctionbit::find(\Input::get('id'));

            if($auctionbit->bitreservation == \Input::get('frombit')){
                $auctionbit->bitreservation = \Input::get('tobit');

                if ($auctionbit->save())
                {
                    $data["Result"] = "Success";
                }

            }else{
                $data["Error"] = "Failed.From bit is incorrect";
            }

        }else{
            $data["Error"] = "Failed";
        }
        $this->response($data);

    }


    public function get_auctionbitcreate()
    {
        $where_array=array();

        $auctionbit = Model_Auctionbit::forge(array(
            'user_id' => \Input::get('user_id'),
            'auction_id' => \Input::get('auction_id'),
            //'auction_url' => \Input::post('auction_url'),
            //'auction_title' => \Input::post('auction_title'),
            //'current_price' => \Input::post('current_price'),
            //'buyout_price' => \Input::post('buyout_price'),
            //'start_date' => \Input::post('start_date'),
            //'end_date' => \Input::post('end_date'),
            'bitreservation' => 'Reserve',
            'budget_price' => \Input::get('budget_price'),
            //'sale_price' => \Input::post('sale_price'),
            //'product_id' => \Input::post('product_id'),
            //'product_name' => \Input::post('product_name'),
            //'condition' => \Input::post('condition'),
            'comment' => \Input::get('comment')
        ));

        if ($auctionbit and $auctionbit->save())
        {
            $data['Success'] = 'Success';
        }

        else
        {
            $data['Error'] = 'Error';
        }

        $this->response($data);

    }


}