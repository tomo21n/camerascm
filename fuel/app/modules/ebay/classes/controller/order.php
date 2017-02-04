<?php
namespace Ebay;
/**
 * The namespaces provided by the SDK.
 */
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services;
use \DTS\eBaySDK\Trading\Types;
use \DTS\eBaySDK\Trading\Enums;

class Controller_Order extends \Controller_User
{

    public function action_index()
	{
        $user_info = \Auth::get_user_id();
        $where_array = array();
        //$where_array[] = array('inventories.user_id','=',$user_info[1]);
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('word'), 's'), -1, PREG_SPLIT_NO_EMPTY);

        //ユーザIDの指定
        //$where_array[] = array( 'user_id', '=', $user_info[1] );
        //キーワードの指定
        foreach($ary_keyword as $keyword){
            $where_array[] = array('sale_title','like','%'.$keyword.'%');
        };
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Order::query($condition)->count();
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
        $condition += array('order_by' => array('sale_date'=>'desc'));
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['orders'] = Model_Order::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Orders";
		$this->template->content = \View::forge('order/index', $data);

    }

	public function action_view($order_id = null)
	{
		is_null($order_id) and \Response::redirect('order');

		if ( ! $data['order'] = Model_Order::find($order_id))
		{
			\Session::set_flash('error', 'Could not find order #'.$order_id);
			\Response::redirect('ebay/order');
		}

		$this->template->title = "Product";
		$this->template->content = \View::forge('order/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Order::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();
				$order = Model_Order::forge(array(
                    'user_id' => $user_info[1],
                    'order_id' => \Input::post('order_id'),
                    'item_pkg_category' => \Input::post('item_pkg_category'),
                    'inventory_id' => \Input::post('inventory_id'),
                    'supply_price' => \Input::post('supply_price'),
                    'ebay_transaction_fee' => \Input::post('ebay_transaction_fee'),
                    'paypal_transaction_fee' => \Input::post('paypal_transaction_fee'),
                    'shipping_type' => \Input::post('shipping_type'),
                    'shipping_cost' => \Input::post('shipping_cost'),
                    'shipping_expense' => \Input::post('shipping_expense'),
                    'other_fee' => \Input::post('other_fee'),
                    'return_price' => \Input::post('return_price'),
                    'exchange_rate' => \Input::post('exchange_rate'),
                    'tag_jp' => \Input::post('tag_jp'),
                    'exchange_rate' => \Input::post('exchange_rate'),
				));

				if ($order and $order->save())
				{
					\Session::set_flash('success', 'Added order #'.$order->order_id.'.');

					\Response::redirect('ebay/order');
				}

				else
				{
					\Session::set_flash('error', 'Could not save order.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Orders";
		$this->template->content = \View::forge('order/create');

	}



	public function action_edit($order_id = null)
	{
		is_null($order_id) and \Response::redirect('order');

		if ( ! $order = Model_Order::find($order_id))
		{
			\Session::set_flash('error', 'Could not find order #'.$order_id);
			\Response::redirect('ebay/order');
		}

		$val = Model_Order::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();
            $order->user_id = $user_info[1];
            $order->order_id = $order_id;
            $order->item_pkg_category = \Input::post('item_pkg_category');
            $order->inventory_id = \Input::post('inventory_id');
            $order->supply_price = \Input::post('supply_price');
            $order->ebay_transaction_fee = \Input::post('ebay_transaction_fee');
            $order->paypal_transaction_fee = \Input::post('paypal_transaction_fee');
            $order->sale_title = \Input::post('sale_title');
            $order->sale_date = \Input::post('sale_date');
            $order->sale_price = \Input::post('sale_price');
            $order->sale_shipping = \Input::post('sale_shipping');
            $order->shipping_type = \Input::post('shipping_type');
            $order->shipping_date = \Input::post('shipping_date');
            $order->shipping_cost = \Input::post('shipping_cost');
            $order->shipping_expense = \Input::post('shipping_expense');
            $order->other_fee = \Input::post('other_fee');
            $order->return_price = \Input::post('return_price');
            $order->exchange_rate = \Input::post('exchange_rate');
            $order->profit = \Input::post('profit');

			if ($order->save())
			{
				\Session::set_flash('success', 'Updated order #' . $order_id);

				\Response::redirect('ebay/order');
			}

			else
			{
				\Session::set_flash('error', 'Could not update order #' . $order_id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $user_info = \Auth::get_user_id();
                $order->user_id = $user_info[1];
                $order->order_id = $val->validated('order_id');
                $order->inventory_id = $val->validated('inventory_id');
                $order->supply_price = $val->validated('supply_price');
                $order->item_pkg_category = $val->validated('item_pkg_category');
                $order->item_pkg_category = $val->validated('item_pkg_category');
                $order->ebay_transaction_fee = $val->validated('ebay_transaction_fee');
                $order->paypal_transaction_fee = $val->validated('paypal_transaction_fee');
                $order->sale_title = $val->validated('sale_title');
                $order->sale_date = $val->validated('sale_date');
                $order->sale_price = $val->validated('sale_price');
                $order->shipping_type = $val->validated('shipping_type');
                $order->sale_shipping = $val->validated('sale_shipping');
                $order->shipping_date = $val->validated('shipping_date');
                $order->shipping_cost = $val->validated('shipping_cost');
                $order->shipping_expense = $val->validated('shipping_expense');
                $order->other_fee = $val->validated('other_fee');
                $order->return_price = $val->validated('return_price');
                $order->exchange_rate = $val->validated('exchange_rate');
                $order->profit = $val->validated('profit');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('order', $order, false);
		}

		$this->template->title = "Orders";
		$this->template->content = \View::forge('order/edit');

	}

	public function action_delete($order_id = null)
	{
		is_null($order_id) and \Response::redirect('ebay/order');

		if ($order = Model_Order::find($order_id))
		{
			$order->delete();

			\Session::set_flash('success', 'Deleted order #'.$order_id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete order #'.$order_id);
		}

		\Response::redirect('ebay/order');

	}

    public function action_getorders(){

        $ebaytrading = new Ebaytrading();
        //$ebaytrading->setSandbox(true);
        $response = $ebaytrading->GetOrder('7day');

        Ebaytrading::SetError($response);

        if ($response->Ack !== 'Failure' && isset($response->OrderArray)) {
            //var_dump($response->OrderArray);
            foreach ($response->OrderArray->Order as $order) {
                $user_info = \Auth::get_user_id();
                if ( ! $orderinfo = Model_Order::find($order->OrderID))
                {
                    $orderinfo = Model_Order::forge(array(
                        'user_id' => $user_info[1],
                        'order_id' => $order->OrderID,
                        'order_status' => $order->OrderStatus,
                        'status' => 'Ordered',
                        'inventory_id' => $order->TransactionArray->Transaction[0]->Item->SKU,
                        'order_checkout_status' => $order->CheckoutStatus->Status,
                        'sale_price' =>$order->Subtotal->value,
                        'sale_shipping' => (float)$order->Total->value -(float)$order->Subtotal->value,
                        'buyer_id'=>$order->BuyerUserID,
                        'buyer_name'=>$order->ShippingAddress->Name,
                        $order->TransactionArray->Transaction[0]->Buyer->Email =='Invalid Request'?null:'buyer_email'=>$order->TransactionArray->Transaction[0]->Buyer->Email,
                        'buyer_address1'=>$order->ShippingAddress->Street1,
                        'buyer_address2'=>$order->ShippingAddress->Street2,
                        'buyer_address3'=>$order->ShippingAddress->CityName,
                        'buyer_pref'=>$order->ShippingAddress->StateOrProvince,
                        'buyer_country_code'=>$order->ShippingAddress->Country,
                        'buyer_country'=>$order->ShippingAddress->CountryName,
                        $order->ShippingAddress->Phone=='Invalid Request'?null:'buyer_tel'=>$order->ShippingAddress->Phone,
                        'buyer_postal'=>$order->ShippingAddress->PostalCode,
                        'transaction_id'=>$order->TransactionArray->Transaction[0]->Item->ItemID,
                        'sale_title'=>$order->TransactionArray->Transaction[0]->Item->Title,
                        'sale_date'=>$order->CreatedTime->format('Y-m-d H:i:s'),
                        'payment_date'=>isset($order->PaidTime)? $order->PaidTime->format('Y-m-d H:i:s'):null,
                        'shipping_date'=>isset($order->ShippedTime)? $order->ShippedTime->format('Y-m-d H:i:s'):null
                    ));

                    if ($orderinfo and $orderinfo->save())
                    {
                        $where_array[] = array('inventory_id','=',$orderinfo->inventory_id);
                        $inventoryinfo = Model_Inventory::find('first',array('where'=> $where_array));
                        if($inventoryinfo){
                            $inventoryinfo->status = '落札済';
                            $inventoryinfo->order_id = $order->OrderID;
                            $inventoryinfo->sold_date =$order->CreatedTime->format('Y-m-d H:i:s');
                            $inventoryinfo->save();
                        }
                        \Session::set_flash('success', 'Added order #'.$orderinfo->order_id.'.');
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save order.');
                    }

                }else{

                    $orderinfo->order_status = $order->OrderStatus;
                    $orderinfo->order_checkout_status= $order->CheckoutStatus->Status;
                    $orderinfo->buyer_name = $order->ShippingAddress->Name;
                    $order->TransactionArray->Transaction[0]->Buyer->Email =='Invalid Request'?null:$orderinfo->buyer_email= $order->TransactionArray->Transaction[0]->Buyer->Email;
                    $orderinfo->buyer_address1 = $order->ShippingAddress->Street1;
                    $orderinfo->buyer_address2 = $order->ShippingAddress->Street2;
                    $orderinfo->buyer_address3 = $order->ShippingAddress->CityName;
                    $orderinfo->buyer_pref = $order->ShippingAddress->StateOrProvince;
                    $orderinfo->buyer_country_code = $order->ShippingAddress->Country;
                    $orderinfo->buyer_country = $order->ShippingAddress->CountryName;
                    $order->ShippingAddress->Phone=='Invalid Request'?null:$orderinfo->buyer_tel = $order->ShippingAddress->Phone;
                    $orderinfo->buyer_postal=$order->ShippingAddress->PostalCode;
                    $orderinfo->sale_date = $order->CreatedTime->format('Y-m-d H:i:s');
                    $orderinfo->payment_date = isset($order->PaidTime)? $order->PaidTime->format('Y-m-d H:i:s'):null;
                    $orderinfo->shipping_date = isset($order->ShippedTime)? $order->ShippedTime->format('Y-m-d H:i:s'):null;


                    if ($orderinfo and $orderinfo->save())
                    {
                        \Session::set_flash('success', 'Refresh Order.');
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save order.');
                    }
                }
            }
        }
        \Response::redirect('ebay/order');

    }
    public function action_getEjtInfo(){
        if (\Input::method() == 'GET')
        {
            $id = \Input::get('id');
            $inventory_id = \Input::get('inventory_id');
            $where_array[] = array( 'inventory_id', '=', $inventory_id );
            $condition = array('where'=> $where_array);
            $inventoryinfo = Model_Inventory::find('all',$condition);
            foreach($inventoryinfo as $inventory){
                $ejt_id = $inventory->ejt_id;
            }
            $command = '/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getEjtInfomation.js '.$ejt_id;
            $outputjson = Controller_Order::execute($command);
            //var_dump($outputjson);

            if($outputjson['return'] == 0){
                $output = json_decode($outputjson['output']);
                if ($orderinfo = Model_Order::find($id)){

                    $orderinfo->shipping_cost = $output->shippingcost;
                    if ($orderinfo and $orderinfo->save())
                    {
                        \Session::set_flash('success', 'Update Info.');
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save id.');
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not Get Info.'.\Input::get('id'));
                }
            }
        }
        \Response::redirect('ebay/order/edit/'.$id);
    }

    public function action_getemslabel(){
        $output_path = '/var/www/html/dev_camerascm/public/emslabel/';
        $input_url = 'http://dev.world-viewing.com/ebay/orderrest.json';
        $user_info = \Auth::get_user_id();
        $order_id = '';

        if (\Input::method() == 'POST')
        {
            if(\Input::post('order_id')){
                $order_id = \Input::post('order_id');

                //echo ('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/japanpostEMSDL.js '.$user_info[1].' '.$order_id.' '.$input_url.' '.$output_path);
                //$outputjson = (Controller_Order::execute('/usr/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/japanpostEMSDL.js '.$user_info[1].' '.$order_id.' '.$input_url.' '.$output_path));
                //$outputjson = Controller_Order::execute('/var/www/html/dev_camerascm/public/assets/js/test.sh');
                $outputjson = (Controller_Order::execute('/usr/local/src/casperjs-1.1.3/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/japanpostEMSDL.js '.$user_info[1].' '.$order_id.' '.$input_url.' '.$output_path));
                var_dump($outputjson);

                if($outputjson['return'] == 0){
                    $output = json_decode($outputjson['output']);
                    //var_dump($output);

                    if ($orderinfo = Model_Order::find($order_id)){

                        $orderinfo->tracking_number = $output->tracking_number;
                        $orderinfo->emslabel = $output->file_name;

                        if ($orderinfo and $orderinfo->save())
                        {
                            \Session::set_flash('success', 'Get EMS Label.');
                        }
                        else
                        {
                            \Session::set_flash('error', 'Could not save order.'.$outputjson['output']);
                        }
                    }else
                    {
                        \Session::set_flash('error', 'Could not save order.'.$outputjson['output']);
                    }
                }else{
                    \Session::set_flash('error', 'Could not save order.'.$outputjson['output']);
                }
            }
        }
        \Response::redirect('ebay/order');
    }

    public function action_completesale(){
        if (\Input::method() == 'POST')
        {
            if(\Input::post('order_id')){
                $order_id = \Input::post('order_id');
                if ($orderinfo = Model_Order::find($order_id)){
                    if($orderinfo->status <> 'Complete'){
                        $ebaytrading = new Ebaytrading();
                        //$ebaytrading->setSandbox(true);
                        $response = $ebaytrading->CompleteSale($order_id,$orderinfo->tracking_number);

                        if ($response->Ack !== 'Failure') {
                            $orderinfo->status = 'Complete';

                            if ($orderinfo and $orderinfo->save())
                            {
                                $where_array[] = array('inventory_id','=',$orderinfo->inventory_id);
                                $inventoryinfo = Model_Inventory::find('first',array('where'=> $where_array));
                                if($inventoryinfo){
                                    $inventoryinfo->status = '発送済';
                                    $inventoryinfo->save();
                                }
                                \Session::set_flash('success', 'Complete Sale Excute!');
                            }
                            else
                            {
                                \Session::set_flash('error', 'Could not save order.');
                            }
                        }else{
                            Ebaytrading::SetError($response);
                        }
                    }else{
                        \Session::set_flash('error', 'It has already Completed.');
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not save order.');
                }
            }

        }
        \Response::redirect('ebay/order/edit/'.\Input::post('order_id'));
    }

    static function execute($command, $captureStderr = false)
    {
        $output = array();
        $return = 0;
        if ( $captureStderr === true )
        {
            $command .= ' 2>&1';
        }
        exec($command, $output, $return);
        $output = implode("\n", $output);
        return array('output' => $output, 'return' => $return);
    }


    public function action_yahooorder($yauction_id)
    {
        \Module::load('Yahoo');

        if (\Input::method() == 'POST')
        {
            $val = Model_Order::validate('create');

            if ($val->run())
            {
                $user_info = \Auth::get_user_id();
                $order = Model_Order::forge(array(
                    'user_id' => $user_info[1],
                    'order_id' => \Input::post('order_id'),
                    'sale_title' => \Input::post('sale_title'),
                    'item_pkg_category' => \Input::post('item_pkg_category'),
                    'inventory_id' => \Input::post('inventory_id'),
                    'sale_price' => \Input::post('sale_price'),
                    'sale_shipping' => \Input::post('sale_shipping'),
                    'sale_date' => \Input::post('sale_date'),
                    'shipping_date' => \Input::post('shipping_date'),
                    'supply_price' => \Input::post('supply_price'),
                    'supply_shipping' => \Input::post('supply_shipping'),
                    'ebay_transaction_fee' => \Input::post('ebay_transaction_fee'),
                    'paypal_transaction_fee' => \Input::post('paypal_transaction_fee'),
                    'shipping_cost' => \Input::post('shipping_cost'),
                    'shipping_expense' => \Input::post('shipping_expense'),
                    'other_fee' => \Input::post('other_fee'),
                    'return_price' => \Input::post('return_price'),
                    'exchange_rate' => \Input::post('exchange_rate'),
                    'tag_jp' => \Input::post('tag_jp'),
                    'channel' => 'Yahooauction',
                ));

                if ($order and $order->save())
                {
                    $yauctionsell = \Yahoo\Model_Yauctionsell::find('first',array('where' => array('auction_id' => \Input::post('order_id'))));
                    $yauctionsell->status = 'Completed';
                    $yauctionsell->save();
                    \Session::set_flash('success', e('Added supply #'.$order->order_id.'.'));

                    \Response::redirect('ebay/order');
                }

                else
                {
                    \Session::set_flash('error', e('Could not save order.'));
                }
            }
            else
            {
                \Session::set_flash('error', $val->error());
            }
        }else{
            if (!is_null($yauction_id))
            {
                $myauction = \DB::select()->from('yauction_sell')->where('auction_id', $yauction_id)->as_object()->execute();

                $user_info = \Auth::get_user_id();
                $order = Model_Order::forge(array(
                    'user_id' => $user_info[1],
                    'order_id' => $myauction[0]->auction_id,
                    'sale_title' => $myauction[0]->title,
                    'sale_price' => $myauction[0]->highest_price,
                    'sale_date' => date('Y-m-d H:m:s', strtotime($myauction[0]->end_time)),
                    'channel' => 'YahooAuction',
                    'buyer_id' => $myauction[0]->winner_id,
                    'exchange_rate' => 1,
                ));
                $this->template->set_global('order', $order, false);

            }
        }


        $this->template->title = "Orders";
        $this->template->content = \View::forge('order/create');

    }


}
