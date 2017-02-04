<?php
namespace Ebay;

use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services;
use \DTS\eBaySDK\Trading\Types;
use \DTS\eBaySDK\Trading\Enums;

class Controller_Promotion extends \Controller_User
{
    public static $discount_type = array(
        Enums\DiscountCodeType::C_PERCENTAGE => 'Percentage',
        Enums\DiscountCodeType::C_PRICE => 'Price',
    );
    public  static $promotional_sale_type = array(
        Enums\PromotionalSaleTypeCodeType::C_PRICE_DISCOUNT_ONLY => 'Price',
        Enums\PromotionalSaleTypeCodeType::C_FREE_SHIPPING_ONLY => 'FreeShipping',
        Enums\PromotionalSaleTypeCodeType::C_PRICE_DISCOUNT_AND_FREE_SHIPPING => 'Price & FreeShipping',
    );


	public function action_index()
	{
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('word'), 's'), -1, PREG_SPLIT_NO_EMPTY);

        //ユーザIDの指定
        $where_array[] = array( 'user_id', '=', $user_info[1] );

        $condition = array('where'=> $where_array);
        $data['count'] = Model_Promotion::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/promotion/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );

        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('order_by' => array('promotional_sale_endtime'=>'desc'));
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['promotions'] = Model_Promotion::find('all',$condition);
        $data['pagination'] = $pagination;

		$this->template->title = "Promotion";
		$this->template->content = \View::forge('promotion/index', $data);

	}

	public function action_view($id = null)
	{
		$data['promotion'] = Model_Promotion::find($id);

		$this->template->title = "Promotion";
		$this->template->content = \View::forge('promotion/view', $data);

	}

	public function action_create()
	{
        if (\Input::method() == 'POST')
		{
			$val = Model_Promotion::validate('create');

			if ($val->run())
			{

                $ebaytrading = new Ebaytrading();
                $ebaytrading->setSandbox(true);
                $response = $ebaytrading->Editpromotion(
                    'ADD',
                    \Input::post('promotional_sale_name'),
                    \Input::post('promotional_sale_type'),
                    \Input::post('discount_type'),
                    \Input::post('discount_value'),
                    new \DateTime(\Input::post('promotional_sale_starttime')),
                    new \DateTime(\Input::post('promotional_sale_endtime'))
                );

                if ($response->Ack !== 'Failure' && isset($response->PromotionalSaleID)) {
                    $user_info = \Auth::get_user_id();
                    $promotion = Model_Promotion::forge(array(
                        'user_id' => $user_info[1],
                        'promotion_id' => $response->PromotionalSaleID,
                        'promotional_sale_name' => \Input::post('promotional_sale_name'),
                        'discount_type' => \Input::post('discount_type'),
                        'discount_value' => \Input::post('discount_value'),
                        'promotional_sale_type' => \Input::post('promotional_sale_type'),
                        'promotional_sale_starttime' => \Input::post('promotional_sale_starttime'),
                        'promotional_sale_endtime' => \Input::post('promotional_sale_endtime'),

                    ));

                    if ($promotion and $promotion->save())
                    {

                        \Session::set_flash('success', e('Added promotion #'.$promotion->id.'.'));
                        \Response::redirect('ebay/promotion');
                    }

                    else
                    {
                        \Session::set_flash('error', e('Could not save promotion.'));
                    }
                }else{
                    \Session::set_flash('error', e('Could not save promotion.'));
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
			else
			{
                \Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Promotions";
		$this->template->content = \View::forge('promotion/create');

	}

	public function action_edit($id = null)
	{
        $promotion = Model_Promotion::find($id);
        $promotion->promotional_sale_starttime = date('Y-m-d',strtotime($promotion->promotional_sale_starttime)).'T'.date('H:i:s',strtotime($promotion->promotional_sale_starttime));
        $promotion->promotional_sale_endtime = date('Y-m-d',strtotime($promotion->promotional_sale_endtime)).'T'.date('H:i:s',strtotime($promotion->promotional_sale_endtime));
		$val = Model_Promotion::validate('edit');

		if ($val->run())
		{
            $ebaytrading = new Ebaytrading();
            $ebaytrading->setSandbox(true);
            $response = $ebaytrading->Editpromotion(
                'UPDATE',
                \Input::post('promotional_sale_name'),
                \Input::post('promotional_sale_type'),
                \Input::post('discount_type'),
                \Input::post('discount_value'),
                new \DateTime(\Input::post('promotional_sale_starttime')),
                new \DateTime(\Input::post('promotional_sale_endtime')),
                (int)\Input::post('promotion_id')
            );

            if ($response->Ack !== 'Failure') {

                $user_info = \Auth::get_user_id();
                $promotion->user_id = $user_info[1];
                $promotion->promotion_id = \Input::post('promotion_id');
                $promotion->promotional_sale_name = \Input::post('promotional_sale_name');
                $promotion->discount_type = \Input::post('discount_type');
                $promotion->discount_value = \Input::post('discount_value');
                $promotion->promotional_sale_type = \Input::post('promotional_sale_type');
                $promotion->promotional_sale_starttime = \Input::post('promotional_sale_starttime');
                $promotion->promotional_sale_endtime = \Input::post('promotional_sale_endtime');

                if ($promotion->save())
                {
                    \Session::set_flash('success', e('Updated promotion #' . $id));
                    \Response::redirect('ebay/promotion');
                }

                else
                {
                    \Session::set_flash('error', e('Could not update promotion #' . $id));
                }

            }else{
                if (isset($response->Errors)) {
                    foreach ($response->Errors as $error) {
                        $erromsg = sprintf("%s: %s :: %s\n\n",
                            $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                            $error->ShortMessage,
                            $error->LongMessage
                        );
                        \Session::set_flash('error', $erromsg);
                    }
                }
                $this->template->set_global('promotion', $promotion, false);

            }
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$promotion->user_id = $val->validated('user_id');
				$promotion->promotion_id = $val->validated('promotion_id');
				$promotion->promotional_sale_name = $val->validated('promotional_sale_name');
				$promotion->discount_type = $val->validated('discount_type');
				$promotion->discount_value = $val->validated('discount_value');
				$promotion->promotional_sale_type = $val->validated('promotional_sale_type');
				$promotion->promotional_sale_starttime = $val->validated('promotional_sale_starttime');
				$promotion->promotional_sale_endtime = $val->validated('promotional_sale_endtime');

                \Session::set_flash('error', $val->error());
			}

			$this->template->set_global('promotion', $promotion, false);
		}

		$this->template->title = "Promotions";
		$this->template->content = \View::forge('promotion/edit');

	}

	public function action_delete($id = null)
	{
		if ($promotion = Model_Promotion::find($id))
		{
            $ebaytrading = new Ebaytrading();
            $ebaytrading->setSandbox(true);
            $response = $ebaytrading->Editpromotion(
                'DELETE',
                '',
                '',
                '',
                '',
                '',
                '',
                (int)$promotion->promotion_id
            );
            if ($response->Ack !== 'Failure') {
                $promotion->delete();
                \Session::set_flash('success', e('Deleted promotion #'.$id));
            }else{
                if (isset($response->Errors)) {
                    foreach ($response->Errors as $error) {
                        $erromsg = sprintf("%s: %s :: %s\n\n",
                            $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                            $error->ShortMessage,
                            $error->LongMessage
                        );
                        \Session::set_flash('error', $erromsg);
                    }
                }
            }
		}
		else
		{
            \Session::set_flash('error', e('Could not delete promotion #'.$id));
		}

        \Response::redirect('ebay/promotion');

	}

}
