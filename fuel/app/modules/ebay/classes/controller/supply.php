<?php
namespace Ebay;

use Yahoo\Model_Auctionbit;

class Controller_Supply extends \Controller_User
{

    public static $shipping_cost = array(
        '発払' => '発払',
        '着払' => '着払',
        '無料' => '無料',
    );
    public static $supply_channel = array(
        'YahooAuction' => 'YahooAuction',
        'NetStore' => 'NetStore',
        'RealStore' => 'RealStore',
        'Other' => 'Other',
    );

	public function action_index()
	{
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('word'), 's'), -1, PREG_SPLIT_NO_EMPTY);

        //ユーザIDの指定
        $where_array[] = array( 'user_id', '=', $user_info[1] );
        //キーワードの指定
        foreach($ary_keyword as $keyword){
            $where_array[] = array('product_name','like','%'.$keyword.'%');
        };
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Supply::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/order/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );

        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('order_by' => array('supply_date'=>'desc'));
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['supplies'] = Model_Supply::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Supplies";
		$this->template->content = \View::forge('supply/index', $data);

	}

	public function action_view($id = null)
	{
		$data['supply'] = Model_Supply::find($id);

		$this->template->title = "Supply";
		$this->template->content = \View::forge('supply/view', $data);

	}

	public function action_create()
	{
        \Module::load('Yahoo');

        if (\Input::method() == 'POST')
		{
			$val = Model_Supply::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();
				$supply = Model_Supply::forge(array(
					'user_id' => $user_info[1],
					'auction_id' => \Input::post('auction_id'),
					'supply_date' => \Input::post('supply_date'),
					'supply_channel' => \Input::post('supply_channel'),
					'supplier_id' => \Input::post('supplier_id'),
					'auction_title' => \Input::post('auction_title'),
					'supply_price' => \Input::post('supply_price'),
					'supply_tax' => \Input::post('supply_tax'),
                    'supply_cost' => \Input::post('supply_cost'),
                    'supply_payment_bank' => \Input::post('supply_payment_bank'),
                    'supply_shipping' => \Input::post('supply_shipping'),
                    'supply_shipping_payment_bank' => \Input::post('supply_shipping_payment_bank'),
					'product_id' => \Input::post('product_id'),
					'product_name' => \Input::post('product_name'),
					'condition' => \Input::post('condition'),
					'sale_price' => \Input::post('sale_price'),
					'comment' => \Input::post('comment'),
				));

				if ($supply and $supply->save())
				{
                    $yauctionwon = \Yahoo\Model_Yauctionwon::find('first',array('where' => array('auction_id' => \Input::post('auction_id'))));
                    if($yauctionwon){
                        $yauctionwon->status = 'Supplied';
                        $yauctionwon->save();
                    }
                    \Session::set_flash('success', e('Added supply #'.$supply->auction_title.'.'));

                    \Response::redirect('ebay/supply');
				}

				else
				{
                    \Session::set_flash('error', e('Could not save supply.'));
				}
			}
			else
			{
                \Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Supplies";
		$this->template->content = \View::forge('supply/create');

	}

	public function action_edit($id = null)
	{
        \Module::load('Yahoo');

        $supply = Model_Supply::find($id);
		$val = Model_Supply::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();
			$supply->user_id = $user_info[1];
			$supply->auction_id = \Input::post('auction_id');
			$supply->supply_date = \Input::post('supply_date');
			$supply->supply_channel = \Input::post('supply_channel');
			$supply->supplier_id = \Input::post('supplier_id');
			$supply->auction_title = \Input::post('auction_title');
			$supply->supply_price = \Input::post('supply_price');
			$supply->supply_tax = \Input::post('supply_tax');
            $supply->supply_cost = \Input::post('supply_cost');
            $supply->supply_payment_bank = \Input::post('supply_payment_bank');
            $supply->supply_shipping = \Input::post('supply_shipping');
            $supply->supply_shipping_payment_bank = \Input::post('supply_shipping_payment_bank');
			$supply->product_id = \Input::post('product_id');
			$supply->product_name = \Input::post('product_name');
			$supply->condition = \Input::post('condition');
			$supply->sale_price = \Input::post('sale_price');
			$supply->comment = \Input::post('comment');

			if ($supply->save())
			{
                $yauctionwon = \Yahoo\Model_Yauctionwon::find('first',array('where' => array('auction_id' => \Input::post('auction_id'))));
                $yauctionwon->status = 'Supplied';
                $yauctionwon->save();
                \Session::set_flash('success', e('Updated supply #' . $id));

                \Response::redirect('ebay/supply');
			}

			else
			{
                \Session::set_flash('error', e('Could not update supply #' . $id));
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$supply->user_id = $val->validated('user_id');
				$supply->auction_id = $val->validated('auction_id');
				$supply->supply_date = $val->validated('supply_date');
				$supply->supply_channel = $val->validated('supply_channel');
				$supply->supplier_id = $val->validated('supplier_id');
				$supply->auction_title = $val->validated('auction_title');
				$supply->supply_price = $val->validated('supply_price');
				$supply->supply_tax = $val->validated('supply_tax');
                $supply->supply_cost = $val->validated('supply_cost');
                $supply->supply_payment_bank = $val->validated('supply_payment_bank');
                $supply->supply_shipping = $val->validated('supply_shipping');
				$supply->supply_shipping_payment_bank = $val->validated('supply_shipping_payment_bank');
				$supply->product_id = $val->validated('product_id');
				$supply->product_name = $val->validated('product_name');
				$supply->condition = $val->validated('condition');
				$supply->sale_price = $val->validated('sale_price');
				$supply->comment = $val->validated('comment');

                \Session::set_flash('error', $val->error());
			}

			$this->template->set_global('supply', $supply, false);
		}

		$this->template->title = "Supplies";
		$this->template->content = \View::forge('supply/edit');

	}

    public function action_auctionsupply($yauction_id)
    {
        \Module::load('Yahoo');

        if (\Input::method() == 'POST')
        {
            $val = Model_Supply::validate('create');

            if ($val->run())
            {
                $user_info = \Auth::get_user_id();
                $supply = Model_Supply::forge(array(
                    'user_id' => $user_info[1],
                    'auction_id' => \Input::post('auction_id'),
                    'supply_date' => \Input::post('supply_date'),
                    'supply_channel' => \Input::post('supply_channel'),
                    'supplier_id' => \Input::post('supplier_id'),
                    'auction_title' => \Input::post('auction_title'),
                    'supply_price' => \Input::post('supply_price'),
                    'supply_tax' => \Input::post('supply_tax'),
                    'supply_cost' => \Input::post('supply_cost'),
                    'supply_payment_bank' => \Input::post('supply_payment_bank'),
                    'supply_shipping' => \Input::post('supply_shipping'),
                    'supply_shipping_payment_bank' => \Input::post('supply_shipping_payment_bank'),
                    'product_id' => \Input::post('product_id'),
                    'product_name' => \Input::post('product_name'),
                    'condition' => \Input::post('condition'),
                    'sale_price' => \Input::post('sale_price'),
                    'comment' => \Input::post('comment'),
                ));

                if ($supply and $supply->save())
                {
                    $yauctionwon = \Yahoo\Model_Yauctionwon::find('first',array('where' => array('auction_id' => \Input::post('auction_id'))));
                    $yauctionwon->status = 'Supplied';
                    $yauctionwon->save();
                    \Session::set_flash('success', e('Added supply #'.$supply->id.'.'));

                    \Response::redirect('ebay/supply');
                }

                else
                {
                    \Session::set_flash('error', e('Could not save supply.'));
                }
            }
            else
            {
                \Session::set_flash('error', $val->error());
            }
        }else{
            if (!is_null($yauction_id))
            {
                $myauction = \DB::select()->from('yauction_won')->where('id', $yauction_id)->as_object()->execute();
                $where_array=array();
                $where_array[] = array('auction_id','=',$myauction[0]->auction_id);
                $condition = array('where'=> $where_array);
                $auctionbit = Model_Auctionbit::find('first',$condition);

                $user_info = \Auth::get_user_id();
                $supply = Model_Supply::forge(array(
                    'user_id' => $user_info[1],
                    'auction_id' => $myauction[0]->auction_id,
                    'supply_date' => date('Y/m/d', strtotime($myauction[0]->end_time)),
                    'supply_channel' => 'YahooAuction',
                    'supplier_id' => $myauction[0]->seller_id,
                    'auction_title' => $myauction[0]->title,
                    'supply_price' => $myauction[0]->won_price,
                    'product_id'=>isset($auctionbit) ? $auctionbit->product_id : "",
                    'product_name'=>isset($auctionbit) ? $auctionbit->product_name : "",
                    'condition'=>isset($auctionbit) ? $auctionbit->condition: "",
                    'sale_price'=>isset($auctionbit) ? $auctionbit->sale_price: "",
                    'comment'=>isset($auctionbit) ? $auctionbit->comment: "",
                ));
                $this->template->set_global('supply', $supply, false);

            }
        }


        $this->template->title = "Supplies";
        $this->template->content = \View::forge('supply/create');

    }

	public function action_delete($id = null)
	{
		if ($supply = Model_Supply::find($id))
		{
			$supply->delete();

            \Session::set_flash('success', e('Deleted supply #'.$id));
		}

		else
		{
            \Session::set_flash('error', e('Could not delete supply #'.$id));
		}

        \Response::redirect('ebay/supply');

	}

}
