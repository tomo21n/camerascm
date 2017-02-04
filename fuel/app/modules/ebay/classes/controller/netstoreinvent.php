<?php
namespace Ebay;
class Controller_Netstoreinvent extends \Controller_User
{

    public function action_index()
	{
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('word'), 's'), -1, PREG_SPLIT_NO_EMPTY);
        //キーワードの指定
        foreach($ary_keyword as $keyword){
            $where_array[] = array('PRODUCT_NAME','like','%'.$keyword.'%');
        };
        if(\Input::get('condition')){
            $where_array[] = array('condition','=',\Input::get('condition'));
        }
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Netstoreinvent::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/netstoreinvent/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('order_by' => array('updated_at' => 'desc'));
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['netstoreinvent'] = Model_Netstoreinvent::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Netstoreinvent";
		$this->template->content = \View::forge('netstoreinvent/index', $data);

	}

    public function action_cameracollectioncheck($page=1)
    {
        \Module::load('ebay');


        if($page == 1){
            $outputjson = (\Ebay\Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/cameracollectioncheck.js'));

        }else{
            $outputjson = (\Ebay\Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/cameracollectioncheck2.js'));
        }

        if($outputjson['return'] == 0){
            $output = json_decode($outputjson['output']);
            $firstchild = false;

            foreach($output as $item){
                $value = array();
                $array_now_active =array();
                $item_array = str_replace('<td>','',explode('</td>',trim($item->item_html)));
                if($item_array[0] === 'Nikon'){
                    $firstchild = true;
                };
                if($firstchild){
                    $value['product_name'] = trim(str_replace("<p>","",str_replace("</p>","",$item_array[1])));
                    $value['condition'] = trim(str_replace('<span style="color: #ff0000">',"",str_replace("</span>","",trim($item_array[2]))));

                    $value['price'] = intval(preg_replace('/[^0-9]/', '', $item_array[3]));
                    if(strpos($item_array[4],'NEW') !== false){
                       $value['new'] = true;
                    }else{
                        $value['new'] = false;
                    }
                    if(strpos($item_array[4],'販売済') !== false){
                        $value['sold'] = true;
                    }else{
                        $value['sold'] = false;
                    }
                }
                $value['maker'] = trim($item_array[0]);

                if(count($value) == 6 && isset($value['condition'])){
                    array_push($array_now_active,$value['product_name']);

                    $where_array = array();
                    $where_array[] = array('product_name',$value['product_name']);
                    $where_array[] = array('condition',$value['condition']);
                    $where_array[] = array('status','Active');
                    $condition = array('where'=> $where_array);
                    if($netstoreinvent = Model_Netstoreinvent::find('first',$condition)){
                        var_dump($netstoreinvent->status);
                        if($netstoreinvent->status <> 'Sold'){
                            if($netstoreinvent->price <> $value['price']){
                                $netstoreinvent->price = $value['price'];
                                $netstoreinvent->status = 'Revise';
                                $netstoreinvent->save();
                            }
                            if($value['sold']){
                                $netstoreinvent->status = 'Sold';
                                $netstoreinvent->save();
                            }

                        }


                    }else{
                        if(!$value['sold']){
                            $Netstoreinvent = Model_Netstoreinvent::forge(array(
                                'product_name' => $value['product_name'],
                                'maker' => $value['maker'],
                                'link' => $page=1? 'http://asbe-z.co.jp/stock/net_gentei.html':'http://asbe-z.co.jp/stock/index.html',
                                'condition' => $value['condition'],
                                'price' => $value['price'],
                                'status' => "Active",
                            ));

                            if ($Netstoreinvent and $Netstoreinvent->save())
                            {
                                echo 'Item:'.$value['product_name'].' Saved'.PHP_EOL;
                            }
                        }

                    }

                }
            }

        }
        if($page == 1){
            $this->action_cameracollectioncheck(2);
        }
        \Session::set_flash('success', 'Refresh');
        \Response::redirect('ebay/netstoreinvent');

    }

	public function action_delete($netstoreinvent_id = null)
	{
		is_null($netstoreinvent_id) and \Response::redirect('ebay/netstoreinvent');

		if ($netstoreinvent = Model_Netstoreinvent::find($netstoreinvent_id))
		{
			$netstoreinvent->delete();

			\Session::set_flash('success', 'Deleted netstoreinvent #'.$netstoreinvent_id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete netstoreinvent #'.$netstoreinvent_id);
		}

		\Response::redirect('ebay/netstoreinvent');

	}

}
