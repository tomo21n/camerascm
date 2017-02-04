<?php
namespace Yahoo;
class Controller_AuctionBit extends \Controller_User{

    public static $bitstatus = array(
        'NotReserve' => '未予約',
        'Reserve' => '予約',
        'Registered' => '予約登録済',
        'NotRegistered' => '登録出来ず',
        'Closed' => '終了',
    );

    public function action_index()
    {
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('word'), 's'), -1, PREG_SPLIT_NO_EMPTY);

        //ユーザIDの指定
        //$where_array[] = array( 'user_id', '=', $user_info[1] );
        //キーワードの指定
        foreach($ary_keyword as $keyword){
            $where_array[] = array('PRODUCT_NAME','like','%'.$keyword.'%');
        };
        //メーカの指定
        if(\Input::get('bitreservation')){
            $where_array[] = array('bitreservation','=',\Input::get('bitreservation'));
        }else{
            $where_array[] = array('bitreservation','=','Reserve');
        }
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Auctionbit::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/auctionbit/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('order_by' => array('end_date'=>'desc'));
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);

        $data['auctionbit'] = Model_Auctionbit::find('all',$condition);
        $this->template->title = "AuctionBit";
        $this->template->content = \View::forge('auctionbit/index', $data);

    }


	public function action_view($id = null)
	{
		$data['auctionbit'] = Model_Yauctionsell::find($id);

		$this->template->title = "auctionbit";
		$this->template->content = \View::forge('auctionbit/view', $data);

	}

	public function action_create()
	{

        \Module::load('Ebay');

        if (\Input::method() == 'POST')
		{
			$val = Model_Auctionbit::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();

                $auctionbit = Model_Auctionbit::forge(array(
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
					\Session::set_flash('success', e('Added auctionbit #'.$auctionbit->id.'.'));

					\Response::redirect('yahoo/auctionbit');
				}

				else
				{
					\Session::set_flash('error', e('Could not save auctionbit.'));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "auctionbits";
		$this->template->content = \View::forge('auctionbit/create');

	}

	public function action_edit($id = null)
	{
        \Module::load('Ebay');

        $auctionbit = Model_Auctionbit::find($id);
		$val = Model_Auctionbit::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();

            $auctionbit->user_id = $user_info[1];
            $auctionbit->auction_id = \Input::post('auction_id');
            $auctionbit->auction_url = \Input::post('auction_url');
            $auctionbit->auction_title = \Input::post('auction_title');
            $auctionbit->current_price = \Input::post('current_price');
            $auctionbit->buyout_price = \Input::post('buyout_price');
            $auctionbit->start_date = \Input::post('start_date');
            $auctionbit->end_date = \Input::post('end_date');
            $auctionbit->bitreservation = \Input::post('bitreservation');
            $auctionbit->budget_price = \Input::post('budget_price');
            $auctionbit->sale_price = \Input::post('sale_price');
            $auctionbit->product_id = \Input::post('product_id');
            $auctionbit->product_name = \Input::post('product_name');
            $auctionbit->condition = \Input::post('condition');
            $auctionbit->comment = \Input::post('comment');

			if ($auctionbit->save())
			{
				\Session::set_flash('success', e('Updated auctionbit #' . $id));

				\Response::redirect('yahoo/auctionbit');
			}

			else
			{
				\Session::set_flash('error', e('Could not update auctionbit #' . $id));
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $auctionbit->user_id = $val->validated('user_id');
                $auctionbit->auction_id = $val->validated('auction_id');
                $auctionbit->auction_url = $val->validated('auction_url');
                $auctionbit->auction_title = $val->validated('auction_title');
                $auctionbit->current_price = $val->validated('current_price');
                $auctionbit->buyout_price = $val->validated('buyout_price');
                $auctionbit->start_date = $val->validated('start_date');
                $auctionbit->end_date = $val->validated('end_date');
                $auctionbit->bitreservation = $val->validated('bitreservation');
                $auctionbit->budget_price = $val->validated('budget_price');
                $auctionbit->sale_price = $val->validated('sale_price');
                $auctionbit->product_id = $val->validated('product_id');
                $auctionbit->product_name = $val->validated('product_name');
                $auctionbit->condition = $val->validated('condition');
                $auctionbit->comment = $val->validated('comment');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('auctionbit', $auctionbit, false);
		}

		$this->template->title = "auctionbits";
		$this->template->content = \View::forge('auctionbit/edit');

	}

	public function action_delete($id = null)
	{
		if ($auctionbit = Model_Auctionbit::find($id))
		{
			$auctionbit->delete();

			\Session::set_flash('success', e('Deleted auctionbit #'.$id));
		}

		else
		{
			\Session::set_flash('error', e('Could not delete auctionbit #'.$id));
		}

		\Response::redirect('yahoo/auctionbit');

	}

    public static function update_detail(){

        $where_array=array();
        $where_array[] = array(array('bitreservation','=','Reserve'),'or'=>array('bitreservation','=','Registered'));
        $condition = array('where'=> $where_array);

        $auctionbitlist = Model_Auctionbit::find('all',$condition);

        //echo '<pre>';
        //var_dump($auctionbitlist);
        //echo '</pre>';

        foreach($auctionbitlist as $auctionbititem){

            $auctionbit = Model_Auctionbit::find($auctionbititem['id']);

            // APIのトークン
            $token = 'dj0zaiZpPUZLTFlOR2tOVGJjcCZzPWNvbnN1bWVyc2VjcmV0Jng9NTg-';
            if($auctionbit){
                // Request_Curlを生成
                $curl = \Request::forge('http://auctions.yahooapis.jp/AuctionWebService/V2/auctionItem','curl');
                // HTTPメソッドを指定
                $curl->set_method('get');
                // パラメータを設定
                $curl->set_params(array('appid'=>$token,'output' => 'xml','auctionid' => $auctionbititem['auction_id']));
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

                    $auctionbit->auction_title = $data["Result"]["Title"];
                    $auctionbit->current_price = $data["Result"]["Price"];
                    $auctionbit->buyout_price = isset($data["Result"]["Bidorbuy"])?$data["Result"]["Bidorbuy"] :null;
                    $auctionbit->start_date = $data["Result"]["StartTime"];
                    $auctionbit->end_date = $data["Result"]["EndTime"];

                    if($data["Result"]["Price"] > $auctionbit->budget_price){

                        $auctionbit->bitreservation = 'NotRegistered';

                    }

                    // 今日の日付を取得
                    $dt = new \DateTime();
                    $dt->setTimeZone(new \DateTimeZone('Asia/Tokyo'));
                    $current_time = $dt->format('Y-m-d H:i:s');
                    if(strtotime($data["Result"]["EndTime"]) < strtotime($current_time)){

                        $auctionbit->bitreservation = 'Closed';

                    }


                    if (!$auctionbit->save())
                    {
                        return false;
                    }

                }

            }

            $auctionbit = null;


        }


    }


}