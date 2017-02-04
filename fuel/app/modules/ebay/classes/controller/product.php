<?php
namespace Ebay;
class Controller_Product extends \Controller_User
{

    public static $category = array(
                             'MF Lens' => 'MF Lens',
                             'AF Lens' => 'AF Lens',
                             'Medium Lens' => 'Medium Lens',
                             'Large Lens' => 'Large Lens',
                             'Film Body' => 'Film Body',
                             'Digital Body' => 'Digital Body',
                             'Rangefinder' => 'Rangefinder',
                             'Medium Body' => 'Medium Body',
                             'Large Body' => 'Large Body',
                             'Body & Lens' => 'Body&Lens',
                             'Accessory' => 'Accessory',
                            );
    public static $maker = array(
        '' => '-------',
        'Canon' => 'Canon',
        'Contax' => 'Contax',
        'Fuji' => 'Fuji',
        'Hasselblad' => 'Hasselblad',
        'Konica' => 'Konica',
        'Leica' => 'Leica',
        'Mamiya' => 'Mamiya',
        'Minolta' => 'Minolta',
        'Nikon' => 'Nikon',
        'Olympus' => 'Olympus',
        'Pentax/Asahi' => 'Pentax/Asahi',
        'Sigma' => 'Sigma',
        'Tokina' => 'Tokina',
        'Tamron' => 'Tamron',
        'ZenzaBronica' => 'ZenzaBronica',
        'Schneider' => 'Schneider',
        'Voigtlander' => 'Voigtlander',
        'Konica' => 'Konica',
        'Kenko' => 'Kenko',
        'Other' => 'Other',
    );

    public static $mount = array(
        '' => '言及なし',
        'Canon EOS' => 'Canon EOS',
        'Canon FD' => 'Canon FD',
        'Contax G' => 'Contax G',
        'Leica M' => 'Leica M',
        'Leica L39 M39' => 'Leica L39 M39',
        'M42 Screw' => 'M42 Screw',
        'Nikon F' => 'Nikon F',
        'Olympus OM' => 'Olympus OM',
        'Pentax K' => 'Pentax K',
        'Sony/Minolta Alpha' => 'Sony/Minolta Alpha',
        'Yashika Contax(Y/C)' => 'Yashika Contax(Y/C)',
        'Other' => 'Other',
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
        if(\Input::get('maker')){
            $where_array[] = array('MAKER','=',\Input::get('maker'));
        }
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Product::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/product/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('order_by' => array('PRODUCT_NAME'=>'asc'));
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['products'] = Model_Product::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Products";
		$this->template->content = \View::forge('product/index', $data);

	}

	public function action_view($product_id = null)
	{
		is_null($product_id) and \Response::redirect('product');

		if ( ! $data['product'] = Model_Product::find($product_id))
		{
			\Session::set_flash('error', 'Could not find product #'.$product_id);
			\Response::redirect('ebay/product');
		}

		$this->template->title = "Product";
		$this->template->content = \View::forge('product/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Product::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();
				$product = Model_Product::forge(array(
                    'user_id' => $user_info[1],
                    'product_id' => \Input::post('product_id'),
                    'product_name' => \Input::post('product_name'),
                    'category' => \Input::post('category'),
                    'maker' => \Input::post('maker'),
                    'model' => \Input::post('model'),
                    'option_1' => \Input::post('option_1'),
                    'option_2' => \Input::post('option_2'),
                    'option_3' => \Input::post('option_3'),
                    'option_4' => \Input::post('option_4'),
                    'option_5' => \Input::post('option_5'),
                    'tag_en' => \Input::post('tag_en'),
                    'tag_jp' => \Input::post('tag_jp'),
                    'in_upper_price' => \Input::post('in_upper_price'),
                    'in_mean_price' => \Input::post('in_mean_price'),
                    'in_lower_price' => \Input::post('in_lower_price'),
                    'in_channel' => \Input::post('in_channel'),
                    'out_upper_price' => \Input::post('out_upper_price'),
                    'out_mean_price' => \Input::post('out_mean_price'),
                    'out_lower_price' => \Input::post('out_lower_price'),
                    'out_search_count' => \Input::post('out_search_count'),
                    'out_channel' => \Input::post('out_channel'),
                    'comment' => \Input::post('comment'),
				));

				if ($product and $product->save())
				{
					\Session::set_flash('success', 'Added product #'.$product->product_id.'.');

					\Response::redirect('ebay/product');
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

		$this->template->title = "Products";
		$this->template->content = \View::forge('product/create');

	}

	public function action_edit($product_id = null)
	{
		is_null($product_id) and \Response::redirect('product');

		if ( ! $product = Model_Product::find($product_id))
		{
			\Session::set_flash('error', 'Could not find product #'.$product_id);
			\Response::redirect('ebay/product');
		}

		$val = Model_Product::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();
            $product->user_id = $user_info[1];
            $product->product_id = $product_id;
            $product->product_name = \Input::post('product_name');
            $product->category = \Input::post('category');
            $product->maker = \Input::post('maker');
            $product->model = \Input::post('model');
            $product->option_1 = \Input::post('option_1');
            $product->option_2 = \Input::post('option_2');
            $product->option_3 = \Input::post('option_3');
            $product->option_4 = \Input::post('option_4');
            $product->option_5 = \Input::post('option_5');
            $product->tag_en = \Input::post('tag_en');
            $product->tag_jp = \Input::post('tag_jp');
            $product->in_upper_price = \Input::post('in_upper_price');
            $product->in_mean_price = \Input::post('in_mean_price');
            $product->in_lower_price = \Input::post('in_lower_price');
            $product->in_channel = \Input::post('in_channel');
            $product->out_upper_price = \Input::post('out_upper_price');
            $product->out_mean_price = \Input::post('out_mean_price');
            $product->out_lower_price = \Input::post('out_lower_price');
            $product->out_search_count = \Input::post('out_search_count');
            $product->out_channel = \Input::post('out_channel');
            $product->comment = \Input::post('comment');

			if ($product->save())
			{
				\Session::set_flash('success', 'Updated product #' . $product_id);

				\Response::redirect('ebay/product');
			}

			else
			{
				\Session::set_flash('error', 'Could not update product #' . $product_id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $user_info = \Auth::get_user_id();
                $product->user_id = $user_info[1];
                $product->product_id = $val->validated('product_id');
                $product->product_name = $val->validated('product_name');
                $product->category = $val->validated('category');
                $product->maker = $val->validated('maker');
                $product->model = $val->validated('model');
                $product->option_1 = $val->validated('option_1');
                $product->option_2 = $val->validated('option_2');
                $product->option_3 = $val->validated('option_3');
                $product->option_4 = $val->validated('option_4');
                $product->option_5 = $val->validated('option_5');
                $product->tag_en = $val->validated('tag_en');
                $product->tag_jp = $val->validated('tag_jp');
                $product->in_upper_price = $val->validated('in_upper_price');
                $product->in_mean_price = $val->validated('in_mean_price');
                $product->in_lower_price = $val->validated('in_lower_price');
                $product->in_channel = $val->validated('in_channel');
                $product->out_upper_price = $val->validated('out_upper_price');
                $product->out_mean_price = $val->validated('out_mean_price');
                $product->out_lower_price = $val->validated('out_lower_price');
                $product->out_search_count = $val->validated('out_search_count');
                $product->out_channel = $val->validated('out_channel');
                $product->comment = $val->validated('comment');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('product', $product, false);
		}

		$this->template->title = "Products";
		$this->template->content = \View::forge('product/edit');

	}

	public function action_delete($product_id = null)
	{
		is_null($product_id) and \Response::redirect('ebay/product');

		if ($product = Model_Product::find($product_id))
		{
			$product->delete();

			\Session::set_flash('success', 'Deleted product #'.$product_id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete product #'.$product_id);
		}

		\Response::redirect('ebay/product');

	}

}
