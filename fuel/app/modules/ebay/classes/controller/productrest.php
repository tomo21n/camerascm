<?php
namespace Ebay;

class Controller_Productrest extends \Controller_Rest
{
    public function get_productsearch()
    {
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('query'), 's'), -1, PREG_SPLIT_NO_EMPTY);

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
        $data['products'] = Model_Product::find('all',$condition);

        $this->response($data);

    }
    public function get_productedit()
    {
        if (\Input::method() == 'GET')
        {
            $user_info = \Auth::get_user_id();

            if($product = Model_Product::find(\Input::get('product_id'))){

                $user_info = \Auth::get_user_id();
                $product->user_id = $user_info[1];
                $product->product_id = \Input::get('product_id');
                $product->product_name = \Input::get('product_name');
                $product->category = \Input::get('category');
                $product->maker = \Input::get('maker');
                $product->in_upper_price = \Input::get('in_upper_price');
                $product->in_mean_price = \Input::get('in_mean_price');
                $product->in_lower_price = \Input::get('in_lower_price');
                $product->out_upper_price = \Input::get('out_upper_price');
                $product->out_mean_price = \Input::get('out_mean_price');
                $product->out_lower_price = \Input::get('out_lower_price');
                $product->out_search_count = \Input::get('out_search_count');
                $product->comment = \Input::get('comment');

            }else{
                $product = Model_Product::forge(array(
                    'user_id' => $user_info[1],
                    'product_name' => \Input::get('product_name'),
                    'category' => \Input::get('category'),
                    'maker' => \Input::get('maker'),
                    'in_upper_price' => \Input::get('in_upper_price'),
                    'in_mean_price' => \Input::get('in_mean_price'),
                    'in_lower_price' => \Input::get('in_lower_price'),
                    'out_upper_price' => \Input::get('out_upper_price'),
                    'out_mean_price' => \Input::get('out_mean_price'),
                    'out_lower_price' => \Input::get('out_lower_price'),
                    'out_search_count' => \Input::get('out_search_count'),
                    'comment' => \Input::get('comment'),
                ));
            }

            if ($product and $product->save())
            {
                $data["Result"]["product_id"] = $product->product_id;
                $data["Result"]["product_name"] = $product->product_name;
            }

            else
            {
                $data["Result"] = "登録できませんでした";
            }

        }

        $this->response($data);

    }
    public function get_productdetail()
    {
        if ( $data['product'] = Model_Product::find(\Input::get('product_id')))
        {
            $this->response($data);
        }

    }

}
