<?php
namespace Ebay;
class Controller_Ejtinvent extends \Controller_User
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
        if(\Input::get('status')){
            $where_array[] = array('status','=',\Input::get('status'));
        }
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Ejtinvent::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/ejtinvent/',
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
        $data['ejtinvent'] = Model_Ejtinvent::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Ejtinvent";
		$this->template->content = \View::forge('ejtinvent/index', $data);

	}

    public function action_ejtpcscheck()
    {
        \Module::load('ebay');

        $outputjson = (\Ebay\Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/ejtcheck.js'));

        if($outputjson['return'] == 0){
            $output = json_decode($outputjson['output']);
            //var_dump($output);
            $array_now_active =array();

            foreach($output as $item){
                $item_id = null;
                $price = null;
                $ejtinvent = null;
                $item_id = str_replace(".html","",$item->link);
                array_push($array_now_active,$item_id);
                $price = str_replace("円（税込）","",$item->price);

                if($ejtinvent = Model_Ejtinvent::find($item_id)){
                    if($ejtinvent->status == 'Sold'){
                        $ejtinvent->status = 'ReActive';
                    }
//                    if($ejtinvent->status === "NewActive"){
//                        $ejtinvent->status = 'OldActive';
//                    }elseif($ejtinvent->status == 'Sold'){
//                        $ejtinvent->status = 'ReActive';
//                    }elseif($ejtinvent->status == 'ReActive'){
//                        $ejtinvent->status = 'OldActive';
//                    }

                    if($ejtinvent->price <> $price){
                        $ejtinvent->price = $price;
                        $ejtinvent->status = 'Revise';
                    }
                    $ejtinvent->save();

                }else{
                    $Ejtinvent = Model_Ejtinvent::forge(array(
                        'id' =>$item_id,
                        'product_name' => $item->product_name,
                        'link' => $item->link,
                        'price' => $price,
                        'status' => "Active",
                    ));

                    if ($Ejtinvent and $Ejtinvent->save())
                    {
                        echo 'Item:'.$item_id.' Saved'.PHP_EOL;
                    }

                }



            }
            $where_array[] = array('status','<>','Sold');
            $condition = array('where'=> $where_array);
            $array_db_active = Model_Ejtinvent::find('all',$condition);
            foreach($array_db_active as $item){
                if(!in_array($item->id,$array_now_active)){
                    if($sold_item = Model_Ejtinvent::find($item->id)){
                        $sold_item->status = 'Sold';
                        $sold_item->save();
                    }
                };
            }


        }
        \Session::set_flash('success', 'Refresh');
        \Response::redirect('ebay/ejtinvent');
    }

	public function action_delete($ejtinvent_id = null)
	{
		is_null($ejtinvent_id) and \Response::redirect('ebay/ejtinvent');

		if ($ejtinvent = Model_Ejtinvent::find($ejtinvent_id))
		{
			$ejtinvent->delete();

			\Session::set_flash('success', 'Deleted ejtinvent #'.$ejtinvent_id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete ejtinvent #'.$ejtinvent_id);
		}

		\Response::redirect('ebay/ejtinvent');

	}

}
