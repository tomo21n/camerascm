<?php
namespace Ebay;
class Controller_Shipping extends \Controller_User
{

    public static $shipping_list = array(
        '1' => 'Standard Shipping $17',
        '2' => 'Standard Shipping 300g',
        '3' => 'Standard Shipping 500g',
        '4' => 'Standard Shipping 1kg',
        '5' => 'Standard Shipping 1.5kg',
        '6' => 'Standard Shipping 2kg',
        '7' => 'Standard Shipping 3kg',
        '8' => 'Standard Shipping 4kg',
        '9' => 'Standard Shipping 5kg',
        '10' => 'Free Shipping',
        '11' => 'Economy Shipping 300g',
        '12' => 'Economy Shipping 500g',
        '13' => 'Economy Shipping 1000g',
        '14' => 'Economy Shipping 1500g',
    );
    public static $shipping_service = array(
        'StandardShippingFromOutsideUS' => 'StandardShippingFromOutsideUS',
        'EconomyShippingFromOutsideUS' => 'EconomyShippingFromOutsideUS',
        'StandardInternational' => 'StandardInternational',
        'EconomyInternational' => 'EconomyInternational',
        'NA' => 'NA',
    );

    public static $shipping_location = array(
        'Asia' => 'Asia',
        'CN' => 'China',
        'JP' => 'Japan',
        'Americas' => 'Americas',
        'CA' => 'Canada',
        'MX' => 'Mexico',
        'AU' => 'Australia',
        'Europe' => 'Europe',
        'GB' => 'Britain',
        'DE' => 'Germany',
        'FR' => 'France',
        'RU' => 'Russia',
        'South America' => 'South America',
        'Africa' => 'Africa',
        'Worldwide' => 'Worldwide',
    );

	public function action_index()
	{
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Shipping::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/shipping/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['shipping'] = Model_Shipping::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Shipping";
		$this->template->content = \View::forge('shipping/index', $data);

	}

	public function action_view($shipping_id = null)
	{
		is_null($shipping_id) and \Response::redirect('shipping');

		if ( ! $data['shipping'] = Model_Shipping::find($shipping_id))
		{
			\Session::set_flash('error', 'Could not find shipping #'.$shipping_id);
			\Response::redirect('ebay/shipping');
		}

		$this->template->title = "Shipping";
		$this->template->content = \View::forge('shipping/view', $data);

	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Shipping::validate('create');

			if ($val->run())
			{
                $user_info = \Auth::get_user_id();

                $international_location_1 = \Input::post('international_location_1')? implode(",", \Input::post('international_location_1')) : '';
                $international_location_2 = \Input::post('international_location_2') ? implode(",", \Input::post('international_location_2')) : '';
                $international_location_3 = \Input::post('international_location_3') ? implode(",", \Input::post('international_location_3')) : '';
                $international_location_4 = \Input::post('international_location_4') ? implode(",", \Input::post('international_location_4')) : '';
                $international_location_5 = \Input::post('international_location_5') ? implode(",", \Input::post('international_location_5')) : '';
                $exclude_location = \Input::post('exclude_location') ? implode(",", \Input::post('exclude_location')) : '';

                $shipping = Model_Shipping::forge(array(
                    'user_id' => $user_info[1],
                    'shipping_name' => \Input::post('shipping_name'),
                    'domestic_priority_1' => \Input::post('domestic_priority_1'),
                    'domestic_service_1' => \Input::post('domestic_service_1'),
                    'domestic_cost_1' => \Input::post('domestic_cost_1'),
                    'international_priority_1' => \Input::post('international_priority_1'),
                    'international_service_1' => \Input::post('international_service_1'),
                    'international_cost_1' => \Input::post('international_cost_1'),
                    'international_location_1' => $international_location_1,
                    'international_priority_2' => \Input::post('international_priority_2'),
                    'international_service_2' => \Input::post('international_service_2'),
                    'international_cost_2' => \Input::post('international_cost_2'),
                    'international_location_2' => $international_location_2,
                    'international_priority_3' => \Input::post('international_priority_3'),
                    'international_service_3' => \Input::post('international_service_3'),
                    'international_cost_3' => \Input::post('international_cost_3'),
                    'international_location_3' => $international_location_3,
                    'international_priority_4' => \Input::post('international_priority_4'),
                    'international_service_4' => \Input::post('international_service_4'),
                    'international_cost_4' => \Input::post('international_cost_4'),
                    'international_location_4' => $international_location_4,
                    'international_priority_5' => \Input::post('international_priority_5'),
                    'international_service_5' => \Input::post('international_service_5'),
                    'international_cost_5' => \Input::post('international_cost_5'),
                    'international_location_5' => $international_location_5,
                    'exclude_location' => $exclude_location,
				));

				if ($shipping and $shipping->save())
				{
					\Session::set_flash('success', 'Added shipping #'.$shipping->id.'.');

					\Response::redirect('ebay/shipping');
				}

				else
				{
					\Session::set_flash('error', 'Could not save shipping.');
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Products";
		$this->template->content = \View::forge('shipping/create');

	}

	public function action_edit($shipping_id = null)
	{
		is_null($shipping_id) and \Response::redirect('shipping');

		if ( ! $shipping = Model_Shipping::find($shipping_id))
		{
			\Session::set_flash('error', 'Could not find shipping #'.$shipping_id);
			\Response::redirect('ebay/shipping');
		}

		$val = Model_Shipping::validate('edit');

		if ($val->run())
		{
            $user_info = \Auth::get_user_id();

            $international_location_1 = \Input::post('international_location_1')? implode(",", \Input::post('international_location_1')) : '';
            $international_location_2 = \Input::post('international_location_2') ? implode(",", \Input::post('international_location_2')) : '';
            $international_location_3 = \Input::post('international_location_3') ? implode(",", \Input::post('international_location_3')) : '';
            $international_location_4 = \Input::post('international_location_4') ? implode(",", \Input::post('international_location_4')) : '';
            $international_location_5 = \Input::post('international_location_5') ? implode(",", \Input::post('international_location_5')) : '';
            $exclude_location = \Input::post('exclude_location') ? implode(",", \Input::post('exclude_location')) : '';

            $shipping->user_id = $user_info[1];
            $shipping->shipping_name = \Input::post('shipping_name');
            $shipping->domestic_priority_1 = \Input::post('domestic_priority_1');
            $shipping->domestic_service_1 = \Input::post('domestic_service_1');
            $shipping->domestic_cost_1 = \Input::post('domestic_cost_1');
            $shipping->international_priority_1 = \Input::post('international_priority_1');
            $shipping->international_service_1 = \Input::post('international_service_1');
            $shipping->international_cost_1 = \Input::post('international_cost_1');
            $shipping->international_location_1 = $international_location_1;
            $shipping->international_priority_2 = \Input::post('international_priority_2');
            $shipping->international_service_2 = \Input::post('international_service_2');
            $shipping->international_cost_2 = \Input::post('international_cost_2');
            $shipping->international_location_2 = $international_location_2;
            $shipping->international_priority_3 = \Input::post('international_priority_3');
            $shipping->international_service_3 = \Input::post('international_service_3');
            $shipping->international_cost_3 = \Input::post('international_cost_3');
            $shipping->international_location_3 = $international_location_3;
            $shipping->international_priority_4 = \Input::post('international_priority_4');
            $shipping->international_service_4 = \Input::post('international_service_4');
            $shipping->international_cost_4 = \Input::post('international_cost_4');
            $shipping->international_location_4 = $international_location_4;
            $shipping->international_priority_5 = \Input::post('international_priority_5');
            $shipping->international_service_5 = \Input::post('international_service_5');
            $shipping->international_cost_5 = \Input::post('international_cost_5');
            $shipping->international_location_5 = $international_location_5;
            $shipping->exclude_location = $exclude_location;

			if ($shipping->save())
			{
				\Session::set_flash('success', 'Updated shipping #' . $shipping_id);

				\Response::redirect('ebay/shipping');
			}

			else
			{
				\Session::set_flash('error', 'Could not update shipping #' . $shipping_id);
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
                $user_info = \Auth::get_user_id();
                $shipping->user_id = $user_info[1];
                $shipping->shipping_name = $val->validated('shipping_name');
                $shipping->domestic_priority_1 = $val->validated('domestic_priority_1');
                $shipping->domestic_service_1 = $val->validated('domestic_service_1');
                $shipping->domestic_cost_1 = $val->validated('domestic_cost_1');
                $shipping->international_priority_1 = $val->validated('international_priority_1');
                $shipping->international_service_1 = $val->validated('international_service_1');
                $shipping->international_cost_1 = $val->validated('international_cost_1');
                $shipping->international_location_1 = $val->validated('international_location_1');
                $shipping->international_priority_2 = $val->validated('international_priority_2');
                $shipping->international_service_2 = $val->validated('international_service_2');
                $shipping->international_cost_2 = $val->validated('international_cost_2');
                $shipping->international_location_2 = $val->validated('international_location_2');
                $shipping->international_priority_3 = $val->validated('international_priority_3');
                $shipping->international_service_3 = $val->validated('international_service_3');
                $shipping->international_cost_3 = $val->validated('international_cost_3');
                $shipping->international_location_3 = $val->validated('international_location_3');
                $shipping->international_priority_4 = $val->validated('international_priority_4');
                $shipping->international_service_4 = $val->validated('international_service_4');
                $shipping->international_cost_4 = $val->validated('international_cost_4');
                $shipping->international_location_4 = $val->validated('international_location_4');
                $shipping->international_priority_5 = $val->validated('international_priority_5');
                $shipping->international_service_5 = $val->validated('international_service_5');
                $shipping->international_cost_5 = $val->validated('international_cost_5');
                $shipping->international_location_5 = $val->validated('international_location_5');
                $shipping->exclude_location = $val->validated('exclude_location');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('shipping', $shipping, false);
		}

		$this->template->title = "Shippings";
		$this->template->content = \View::forge('shipping/edit');

	}

	public function action_delete($shipping_id = null)
	{
		is_null($shipping_id) and \Response::redirect('ebay/shipping');

		if ($shipping = Model_Shipping::find($shipping_id))
		{
			$shipping->delete();

			\Session::set_flash('success', 'Deleted shipping #'.$shipping_id);
		}

		else
		{
			\Session::set_flash('error', 'Could not delete shipping #'.$shipping_id);
		}

		\Response::redirect('ebay/shipping');

	}

}
