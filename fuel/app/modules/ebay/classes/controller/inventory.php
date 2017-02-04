<?php
namespace Ebay;

use \DTS\eBaySDK\Trading\Enums;

class Controller_Inventory extends \Controller_User
{
    public static $status = array(
        '' => '',
        '仕入済' => '仕入済',
        '状態確認済' => '状態確認済',
        '外注発送中' => '外注発送中' ,
        '出品待ち' => '出品待ち',
        '出品準備中' => '出品準備中',
        '出品中' => '出品中',
        '落札済'=>'落札済',
        '落札入金済' => '落札入金済',
        '発送中' => '発送中' ,
        '発送済' => '発送済' ,
        '返品' => '返品',
        '廃棄' => '廃棄',
        '要修理' => '要修理',
    );
    public static $order = array(
        '' => '',
        'inventory_id' => 'SKU',
        'product_name' => '商品名',
        'sale_start_date' => '出品開始日' ,
        'supply_price' => '仕入値',
    );
    public static $grade = array(
        'Mint' => 'Mint',
        'NearMint' => 'NearMint',
        'Excellent+++' => 'Excellent+++',
        'Excellent++' => 'Excellent++',
        'Excellent+' => 'Excellent+',
        'Excellent' => 'Excellent',
        'Excellent-' => 'Excellent-',
        'VeryGood+' => 'VeryGood+',
        'VeryGood' => 'VeryGood',
        'ForParts' => 'ForParts',
    );

    public static $including = array(
        'Front Cap' => 'Fキャップ',
        'Rear Cap' => 'Rキャップ',
        'Hood' => 'フード',
        'Filter' => 'フィルタ',
        'Case' => 'ケース',
        'A box registered with a manufacturer' => '元箱',
        'Instruction manual(Japanese)' => '説明書',
        'Strap' => 'ストラップ',
        '120 Film Back' => '120フィルムバック',
        '220 Film Back' => '220フィルムバック',
        'Body Cap' => 'ボディキャップ',
        'ForParts' => 'バッテリーグリップ',
        'All you can see on this photo will be included in a set of a package.' => '写真のもの全て',
    );


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
            $where_array[] = array('PRODUCT_NAME','like','%'.$keyword.'%');
        };
        //メーカの指定
        if(\Input::get('status')){
            $where_array[] = array('status','=',\Input::get('status'));
        }else{
            $where_array[] = array('status','=','出品中');
        }
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Vinventsaleshist::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/inventory/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        if(\Input::get('order')){
            $condition += array('order_by' => array(\Input::get('order')=>'desc'));
        }else{
            $condition += array('order_by' => array('listing_status'=>'desc','supply_date'=>'desc'));
        }
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['inventories'] = Model_Vinventsaleshist::find('all',$condition);
        $data['pagination'] = $pagination;

        $data['summary'] = \DB::query('select status,count(status) as count_st,sum(supply_price) as total from inventories group by status;')->execute()->as_array();

		$this->template->title = "Inventories";
		$this->template->content = \View::forge('inventory/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and \Response::redirect('inventory');

		if ( ! $data['inventory'] = Model_Inventory::find($id))
		{
			\Session::set_flash('error', 'Could not find inventory #'.$id);
			\Response::redirect('ebay/inventory');
		}

		$this->template->title = "Inventory";
		$this->template->content = \View::forge('inventory/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Inventory::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();
				$inventory = Model_Inventory::forge(array(
					'user_id' => $user_info[1],
					'inventory_id' => \Input::post('inventory_id'),
					'product_id' => \Input::post('product_id'),
					'supply_id' => \Input::post('supply_id'),
					'ejt_id' => \Input::post('ejt_id'),
					'product_name' => \Input::post('product_name'),
					'status' => \Input::post('status'),
					'grade' => \Input::post('grade'),
					'ejt_check' => \Input::post('ejt_check'),
                    'maker' => \Input::post('maker'),
                    'serialno' => \Input::post('serialno'),
                    'including_ja' => \Input::post('including_ja'),
                    'including_en' => \Input::post('including_en'),
                    'appearance_ja_1' => \Input::post('appearance_ja_1'),
                    'appearance_en_1' => \Input::post('appearance_en_1'),
                    'functional_ja_1' => \Input::post('functional_ja_1'),
                    'functional_en_1' => \Input::post('functional_en_1'),
                    'optical_ja_1' => \Input::post('optical_ja_1'),
                    'optical_en_1' => \Input::post('optical_en_1'),
                    'appearance_ja_2' => \Input::post('appearance_ja_2'),
                    'appearance_en_2' => \Input::post('appearance_en_2'),
                    'functional_ja_2' => \Input::post('functional_ja_2'),
                    'functional_en_2' => \Input::post('functional_en_2'),
                    'optical_ja_2' => \Input::post('optical_ja_2'),
                    'optical_en_2' => \Input::post('optical_en_2'),
                    'condition_other_ja' => \Input::post('condition_other_ja'),
                    'condition_other_en' => \Input::post('condition_other_en'),
                    'picture_url' => \Input::post('picture_url'),
					'weight' => \Input::post('weight'),
					'supply_price' => \Input::post('supply_price'),
					'reference_sale_price' => \Input::post('reference_sale_price'),
					'supply_date' => \Input::post('supply_date'),
					'comfirm_date' => \Input::post('comfirm_date'),
					'sale_start_date' => \Input::post('sale_start_date'),
					'sold_date' => \Input::post('sold_date'),
					'eBay_item_number' => \Input::post('eBay_item_number'),
				));

				if ($inventory and $inventory->save())
				{
                    $supply = Model_Supply::find(\Input::post('supply_id'));
                    $supply->status = 'Invented';
                    $supply->save();
					\Session::set_flash('success', 'Added inventory #'.$inventory->inventory_id.'.');

					\Response::redirect('ebay/inventory/edit/'.$inventory->id);
				}

				else
				{
					\Session::set_flash('error', 'Could not save inventory.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Inventories";
		$this->template->content = \View::forge('inventory/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and \Response::redirect('inventory');

		if ( ! $inventory = Model_Inventory::find($id))
		{
			\Session::set_flash('error', 'Could not find inventory #'.$id);
			\Response::redirect('ebay/inventory');
		}

		$val = Model_Inventory::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();
			$inventory->user_id = $user_info[1];
			$inventory->inventory_id = \Input::post('inventory_id');
			$inventory->product_id = \Input::post('product_id');
			$inventory->supply_id = \Input::post('supply_id');
			$inventory->ejt_id = \Input::post('ejt_id');
			$inventory->product_name = \Input::post('product_name');
			$inventory->status = \Input::post('status');
			$inventory->grade = \Input::post('grade');
            $inventory->maker = \Input::post('maker');
            $inventory->ejt_check = \Input::post('ejt_check');
            $inventory->serialno = \Input::post('serialno');
            $inventory->including_ja = \Input::post('including_ja');
            $inventory->including_en = \Input::post('including_en');
            $inventory->appearance_ja_1 = \Input::post('appearance_ja_1');
            $inventory->appearance_en_1 = \Input::post('appearance_en_1');
            $inventory->functional_ja_1 = \Input::post('functional_ja_1');
            $inventory->functional_en_1 = \Input::post('functional_en_1');
            $inventory->optical_ja_1 = \Input::post('optical_ja_1');
            $inventory->optical_en_1 = \Input::post('optical_en_1');
            $inventory->appearance_ja_2 = \Input::post('appearance_ja_2');
            $inventory->appearance_en_2 = \Input::post('appearance_en_2');
            $inventory->functional_ja_2 = \Input::post('functional_ja_2');
            $inventory->functional_en_2 = \Input::post('functional_en_2');
            $inventory->optical_ja_2 = \Input::post('optical_ja_2');
            $inventory->optical_en_2 = \Input::post('optical_en_2');
            $inventory->condition_other_ja = \Input::post('condition_other_ja');
            $inventory->condition_other_en = \Input::post('condition_other_en');
			$inventory->weight = \Input::post('weight');
			$inventory->picture_url = \Input::post('picture_url');
			$inventory->supply_price = \Input::post('supply_price');
			$inventory->reference_sale_price = \Input::post('reference_sale_price');
			$inventory->supply_date = \Input::post('supply_date');
			$inventory->comfirm_date = \Input::post('comfirm_date');
			$inventory->sale_start_date = \Input::post('sale_start_date');
			$inventory->sold_date = \Input::post('sold_date');
			$inventory->eBay_item_number = \Input::post('eBay_item_number');

			if ($inventory->save())
			{
                $supply = Model_Supply::find(\Input::post('supply_id'));
                if($supply){
                    $supply->status = 'Invented';
                    $supply->save();
                    \Session::set_flash('success', 'Updated inventory #' . $inventory->inventory_id);
                }


				\Response::redirect('ebay/inventory/edit/'.$id);
			}

			else
			{
				\Session::set_flash('error', 'Could not update inventory #' . $inventory->inventory_id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $user_info = \Auth::get_user_id();
				$inventory->user_id = $user_info[1];
				$inventory->inventory_id = $val->validated('inventory_id');
				$inventory->product_id = $val->validated('product_id');
				$inventory->supply_id = $val->validated('supply_id');
				$inventory->ejt_id = $val->validated('ejt_id');
				$inventory->product_name = $val->validated('product_name');
				$inventory->status = $val->validated('status');
				$inventory->grade = $val->validated('grade');
                $inventory->maker = $val->validated('maker');
                $inventory->ejt_check = $val->validated('ejt_check');
                $inventory->serialno = $val->validated('serialno');
                $inventory->including_ja = $val->validated('including_ja');
                $inventory->including_en = $val->validated('including_en');
                $inventory->appearance_ja_1 = $val->validated('appearance_ja_1');
                $inventory->appearance_en_1 = $val->validated('appearance_en_1');
                $inventory->functional_ja_1 = $val->validated('functional_ja_1');
                $inventory->functional_en_1 = $val->validated('functional_en_1');
                $inventory->optical_ja_1 = $val->validated('optical_ja_1');
                $inventory->optical_en_1 = $val->validated('optical_en_1');
                $inventory->appearance_ja_2 = $val->validated('appearance_ja_2');
                $inventory->appearance_en_2 = $val->validated('appearance_en_2');
                $inventory->functional_ja_2 = $val->validated('functional_ja_2');
                $inventory->functional_en_2 = $val->validated('functional_en_2');
                $inventory->optical_ja_2 = $val->validated('optical_ja_2');
                $inventory->optical_en_2 = $val->validated('optical_en_2');
                $inventory->condition_other_ja = $val->validated('condition_other_ja');
                $inventory->condition_other_en = $val->validated('condition_other_en');
				$inventory->weight = $val->validated('weight');
				$inventory->picture_url = $val->validated('picture_url');
				$inventory->supply_price = $val->validated('supply_price');
				$inventory->reference_sale_price = $val->validated('reference_sale_price');
				$inventory->supply_date = $val->validated('supply_date');
				$inventory->comfirm_date = $val->validated('comfirm_date');
				$inventory->sale_start_date = $val->validated('sale_start_date');
				$inventory->sold_date = $val->validated('sold_date');
				$inventory->eBay_item_number = $val->validated('eBay_item_number');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('inventory', $inventory, false);
		}

		$this->template->title = "Inventories";
		$this->template->content = \View::forge('inventory/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and \Response::redirect('ebay/inventory');

		if ($inventory = Model_Inventory::find($id))
		{
			$inventory->delete();

			\Session::set_flash('success', 'Deleted inventory #'.$id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete inventory #'.$id);
		}

		\Response::redirect('ebay/inventory');

	}

    public function action_supplytoinv($supply_id)
    {
        if (\Input::method() == 'POST')
        {
            $val = Model_Inventory::validate('create');

            if ($val->run())
            {
                $user_info = \Auth::get_user_id();
                $inventory = Model_Inventory::forge(array(
                    'user_id' => $user_info[1],
                    'inventory_id' => \Input::post('inventory_id'),
                    'product_id' => \Input::post('product_id'),
                    'supply_id' => \Input::post('supply_id'),
                    'ejt_id' => \Input::post('ejt_id'),
                    'product_name' => \Input::post('product_name'),
                    'status' => \Input::post('status'),
                    'grade' => \Input::post('grade'),
                    'maker' => \Input::post('maker'),
                    'ejt_check' => \Input::post('ejt_check'),
                    'serialno' => \Input::post('serialno'),
                    'including_ja' => \Input::post('including_ja'),
                    'including_en' => \Input::post('including_en'),
                    'appearance_ja_1' => \Input::post('appearance_ja_1'),
                    'appearance_en_1' => \Input::post('appearance_en_1'),
                    'functional_ja_1' => \Input::post('functional_ja_1'),
                    'functional_en_1' => \Input::post('functional_en_1'),
                    'optical_ja_1' => \Input::post('optical_ja_1'),
                    'optical_en_1' => \Input::post('optical_en_1'),
                    'appearance_ja_2' => \Input::post('appearance_ja_2'),
                    'appearance_en_2' => \Input::post('appearance_en_2'),
                    'functional_ja_2' => \Input::post('functional_ja_2'),
                    'functional_en_2' => \Input::post('functional_en_2'),
                    'optical_ja_2' => \Input::post('optical_ja_2'),
                    'optical_en_2' => \Input::post('optical_en_2'),
                    'condition_other_ja' => \Input::post('condition_other_ja'),
                    'condition_other_en' => \Input::post('condition_other_en'),
                    'weight' => \Input::post('weight'),
                    'supply_price' => \Input::post('supply_price'),
                    'reference_sale_price' => \Input::post('reference_sale_price'),
                    'supply_date' => \Input::post('supply_date'),
                    'comfirm_date' => \Input::post('comfirm_date'),
                    'sale_start_date' => \Input::post('sale_start_date'),
                    'sold_date' => \Input::post('sold_date'),
                    'comment' => \Input::post('comment'),
                    'eBay_item_number' => \Input::post('eBay_item_number'),

                ));

                if ($inventory and $inventory->save())
                {
                    $supply = Model_Supply::find(\Input::post('supply_id'));
                    $supply->status = 'Invented';
                    $supply->save();
                    \Session::set_flash('success', e('Added inventory #'.$inventory->inventory_id.'.'));

                    \Response::redirect('ebay/inventory/edit/'.$inventory->id);
                }

                else
                {
                    \Session::set_flash('error', e('Could not save inventory.'));
                }
            }
            else
            {
                \Session::set_flash('error', $val->error());
            }
        }else{
            if (!is_null($supply_id))
            {
                $maxinvid = \DB::query('select max(CAST(inventory_id AS unsigned)) as maxid from inventories')->execute();
                $supply = Model_Supply::find($supply_id);

                $user_info = \Auth::get_user_id();
                $inventory = Model_Inventory::forge(array(
                    'user_id' => $user_info[1],
                    'supply_id' => $supply_id,
                    'inventory_id' =>$maxinvid[0]['maxid'] + 1,
                    'product_id' => $supply->product_id,
                    'product_name' => $supply->product_name,
                    'supply_date' => $supply->supply_date,
                    'grade' => $supply->condition,
                    'supply_price' => $supply->supply_price + $supply->supply_tax + $supply->supply_cost + $supply->supply_shipping,
                    'reference_sale_price' => $supply->sale_price,
                    'maker' => $supply->sale_price,
                ));

                $this->template->set_global('inventory', $inventory, false);

            }
        }


        $this->template->title = "Inventory";
        $this->template->content = \View::forge('inventory/create');

    }

    public function action_getEjtId(){
        if (\Input::method() == 'POST')
        {
            $id = \Input::post('id');
            $product_name = \Input::post('product_name');
            $flug = \Input::post('flug');
            $inventory_id = \Input::post('inventory_id');
            $memo = \Input::post('memo');

            //echo ('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getfirstno.js');
            //$outputjson = (Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getfirstno.js'));
            $outputjson = (Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getgaityuno.js '."'".$product_name."'"." '".$inventory_id."' '".$flug."' ".$memo.""));
            //var_dump($outputjson);

            if($outputjson['return'] == 0){
                $output = json_decode($outputjson['output']);
                //var_dump($output);

                if ($inventoryinfo = Model_Inventory::find($id)){

                    $inventoryinfo->ejt_id = $output->ejt_id;

                    if ($inventoryinfo and $inventoryinfo->save())
                    {
                        \Session::set_flash('success', 'Get EJT ID.'.$output->ejt_id);
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save id.'.$id);
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not Get ID.'.\Input::post('id'));
                }
            }
        }
        \Response::redirect('ebay/inventory/edit/'.$id);
    }

    public function action_getEjtInfo(){
        if (\Input::method() == 'GET')
        {
            $id = \Input::get('id');
            $ejt_id = \Input::get('ejt_id');
            $command = '/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getEjtInfomation.js '.$ejt_id;
            $outputjson = Controller_Order::execute($command);
            var_dump($outputjson);

            if($outputjson['return'] == 0){
                $output = json_decode($outputjson['output']);
                if ($inventoryinfo = Model_Inventory::find($id)){

                    $inventoryinfo->weight = $output->weight;
                    if ($inventoryinfo and $inventoryinfo->save())
                    {
                        \Session::set_flash('success', 'Update Info.'.$ejt_id);
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save id.'.$ejt_id);
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not Get Info.'.\Input::get('id'));
                }
            }
        }
        \Response::redirect('ebay/inventory/edit/'.$id);
    }
    public function action_getEjtphoto(){
        if (\Input::method() == 'GET')
        {
            $id = \Input::get('id');
            $ejt_id = \Input::get('ejt_id');
            //$inventory_id = \Input::post('inventory_id');

            //$outputjson = (Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getphoto.js '.$ejt_id));
            $command = '/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/getphoto.js '.$ejt_id;
            $outputjson = Controller_Order::execute($command);
            //var_dump(system($command));
            //$outputtest =Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs --version');
            //$outputtest =Controller_Order::execute('whoami');
            //var_dump($outputjson);

            if($outputjson['return'] == 0){
                $output = json_decode($outputjson['output']);
                foreach($output->download_name as $picture ){
                    $pictures[] = \Uri::base(false)."assets/img/photo/".$ejt_id."/".$picture;
                };

                if ($inventoryinfo = Model_Inventory::find($id)){

                    $inventoryinfo->picture_url = implode("\n",$pictures);
                    $inventoryinfo->ejt_picture_url = implode("\n",$output->download_url);
                    if ($inventoryinfo and $inventoryinfo->save())
                    {
                        \Session::set_flash('success', 'Get photo EJT ID.'.$ejt_id);
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save id.'.$ejt_id);
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not Get ID.'.\Input::get('id'));
                }
            }
        }
        \Response::redirect('ebay/inventory/edit/'.$id);
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

    public function action_getCurrentStatus($id,$noredirect=false){
        if ($inventoryinfo = Model_Inventory::find($id)){

            if(!is_null($inventoryinfo->eBay_item_number)){

                $ebaytrading = new Ebaytrading();
                $ebaytrading->setSandbox(false);
                $response = $ebaytrading->GetItem($inventoryinfo->eBay_item_number);
                if ($response->Ack !== 'Failure') {
                    $salesparthist = Model_SalespartsHist::find($inventoryinfo->eBay_item_number);

                    if($salesparthist){
                        $salesparthist->inventory_id = $inventoryinfo->inventory_id;
                        $salesparthist->salespart_id = $inventoryinfo->salespart_id;
                        $salesparthist->sale_price = $response->Item->SellingStatus->CurrentPrice->value;
                        $salesparthist->listing_duration = $response->Item->ListingDuration;
                        $salesparthist->hit_count = $response->Item->HitCount;
                        $salesparthist->watch_count = $response->Item->WatchCount;
                        $salesparthist->start_date = $response->Item->ListingDetails->StartTime->format('Y-m-d H:i:s');
                        $salesparthist->end_date = $response->Item->ListingDetails->EndTime->format('Y-m-d H:i:s');
                        if($response->Item->SellingStatus->ListingStatus == Enums\ListingStatusCodeType::C_ACTIVE){
                            $salesparthist->listing_status = 'Active';
                        }elseif($response->Item->SellingStatus->ListingStatus == Enums\ListingStatusCodeType::C_COMPLETED){
                            if($response->Item->SellingStatus->QuantitySold == 0 ){
                                $salesparthist->listing_status = 'UnSold';
                            }else{
                                $salesparthist->listing_status = 'Sold';
                            }
                        }

                    }else{
                        $user_info = \Auth::get_user_id();
                        if(@$response->Item->SellingStatus->ListingStatus == Enums\ListingStatusCodeType::C_ACTIVE){
                            $status= 'Active';
                        }elseif(@$response->Item->SellingStatus->ListingStatus == Enums\ListingStatusCodeType::C_COMPLETED){
                            if($response->Item->SellingStatus->QuantitySold == 0 ){
                                $status = 'UnSold';
                            }else{
                                $status = 'Sold';
                            }
                        }else{
                            $status = NULL;
                        }
                        $salesparthist = Model_SalespartsHist::forge(array(
                            'inventory_id' => $inventoryinfo->inventory_id,
                            'eBay_item_number' => $inventoryinfo->eBay_item_number,
                            'user_id' => $user_info[1],
                            'salespart_id' => $inventoryinfo->salespart_id,
                            'listing_status'=>$status,
                            'sale_price'=>$response->Item->SellingStatus->CurrentPrice->value,
                            'listing_duration'=>$response->Item->ListingDuration,
                            'hit_count'=> $response->Item->HitCount,
                            'watch_count'=>$response->Item->WatchCount,
                            'start_date'=>$response->Item->ListingDetails->StartTime->format('Y-m-d H:i:s'),
                            'end_date'=>$response->Item->ListingDetails->EndTime->format('Y-m-d H:i:s'),
                        ));

                    }
                    if ($salesparthist and $salesparthist->save())
                    {
                        \Session::set_flash('success', 'Update Current Status.'.$id);
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not Update id.'.$id);
                    }

                }else{
                    Ebaytrading::SetError($response);
                }

            }

        }else
        {
            \Session::set_flash('error', 'Could not Update id.'.$id);
        }

        if(!$noredirect){
            \Response::redirect('ebay/inventory/');
        }

    }


    public function action_relist(){
        if (\Input::method() == 'POST')
        {
            $ebaytrading = new Ebaytrading();
            //$ebaytrading->setSandbox(true);
            $response = $ebaytrading->RelistItem(\Input::post('eBay_item_number'),\Input::post('price'),\Input::post('listing_duration'),\Input::post('inventory_id'));
            if ($response->Ack !== 'Failure' && isset($response->ItemID)) {

                if ($inventoryinfo = Model_Inventory::find(\Input::post('id'))){

                    $inventoryinfo->eBay_item_number = $response->ItemID;

                    if ($inventoryinfo and $inventoryinfo->save())
                    {
                        $user_info = \Auth::get_user_id();
                        $salesparthist = Model_SalespartsHist::forge(array(
                            'inventory_id' => $inventoryinfo->inventory_id,
                            'eBay_item_number' => $inventoryinfo->eBay_item_number,
                            'user_id' => $user_info[1],
                            'salespart_id' => $inventoryinfo->salespart_id,
                            'listing_status'=>'Active',
                            'sale_price'=>\Input::post('price'),
                            'start_date'=>date('Y-m-d H:i:s'),
                            'relist'=>'RELIST'
                        ));
                        if ($salesparthist and $salesparthist->save())
                        {
                            \Session::set_flash('success', 'List Item:'.$response->ItemID);
                        }
                        else
                        {
                            \Session::set_flash('error', 'Could not save.'.\Input::post('id'));
                        }
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save.'.\Input::post('id'));
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not save.'.\Input::post('id'));
                }

            }else{
                if (isset($response->Errors)) {
                    foreach ($response->Errors as $error) {
                        $erromsg = sprintf("%s: %s :: %s\n\n",
                            $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                            $error->ShortMessage,
                            $error->LongMessage
                        );
                        \Session::set_flash('error', e($erromsg));
                    }
                }

            }
        }
        \Response::redirect('ebay/inventory/');
    }

    public function action_myebayrefresh(){

        $ebaytrading = new Ebaytrading();
        //$ebaytrading->setSandbox(true);
        $response = $ebaytrading->GetMyeBaySelling();
        if ($response->Ack !== 'Failure') {
            foreach($response->ActiveList->ItemArray->Item as $item){
                $itemsammary = null;
                $itemsammary['Title'] = $item->Title;
                $itemsammary['ItemID'] = $item->ItemID;
                $itemsammary['SKU'] = $item->SKU;
                $itemsammary['WatchCount'] = $item->WatchCount;
                //$itemsammary['BuyItNowPrice'] = $item->BuyItNowPrice->value;
                //$itemsammary['CurrentPrice'] = $item->SellingStatus->CurrentPrice->value;
                $itemsammary['TimeLeft'] = $item->TimeLeft;
                $activeitemarray[] = $itemsammary;
            }
            foreach($response->UnsoldList->ItemArray->Item as $item){
                $itemsammary = null;
                $itemsammary['Title'] = $item->Title;
                $itemsammary['ItemID'] = $item->ItemID;
                $itemsammary['SKU'] = $item->SKU;
                $itemsammary['WatchCount'] = $item->WatchCount;
                //$itemsammary['BuyItNowPrice'] = $item->BuyItNowPrice->value;
                //$itemsammary['CurrentPrice'] = $item->SellingStatus->CurrentPrice->value;
                $itemsammary['EndTime'] = $item->ListingDetails->EndTime;
                $itemsammary['Relisted'] = $item->Relisted;
                $unsolditemarray[] = $itemsammary;
            }
            $user_info = \Auth::get_user_id();

            foreach($activeitemarray as $activeitem){
                $inventory = Model_Salespartshist::find($activeitem['ItemID']);
                if($inventory){
                    $inventory->watch_count = $activeitem['WatchCount'];
                    //echo 'Active:'.$activeitem['ItemID'].':'.$activeitem['SKU'].':'.$inventory->watch_count;
                    if(!$inventory->save()){
                        \Session::set_flash('error', 'Cannot Refresh');
                    };
                }

            }
            foreach($unsolditemarray as $unsolditem){
                if(!$unsolditem['Relisted']){
                    $inventory = Model_Salespartshist::find($activeitem['ItemID']);
                    if($inventory){
                        $inventory->watch_count = $unsolditem['WatchCount'];
                        $inventory->listing_status = 'UnSold';
                        //echo 'Unsold:'.$activeitem['ItemID'].':'.$activeitem['SKU'].':'.$inventory->watch_count.'¥n';
                        if(!$inventory->save()){
                            \Session::set_flash('error', 'Cannot Refresh');
                        };
                    }

                }
            }

            \Response::redirect('ebay/inventory/');
        }

    }

    public function action_getMultiCurrentStatus(){
        $user_info = \Auth::get_user_id();
        $condition = array(
            'where' => array(
                array('listing_status', 'Active'),
                'or' => array(
                    array('listing_status', NULL),
                    array('status', '出品中'),
                ),
            )
        );
        $condition += array('order_by' => array('sal_updated_at'));
        $condition += array('limit' => '20');
        $inventories = Model_Vinventsaleshist::find('all',$condition);

        foreach($inventories as $item){
            $this->action_getCurrentStatus($item->id,true);
        }
        \Response::redirect('ebay/inventory/');


    }

    public function action_updatesummary(){

        if (\Input::method() == 'POST')
        {
            $firstday = \Input::post('year').str_pad( \Input::post('month'), 2, 0, STR_PAD_LEFT).'01';
            //仕入個数、仕入れ額
            $SQL = 'select count(supply_price) as supply_total_count,sum(supply_price) as supply_total_price from inventories where supply_date >="'.$firstday.'" and supply_date <=LAST_DAY('.$firstday.')';
            $result = \DB::query($SQL)->execute()->current();
            $summary['supply_total_count'] = $result['supply_total_count'];
            $summary['supply_total_price'] = $result['supply_total_price'];

            //月初在庫個数	月初在庫額
            $SQL = 'select count(supply_price) as begining_inventory_count,sum(supply_price) as beginning_inventory_cost from inventories where supply_date <"'.$firstday.'" and ( sold_date > "'.$firstday.'" or sold_date = "0000-00-00")';
            $result = \DB::query($SQL)->execute()->current();
            $summary['begining_inventory_count'] = $result['begining_inventory_count'];
            $summary['beginning_inventory_cost'] = $result['beginning_inventory_cost'];

            //販売個数、販売原価
            $SQL = 'select count(supply_price) as sale_total_count,sum(supply_price) as product_cost_total from inventories where sold_date >="'.$firstday.'" and sold_date <=LAST_DAY('.$firstday.')';
            $result = \DB::query($SQL)->execute()->current();
            $summary['sale_total_count'] = $result['sale_total_count'];
            $summary['product_cost_total'] = $result['product_cost_total'];

            //売上、利益
            $SQL = 'select round(sum(sale_price*exchange_rate)+sum(sale_shipping*exchange_rate),2) as sale_total_price,sum(profit) as profit_total from orders where shipping_date >="'.$firstday.'" and shipping_date <=LAST_DAY('.$firstday.')';
            $result = \DB::query($SQL)->execute()->current();
            $summary['sale_total_price'] = $result['sale_total_price'];
            $summary['profit_total'] = $result['profit_total'];



            $user_info = \Auth::get_user_id();
            $where_array[] = array('user_id',$user_info[1]);
            $where_array[] = array('year',\Input::post('year'));
            $where_array[] = array('month',\Input::post('month'));
            $condition = array('where'=> $where_array);
            if ($summaryinfo = \Model_Summary::find('first',$condition)){

                $summaryinfo->supply_total_count = $summary['supply_total_count'];
                $summaryinfo->supply_total_price = $summary['supply_total_price'];
                $summaryinfo->sale_total_count = $summary['sale_total_count'];
                $summaryinfo->sale_total_price = $summary['sale_total_price'];
                $summaryinfo->product_cost_total = $summary['product_cost_total'];
                $summaryinfo->profit_total = $summary['profit_total'];
                $summaryinfo->begining_inventory_count = $summary['begining_inventory_count'];
                $summaryinfo->beginning_inventory_cost = $summary['beginning_inventory_cost'];


            }else
            {

                $summaryinfo = \Model_Summary::forge(array(
                    'user_id' => $user_info[1],
                    'year' => \Input::post('year'),
                    'month' => \Input::post('month'),
                    'supply_total_count' => $summary['supply_total_count'],
                    'supply_total_price' => $summary['supply_total_price'],
                    'sale_total_count' => $summary['sale_total_count'],
                    'sale_total_price' => $summary['sale_total_price'],
                    'profit_total' => $summary['profit_total'],
                    'product_cost_total' => $summary['product_cost_total'],
                    'begining_inventory_count' => $summary['begining_inventory_count'],
                    'beginning_inventory_cost' => $summary['beginning_inventory_cost'],

                ));
            }
            if ($summaryinfo and $summaryinfo->save())
            {

                \Session::set_flash('success', 'Update Summary:');

            }
            else
            {
                \Session::set_flash('error', 'Could not Update.');
            }


        }


        \Response::redirect('/user');


    }

    public function action_uploadphoto(){
        if (\Input::method() == 'POST')
        {
            $id = \Input::post('id');
            $inventory_id = \Input::post('inventory_id');

            if (!file_exists(DOCROOT.'/assets/img/photo/'.$inventory_id)) {
                \File::create_dir(DOCROOT.'/assets/img/photo/', $inventory_id , 0755);
            }

            $config = array(
                'path' => DOCROOT.'/assets/img/photo/'.$inventory_id,
                //'randomize' => true,
                'overwrite'   => true,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );

            \Upload::process($config);

            if (\Upload::is_valid())
            {
                \Upload::save();

                if ($inventoryinfo = Model_Inventory::find($id)){

                    $picture_url = explode("\n",$inventoryinfo->picture_url);
                    // アップロードに成功したファイルの一覧を取得する
                    foreach(\Upload::get_files() as $file)
                    {
                        //var_dump($file['saved_to'].$file['saved_as']);
                        array_push($picture_url,\Uri::base(false)."assets/img/photo/".$inventory_id."/".$file['saved_as']);
                    }
                    $inventoryinfo->picture_url = implode("\n",$picture_url);
                    if ($inventoryinfo and $inventoryinfo->save())
                    {
                        \Session::set_flash('success', 'Upload photo.');
                    }
                    else
                    {
                        \Session::set_flash('error', 'Could not save id.');
                    }
                }else
                {
                    \Session::set_flash('error', 'Could not Upload.'.\Input::get('id'));
                }
            }

            foreach (\Upload::get_errors() as $file)
            {
                \Session::set_flash('error', $file['errors']['message']);

                // $file はファイル情報の配列
                // $file['errors'] は発生したエラーの内容を含む配列で、
                // 配列の要素は 'error' と 'message' を含む配列
            }

        }

        \Response::redirect('ebay/inventory/edit/'.$id);
    }

}
