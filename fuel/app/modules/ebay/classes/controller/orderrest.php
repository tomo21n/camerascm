<?php
namespace Ebay;

class Controller_Orderrest extends \Controller_Rest
{
    public function action_index()
    {
        $exchange_rate = 100;

        $order_id = \Input::post('order_id');
        $user_info = \Input::post('user_id');
        $where_array = array();
        $where_array[] = array( 'user_id', '=', $user_info );
        $where_array[] = array('order_id','=', $order_id);

        $condition = array('where'=> $where_array);
        $data['order'] = Model_Order::find('all',$condition);

        $order_transaction = $data['order'][$order_id];
        $order_transaction->itemCurUnit = 'USD';
        $order_transaction->itemCount = '1';
        $order_transaction->pkgType = "3"; //0:贈り物　3:商品
        $order_transaction->sale_round_price = round($order_transaction->sale_price,-1);
        $order_transaction->sale_round_yen_price =$order_transaction->sale_round_price * $exchange_rate;
        $order_transaction->shipdate =date('Y/m/d');
        $this->response($order_transaction);
    }

    public function get_inventorysearch()
    {
        $where_array = array();
        $where_array[] = array('inventory_id',\Input::get('inventory_id'));
        $condition = array('where'=> $where_array);

        if ( $data['inventory'] = Model_Inventory::find('all',$condition))
        {
            $this->response($data);
        }

    }

    public function get_specificsearch()
    {
        $where_array = array();
        $where_array[] = array('specific_id',\Input::get('specific_id'));
        $condition = array('where'=> $where_array);

        if ( $data['specific'] = Model_Itemspecific::find('all',$condition))
        {
            $this->response($data);
        }

    }

    public function get_salesparthistsearch()
    {
        $where_array = array();
        $where_array[] = array('inventory_id',\Input::get('inventory_id'));
        $condition = array('where'=> $where_array,'order_by'=> 'start_date');

        if ( $data['salesparthist'] = Model_Salespartshist::find('all',$condition))
        {
            $this->response($data);
        }

    }

    public function get_supplysearch()
    {
        $where_array = array();
        $where_array[] = array('supply_id',\Input::get('supply_id'));
        $condition = array('where'=> $where_array,'order_by'=> 'inventory_id');

        if ( $data['supplylist'] = Model_Vinventsaleshist::find('all',$condition))
        {
            $data['original_supply'] = Model_Supply::find(\Input::get('supply_id'));
            $this->response($data);
        }


    }

}
