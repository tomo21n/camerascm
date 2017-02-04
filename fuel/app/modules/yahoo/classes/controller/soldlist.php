<?php
namespace Yahoo;
class Controller_Soldlist extends \Controller_User{

	public function action_index()
	{
        if(\Input::get('sold')){
            \Response::redirect('yahoo/soldlist/updatesoldlist/'.\Input::get('open_id'));

        }else{
            $user_info = \Auth::get_user_id();
            $where_array = array();
            if(\Input::get('open_id')){
                $where_array[] = array('open_id','=',\Input::get('open_id'));
            }

            $condition = array(
                'where'=> array(    // リレーション内での検索
                    array( 'user_id', '=', $user_info[1] )
                ),
                'related' => array(
                    'yauctiontoken' => array(   // リレーション条件を指定
                        'where' => $where_array
                    ),
                ),
                'order_by' => array('end_time'=>'desc'),
            );
            $data['count'] = Model_Yauctionsell::count($condition);
            //Paginationの環境設定
            $config = array(
                'name' => 'pagination',
                'pagination_url' => \Uri::base().'yahoo/soldlist/' ,
                'uri_segment' => 'page',
                'num_links' => 5,
                'per_page' => 50,
                'total_items' => $data['count'],
            );

            //Paginationのセット
            $pagination = \Pagination::forge('pagination', $config);
            $condition += array('limit' => $pagination->per_page);
            $condition += array('offset' => $pagination->offset);
            $data['soldlists'] = Model_Yauctionsell::find('all',$condition);
            $data['pagination'] = $pagination;

            $myauctiontokens = Model_Yauctiontoken::find('all',array(
                'where'=> array(    // リレーション内での検索
                    array( 'user_id', '=', $user_info[1] )
                ),
            ));
            $open_ids = array();
            foreach($myauctiontokens as $myauctiontoken){
                $open_ids += array($myauctiontoken->open_id => $myauctiontoken->yahoo_user_id );
            }
            $data['open_ids'] = $open_ids;

            $this->template->title = "My Soldlist";
            $this->template->content = \View::forge('soldlist/index', $data);

        }

	}
    public function action_updatesoldlist($open_id = null){

        $yauction = new Yauction();
        $yauction->setRequestUri(\Uri::base().'yahoo/soldlist/index');

        if($open_id){
            $env = Model_Yauctiontoken::getAccessToken($open_id);
            $yauction->setTokenFromDb($env);

            $result = $yauction->myCloseList();
            if($result === 'Invalid Token'){
                $yauction->refreshToken();

                $env = Model_Yauctiontoken::getAccessToken($open_id);
                $yauction->setTokenFromDb($env);

                $result = $yauction->myCloseList();

            }else if($result === 'Invalid Request'||$result === 'Other Error'){
                \Session::set_flash('error', e('Error :' . $result));

            }else if($result){
                \Session::set_flash('success', e('Updated mysoldlist '));

            }

            \Response::redirect('yahoo/soldlist/');

        }

    }



	public function action_view($id = null)
	{
		$data['soldlist'] = Model_Yauctionsell::find($id);

		$this->template->title = "soldlist";
		$this->template->content = \View::forge('soldlist/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Yauctionsell::validate('create');

			if ($val->run())
			{
				$myauction = Model_Yauctionsell::forge(array(
                    'user_id' => \Input::post('user_id'),
                    'auction_id' => \Input::post('auction_id'),
                    'title' => \Input::post('title'),
                    'highest_price'=> \Input::post('highest_price'),
                    'winner_id'=> \Input::post('winner_id'),
                    'item_list_url'=> \Input::post('item_list_url'),
                    'message_title'=> \Input::post('message_title'),
                    'end_time'=> \Input::post('end_time'),
                    'auction_item_url'=> \Input::post('auction_item_url'),
                    'image_url'=> \Input::post('image_url'),
				));

				if ($myauction and $myauction->save())
				{
					\Session::set_flash('success', e('Added myauction #'.$myauction->id.'.'));

					\Response::redirect('myauction');
				}

				else
				{
					\Session::set_flash('error', e('Could not save myauction.'));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "myauctions";
		$this->template->content = \View::forge('myauction/create');

	}

	public function action_edit($id = null)
	{
		$myauction = Model_Yauctionsell::find($id);
		$val = Model_Yauctionsell::validate('edit');

		if ($val->run())
		{
            $myauction->user_id = \Input::post('user_id');
            $myauction->auction_id = \Input::post('auction_id');
            $myauction->title = \Input::post('title');
            $myauction->highest_price= \Input::post('highest_price');
            $myauction->winner_id= \Input::post('winner_id');
            $myauction->item_list_url= \Input::post('item_list_url');
            $myauction->message_title= \Input::post('message_title');
            $myauction->end_time= \Input::post('end_time');
            $myauction->auction_item_url= \Input::post('auction_item_url');
            $myauction->image_url= \Input::post('image_url');

			if ($myauction->save())
			{
				\Session::set_flash('success', e('Updated myauction #' . $id));

				\Response::redirect('yahoo/myauction');
			}

			else
			{
				\Session::set_flash('error', e('Could not update myauction #' . $id));
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $myauction->user_id = $val->validated('user_id');
                $myauction->auction_id = $val->validated('auction_id');
                $myauction->title = $val->validated('title');
                $myauction->highest_price= $val->validated('highest_price');
                $myauction->winner_id= $val->validated('winner_id');
                $myauction->item_list_url= $val->validated('item_list_url');
                $myauction->message_title= $val->validated('message_title');
                $myauction->end_time= $val->validated('end_time');
                $myauction->auction_item_url= $val->validated('auction_item_url');
                $myauction->image_url= $val->validated('image_url');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('myauction', $myauction, false);
		}

		$this->template->title = "myauctions";
		$this->template->content = \View::forge('myauction/edit');

	}

	public function action_delete($id = null)
	{
		if ($myauction = Model_Yauctionsell::find($id))
		{
			$myauction->delete();

			\Session::set_flash('success', e('Deleted myauction #'.$id));
		}

		else
		{
			\Session::set_flash('error', e('Could not delete myauction #'.$id));
		}

		\Response::redirect('yahoo/myauction');

	}


}