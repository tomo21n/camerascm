<?php
namespace Ebay;

/**
 * The namespaces provided by the SDK.
 */
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services;
use \DTS\eBaySDK\Trading\Types;
use \DTS\eBaySDK\Trading\Enums;

class Controller_SalesPart extends \Controller_User{

    public static $listing_type = array(
        Enums\ListingTypeCodeType::C_FIXED_PRICE_ITEM => 'Fixed Price',
        Enums\ListingTypeCodeType::C_AUCTION => 'Auction',
    );

    public static $listing_duration = array(
        Enums\ListingDurationCodeType::C_DAYS_1 => '1日間',
        Enums\ListingDurationCodeType::C_DAYS_3 => '3日間',
        Enums\ListingDurationCodeType::C_DAYS_5 => '5日間',
        Enums\ListingDurationCodeType::C_DAYS_7 => '7日間',
        Enums\ListingDurationCodeType::C_DAYS_10 => '10日間',
        Enums\ListingDurationCodeType::C_DAYS_30 => '30日間',
        Enums\ListingDurationCodeType::C_GTC => '期限無',
    );

    public static $sales_category = array(
        15230 => 'フィルムカメラ',
        3323  => 'レンズ',
        30059  => 'アダプタ／チューブ',
        167930  => 'ファインダー',
        29973  => 'フィルムバック／ホルダー',
        64345  => 'シャッター',
        162480 => '他アクセサリ',
    );

    public static $condition_description = array(
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

    public static $store_category = array(
        'Nikon'=>'Nikon',
        'Canon'=>'Canon',
        'Mamiya'=>'Mamiya',
        'Pentax'=>'Pentax',
        'Sigma'=>'Sigma',
        'Minolta'=>'Minolta',
        'Zenza Bronica'=>'Zenza Bronica',
        'Contax'=>'Contax',
        'Tokina'=>'Tokina',
        'Olympus'=>'Olympus',
        'Fuji'=>'Fuji',
        'Cosina'=>'Cosina',
        'Tamron'=>'Tamron',
        'Hasselblad'=>'Hasselblad',
        'Schneider'=>'Schneider',
        'Voigtlander'=>'Voigtlander',
        'Konica'=>'Konica',
        'Kenko'=>'Kenko',
        'Leica'=>'Leica',
        'Other items'=>'Other items',
    );

    static $templete_description =<<<EOM2
<div style="width: 760px; margin: 0px auto;">
###photo###
<div id="top_bar" style="width: 760px; height: 152px; float: left; background-image: url('http://www.east-japan-trade.jp/trs/template/003/003_top.jpg');">&nbsp;</div>
<div style="margin: 0px 0px 20px 0px; float: left;">
<h1>###title###</h1>

<div style="margin: 0px 0px 0px 0px;float: left;">
<div style="background-image: url('http://www.east-japan-trade.jp/trs/template/003/003_banner.jpg');
background-repeat: no-repeat;
background-position: left top;
width:760px; height:40px;
float: left;
color: #ffffff;
padding-top: 10px;
padding-left: 10px;">Description</div>

<div style="margin: 10px 0px 20px 20px; float: left; width: 700px;">
<p><span style="color:rgb(0, 0, 0); font-family:verdana,geneva,dejavu sans,sans-serif; font-size:16px"><strong>Hello, I have been selling with eBay from Japan so I can provide you the best service.<br />
This item is sold out everywhere in Japan and very hard to get it!!<br />
First come, first served.<br />
<br />
This item is in ###Grade###.<br />
<br />
<br />
◆Appearcance<br />
###Appearcance###
<br />
◆Optical<br />
###Optical###
<br />
◆Functional<br />
###Functional###
<br />
◆Including<br />
###Inclueing###
All you can see on the photo will be included.
<br />



<br />
If you have any question or concern, please do not hesitate to contact me.<br />
Thank you for visiting. </strong></span></p>
</div>

<div style="background-image: url('http://www.east-japan-trade.jp/trs/template/003/003_banner.jpg');
background-repeat: no-repeat;
background-position: left top;
width:760px; height:40px;
float: left;
color: #ffffff;
padding-top: 10px;
padding-left: 10px;"><strong>Shipping</strong></div>

<div style="margin: 10px 0px 20px 20px; float: left; width: 700px;">
<p><span style="color:rgb(0, 0, 0); font-family:verdana,geneva,dejavu sans,sans-serif; font-size:16px"><strong>I ship it in Japan post.<br />
attach the tracking number.<br />
Please bid it without worrying.<br />
<br />
Shipping is only available to the address registered in Paypal.<br />
Please note that any address not registered in Paypal is not acceptable to ship. </strong></span></p>
</div>

<div style="background-image: url('http://www.east-japan-trade.jp/trs/template/003/003_banner.jpg');
background-repeat: no-repeat;
background-position: left top;
width:760px; height:40px;
float: left;
color: #ffffff;
padding-top: 10px;
padding-left: 10px;"><strong>Payment</strong></div>

<div style="margin: 10px 0px 20px 20px; float: left; width: 700px;">
<p><span style="color:rgb(0, 0, 0); font-family:verdana,geneva,dejavu sans,sans-serif; font-size:16px"><strong>We accept PayPal only.<br />
<br />
We will ship the item 3 business days after your payment clears. </strong></span></p>
</div>

<div style="background-image: url('http://www.east-japan-trade.jp/trs/template/003/003_banner.jpg');
background-repeat: no-repeat;
background-position: left top;
width:760px; height:40px;
float: left;
color: #ffffff;
padding-top: 10px;
padding-left: 10px;"><strong>About us</strong></div>

<div style="margin: 10px 0px 20px 20px; float: left; width: 700px;">
<p><span style="color:rgb(0, 0, 0); font-family:verdana,geneva,dejavu sans,sans-serif; font-size:16px"><strong>Hello,<br />
<br />
As I have earned only a few feedbacks, you may be very worried to bid my auction.<br />
However,I will provide courteous and responsive service.<br />
If you are looking for a particular item that is not in my listing, please do not hesitate to contact me.<br />
I will look it for you.<br />
<br />
Thank you.<br />
<br />
International Buyers - Please Note:<br />
Import duties, taxes, and charges are not included in the item price or shipping cost.<br />
These charges are the buyer&#39;s responsibility.<br />
Please check with your country&#39;s customs office to determine what these additional costs will be prior to bidding or buying. </strong></span></p>
</div>
</div>
</div>
</div>
EOM2;




    public function action_index()
    {
        $user_info = \Auth::get_user_id();
        $where_array = array();
        $ary_keyword = preg_split('/[\s]+/', mb_convert_kana(\Input::get('word'), 's'), -1, PREG_SPLIT_NO_EMPTY);

        //ユーザIDの指定
        //$where_array[] = array( 'user_id', '=', $user_info[1] );
        //キーワードの指定
        foreach($ary_keyword as $keyword){
            $where_array[] = array('PRODUCT_NAME','like','%'.$keyword.'%');
        };
        $condition = array('where'=> $where_array);
        $data['count'] = Model_Salespart::query($condition)->count();
        //Paginationの環境設定
        $config = array(
            'name' => 'pagination',
            'pagination_url' => \Uri::base().'ebay/salespart/',
            'uri_segment' => 'page',
            'num_links' => 5,
            'per_page' => 50,
            'total_items' => $data['count'],
        );
        //Paginationのセット
        $pagination = \Pagination::forge('pagination', $config);
        $condition += array('limit' => $pagination->per_page);
        $condition += array('offset' => $pagination->offset);
        $data['salesparts'] = Model_Salespart::find('all',$condition);
        $data['pagination'] = $pagination;

        $this->template->title = "SalesPart";
        $this->template->content = \View::forge('salespart/index', $data);

    }

    public function action_create()
    {
        if (\Input::method() == 'POST')
        {
            $val = Model_Salespart::validate('create');

            if ($val->run())
            {
                $user_info = \Auth::get_user_id();
                $salespart = Model_Salespart::forge(array(
                    'user_id' => $user_info[1],
                    'inventory_id' => \Input::post('inventory_id'),
                    'product_id' => \Input::post('product_id'),
                    'product_name' => \Input::post('product_name'),
                    'eBay_item_number' => \Input::post('eBay_item_number'),
                    'selling_type' => \Input::post('selling_type'),
                    'listing_duration' => \Input::post('listing_duration'),
                    'start_price' => \Input::post('start_price'),
                    'best_offer' => \Input::post('best_offer'),
                    'best_offer_auto_accept' => \Input::post('best_offer_auto_accept'),
                    'best_offer_minimum' => \Input::post('best_offer_minimum'),
                    'title' => \Input::post('title'),
                    'description' => \Input::post('description'),
                    'sku' => \Input::post('sku'),
                    'serialno' => \Input::post('serialno'),
                    'category_id' => \Input::post('category_id'),
                    'condition_description' => \Input::post('condition_description'),
                    'store_category_name' => \Input::post('store_category_name'),
                    'specific_id' => \Input::post('specific_id'),
                    'shipping_id' => \Input::post('shipping_id'),
                    'start_date' => \Input::post('start_date'),
                    'end_date' => \Input::post('end_date'),
                    'picture_url' => \Input::post('picture_url'),
                    'including' => \Input::post('including'),
                    'created_at' => \Input::post('created_at'),
                    'updated_at' => \Input::post('updated_at'),
                ));

                if ($salespart and $salespart->save())
                {
                    $array_product = array('product_id'=>\Input::post('product_id'),
                        'product_name'=>\Input::post('product_name'),
                        'specific_id'=>\Input::post('specific_id'));

                    $array_specific_item_id = \Input::post('specific_item_id');
                    $array_specific_item_value = \Input::post('specific_item_value');
                    $array_specific_item = array();

                    for($i=0;$i<count($array_specific_item_id);$i++){
                        if(!is_null($array_specific_item_id[$i])){
                            $array_specific_item[$array_specific_item_id[$i]] =  $array_specific_item_value[$i];
                        }
                    }
                    if(!Model_Itemspecific::allupdate($array_product,$array_specific_item)){
                        \Session::set_flash('error', 'Could not update salespart #' . $salespart->id);
                    }else{
                        \Session::set_flash('success', 'Updated salespart #' . $salespart->id);

                    }

                    Model_Inventory::changestatus(\Input::post('inventory_id'),'出品準備中',$salespart->id);

                    \Session::set_flash('success', 'Added salespart #'.$salespart->id.'.');

                    \Response::redirect('ebay/salespart/view/'.$salespart->id);
                }

                else
                {
                    \Session::set_flash('error', 'Could not save salespart.');
                }
            }
            else
            {
                \Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Salesparts";
        $this->template->content = \View::forge('salespart/create');

    }

    public function action_edit($salespart_id = null)
    {
        is_null($salespart_id) and \Response::redirect('salespart');

        if ( ! $salespart = Model_Salespart::find($salespart_id))
        {
            \Session::set_flash('error', 'Could not find salespart #'.$salespart_id);
            \Response::redirect('ebay/salespart');
        }


        $val = Model_Salespart::validate('edit');

        if ($val->run())
        {
            $user_info = \Auth::get_user_id();
            $salespart->user_id = $user_info[1];
            $salespart->inventory_id = \Input::post('inventory_id');
            $salespart->product_id = \Input::post('product_id');
            $salespart->product_name = \Input::post('product_name');
            $salespart->eBay_item_number = \Input::post('eBay_item_number');
            $salespart->selling_type = \Input::post('selling_type');
            $salespart->listing_duration = \Input::post('listing_duration');
            $salespart->start_price = \Input::post('start_price');
            $salespart->best_offer = \Input::post('best_offer');
            $salespart->best_offer_auto_accecpt = \Input::post('best_offer_auto_accecpt');
            $salespart->best_offer_minimum = \Input::post('best_offer_minimum');
            $salespart->title = \Input::post('title');
            $salespart->description = \Input::post('description');
            $salespart->sku = \Input::post('sku');
            $salespart->serialno = \Input::post('serialno');
            $salespart->category_id = \Input::post('category_id');
            $salespart->condition_description = \Input::post('condition_description');
            $salespart->store_category_name = \Input::post('store_category_name');
            $salespart->specific_id = \Input::post('specific_id');
            $salespart->shipping_id = \Input::post('shipping_id');
            $salespart->start_date = \Input::post('start_date');
            $salespart->end_date = \Input::post('end_date');
            $salespart->picture_url = \Input::post('picture_url');
            $salespart->including = \Input::post('including');
            $salespart->created_at = \Input::post('created_at');
            $salespart->updated_at = \Input::post('updated_at');

            if ($salespart->save())
            {
                $array_product = array('product_id'=>\Input::post('product_id'),
                                        'product_name'=>\Input::post('product_name'),
                                        'specific_id'=>\Input::post('specific_id'));

                $array_specific_item_id = \Input::post('specific_item_id');
                $array_specific_item_value = \Input::post('specific_item_value');
                $array_specific_item = array();

                for($i=0;$i<count($array_specific_item_id);$i++){
                    if(!is_null($array_specific_item_id[$i])){
                        $array_specific_item[$array_specific_item_id[$i]] =  $array_specific_item_value[$i];
                    }
                }
                if(!Model_Itemspecific::allupdate($array_product,$array_specific_item)){

                    \Session::set_flash('error', 'Could not update itemspecific #' . $salespart_id);

                }else{

                    \Session::set_flash('success', 'Updated salespart #' . $salespart_id);

                }
                \Session::set_flash('success', 'Updated salespart #' . $salespart_id);
                \Response::redirect('ebay/salespart/view/'.$salespart->id);
            }

            else
            {
                \Session::set_flash('error', 'Could not update salespart #' . $salespart_id);
            }
        }

        else
        {
            $itemspecific_list = Model_Itemspecific::find('all',array(
                'where' => array(
                    array('specific_id', $salespart->specific_id ),
                ),
            ));
            $itemspecific = array();
            foreach($itemspecific_list as $item){
                $itemspecific[] =array($item->name => $item->value);
            }

            if (\Input::method() == 'POST')
            {
                $user_info = \Auth::get_user_id();
                $salespart->user_id = $user_info[1];
                $salespart->inventory_id = $val->validated('inventory_id');
                $salespart->product_id = $val->validated('product_id');
                $salespart->product_name = $val->validated('product_name');
                $salespart->eBay_item_number = $val->validated('eBay_item_number');
                $salespart->selling_type = $val->validated('selling_type');
                $salespart->listing_duration = $val->validated('listing_duration');
                $salespart->start_price = $val->validated('start_price');
                $salespart->best_offer = $val->validated('best_offer');
                $salespart->best_offer_auto_accecpt = $val->validated('best_offer_auto_accecpt');
                $salespart->best_offer_minimum = $val->validated('best_offer_minimum');
                $salespart->title = $val->validated('title');
                $salespart->description = $val->validated('description');
                $salespart->sku = $val->validated('sku');
                $salespart->serialno = $val->validated('serialno');
                $salespart->category_id = $val->validated('category_id');
                $salespart->condition_description = $val->validated('condition_description');
                $salespart->store_category_name = $val->validated('store_category_name');
                $salespart->specific_id = $val->validated('specific_id');
                $salespart->shipping_id = $val->validated('shipping_id');
                $salespart->start_date = $val->validated('start_date');
                $salespart->end_date = $val->validated('end_date');
                $salespart->picture_url = $val->validated('picture_url');
                $salespart->including = $val->validated('including');
                $salespart->created_at = $val->validated('created_at');
                $salespart->updated_at = $val->validated('updated_at');

                \Session::set_flash('error', $val->error());
            }

            $this->template->set_global('salespart', $salespart, false);
            $this->template->set_global('itemspecific', $itemspecific, false);
        }

        $this->template->title = "Salesparts";
        $this->template->content = \View::forge('salespart/edit');

    }

    public function action_delete($salespart_id = null)
    {
        is_null($salespart_id) and \Response::redirect('ebay/salespart');

        if ($salespart = Model_Salespart::find($salespart_id))
        {
            $salespart->delete();

            \Session::set_flash('success', 'Deleted salespart #'.$salespart_id);
        }

        else
        {
            \Session::set_flash('error', 'Could not delete salespart #'.$salespart_id);
        }

        \Response::redirect('ebay/salespart');

    }

    public function action_invtosales($id)
    {

        if (!is_null($id))
        {
            $inventory = Model_Inventory::find($id);

            $picture_array = explode("\n", $inventory->ejt_picture_url);
            $picture_html = null;
            foreach($picture_array as $picture){
                $picture_html.= '<br><img src="'.$picture.'">';
            }

            $description = Controller_SalesPart::$templete_description;
            $description = str_replace('###title###',$inventory->product_name,$description);
            $description = str_replace('###Grade###',$inventory->grade,$description);
            $description = str_replace('###photo###',preg_replace("/\r\n|\r|\n/", '</br>', $picture_html),$description);
            $description = str_replace('###Inclueing###',preg_replace("/\r\n|\r|\n/", '</br>', $inventory->including_en),$description);
            $description = str_replace('###Appearcance###',preg_replace("/\r\n|\r|\n/", '</br>', $inventory->appearance_en_1),$description);
            $description = str_replace('###Functional###',preg_replace("/\r\n|\r|\n/", '</br>', $inventory->functional_en_1),$description);
            $description = str_replace('###Optical###',preg_replace("/\r\n|\r|\n/", '</br>', $inventory->optical_en_1),$description);
            $user_info = \Auth::get_user_id();
            $salespart = Model_Salespart::forge(array(
                'user_id' => $user_info[1],
                'inventory_id'=>$inventory->inventory_id,
                'product_id'=>$inventory->product_id,
                'specific_id'=>$inventory->product_id,
                'product_name'=>$inventory->product_name,
                'sku'=>$inventory->inventory_id,
                'selling_type'=>'FixedPriceItem',
                'listing_duration'=>'Days_5',
                'serialno'=>$inventory->serialno,
                'start_price'=>$inventory->reference_sale_price,
                'title'=>$inventory->product_name.' from Japan['.strtoupper($inventory->grade).']('.$inventory->inventory_id.')',
                'description'=>$description,
                'condition_description'=>$inventory->grade,
                'store_category_name'=>$inventory->maker,
                'picture_url'=>$inventory->picture_url,
                'including'=>$inventory->including_en
            ));

            $test = $inventory->including_en;
            $this->template->set_global('salespart', $salespart, false);

        }

        $this->template->title = "Salesparts";
        $this->template->content = \View::forge('salespart/create');

    }

    public function action_GetPromotionalSaleDetails()
    {
        $sandbox = false;
        $service = new Services\TradingService(Controller_SalesPart::tradingserviceconfig($sandbox));
        $request = new Types\GetPromotionalSaleDetailsRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = Controller_SalesPart::getToken($sandbox);

        $request->PromotionalSaleStatus[] = Enums\PromotionalSaleStatusCodeType::C_SCHEDULED;

        /**
         * Send the request to the GetMyeBaySelling service operation.
         */
        $response = $service->getPromotionalSaleDetails($request);
        /**
         * Output the result of calling the service operation.
         *
         * For more information about working with the service response object, see:
         * http://devbay.net/sdk/guides/getting-started/#response-object
         */
        var_dump($response);
        echo "==================\nResults for page \n==================\n";
        if (isset($response->Errors)) {
            foreach ($response->Errors as $error) {
                printf("%s: %s\n%s\n\n",
                    $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                    $error->ShortMessage,
                    $error->LongMessage
                );
            }
        }
//        if ($response->Ack !== 'Failure' && isset($response)) {
//            foreach ($response->ItemArray->Item as $item) {
//                printf("(%s) %s: %s %.2f\n",
//                    $item->ItemID,
//                    $item->Title,
//                    $item->SellingStatus->CurrentPrice->currencyID,
//                    $item->SellingStatus->CurrentPrice->value
//                );
//                var_dump($item);
//            }
//        }


        //$data['salesParts'] = Model_SalesPart::find('all');
        //$this->template->title = "SalesParts";
        //$this->template->content = \View::forge('product/index', $data);

    }


    public function action_orders()
    {

        $config =  array(
            'sandbox' => array(
                'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                'appId' => 'TomokiNa-9797-4eda-af65-afed6013a8d8',
                'certId' => '9c26a657-0ce1-44de-b6e1-03b15300ff45',
                'userToken' => 'AgAAAA**AQAAAA**aAAAAA**Vdc5VA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJiGqQ2dj6x9nY+seQ**whADAA**AAMAAA**547n2SGblWqVk1YOVjMNoxF6mAvcbUVxpyPuOLe6RwnWA4q5XrTHkc5/1MwnTe4dBx/jZmsqFRBdwuIn6aDnCO8kLxWOzB2YwB0GzMqZE+KveNvs/1vW3dPdpu+JHs2P46QVMDC7IjgYvzaioiBB5gjBTVZwurv0Hso2RE0VIcAko4mz3UfQEBFjbDFvr0mlam5UnLjfiOJQ7QVN7JP8R3Ia7a10JxS0E+u/2lNLZRDeOOlndwlFH89f0rLd+3WM8cNZedGWIayc2TugFcmWBtEYfi1EcLG0hqnzzZoHgLp+OMDWKYh4WSKwmI0Q4IkpxjaP7mHYbI02UU4PehFE9NBOatIm2bx/LNQ3aaUZ+lIcTCz0MF3l/W/Jm7r6txoHc2Q1stDrYCQHSdqG/JhuqKDdw9zwhC/lA/ljZGdB7vWQ8mHZAC8z8RHNIAGKqmUwFBoOGJE4eu4KmTX+C74BesTaAASmFwvdZv1IpocU1XB6qxOiHhnhIRSAP+JIXTioLxOWxKgbfY2FmWEdLBh9MC9cvKQ/T1JSJ4FySAxPkczP/KZV7xpnQkEVyYpwDDfMBojuG1FGMvDY7cbRLU6xfvwJzGBm1g+XSCoiPY9+uvTVPBz9b6qPJt17+ktxi0tPSZnatm+dtbm+LWlLb3B8/bp4YjCltDgE8oiIAIEuNNpWlHOqiOPLKWv7lXAIAGzwaVkQeEtZahpR1FLYlxF0l6rtVdVHupDUY+k/xVwZjBQzq0dg9vJv4X4eqb/tLjuS'
            ),
            'production' => array(
                'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                'appId' => 'TomokiNa-b1e9-4e0b-b610-02e89c6545a9',
                'certId' => '91f50789-7d06-43da-9c99-73096c0fa85b',
                'userToken' => 'AgAAAA**AQAAAA**aAAAAA**o6OmVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**6nezNrf7PISDaLKR0R8YhfpBVgpgWKtr3zL+0bcpR7vu79SUYZ4Tp0XnVE3/g/odXa3ji1FTVk0ECEkH11zfafkrg9A3yKLubXR+nX3po6IeG9B8UOBg+Omn7WdApp09aQtk0b9Dr1bj+QX9BRUOv/EswHqsdMJ1uhPCIttYIxqGWTcHRMRExMjTt1+1nbgP6bvfq3ZOpnE0UdgSBkhc6Lk0/jl5AV82ynpiprIPKkCGSDgSIILmqAdd5AQwK5lAzLB0kETTKjVXg/HkEzS22+01Agn0hDLQrIRmxEhznJa/QgiW0Rd2nUK4pm7xTB93qee5PzCc6cFy/pnyesDRbWSLt6YcM7k795A0UXafbP5G+atzvleE1ud7Gyk9tyKtndV8rByXUVJ77EH/ceUsU131Q1z0dqni1ZMfNy82ns4cmaxHiYyng/J8gj8hrqq4QFlk/cC3URShkttzZORw6uelySITGCy3MCZY/twgBKDK/hCIoRzkKfNBzVBq1r6UrpxwKEOBFgO8C3w34An/IAwqZVuY0Kfw3MVn/3Evh5CUWCE2yxDaAAWnzFQ6DZnayggfvlf1tiDFkzQbaPQtmnSXyomJdBPZnX9a7X5Xf5l8mbH2qfeAZ2ul5DkvTx4GDdKG9soZI9PG2PIFUF1BHAUWMabM+WTcNCbWewwyozJIGRZx1pcjQR0BtNdBt7LmGtbLx5xeRaAcOJ0bdDiGMCZleWHfoTic4KlP/HI8cPjhcmboHzOuNFfh98G/4XIY'
            ),
            'findingApiVersion' => '1.12.0',
            'tradingApiVersion' => '871',
            'shoppingApiVersion' => '871',
            'halfFindingApiVersion' => '1.2.0'
        );

        /**
         * Create the service object.
         *
         * For more information about creating a service object, see:
         * http://devbay.net/sdk/guides/getting-started/#service-object
         */
        $service = new Services\TradingService(array(
            'apiVersion' => $config['tradingApiVersion'],
            'sandbox' => true,
            'siteId' => Constants\SiteIds::US
        ));
        /**
         * Create the request object.
         *
         * For more information about creating a request object, see:
         * http://devbay.net/sdk/guides/getting-started/#request-object
         */
        $request = new Types\GetOrdersRequestType();
        /**
         * An user token is required when using the Trading service.
         *
         * For more information about getting your user tokens, see:
         * http://devbay.net/sdk/guides/application-keys/
         */
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $config['sandbox']['userToken'];
        //$request->RequesterCredentials->eBayAuthToken = $config['production']['userToken'];
        /**
         * Request that eBay returns the list of actively selling items.
         * We want 10 items per page and they should be sorted in descending order by the current price.
         */

        $request->ModTimeFrom = new \DateTime('2015-09-21 23:01:05');
        $request->ModTimeTo =new \DateTime('2015-09-24 23:01:05');

        $request->OrderRole = 'Seller';
        //$request->OrderStatus ='Completed';
        //$request->DetailLevel[] = Enums\DetailLevelCodeType::C_RETURN_ALL;

        $response = $service->getOrders($request);
        /**
         * Output the result of calling the service operation.
         *
         * For more information about working with the service response object, see:
         * http://devbay.net/sdk/guides/getting-started/#response-object
         */
        echo "==================\nResults for page \n==================\n";
        var_dump($response);
        if (isset($response->Errors)) {
            foreach ($response->Errors as $error) {
                printf("%s: %s\n%s\n\n",
                    $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                    $error->ShortMessage,
                    $error->LongMessage
                );
            }
        }
        if ($response->Ack !== 'Failure' && isset($response->OrderArray)) {
            //var_dump($response->OrderArray);
            foreach ($response->OrderArray->Order as $order) {
                printf("%s: %s: %s %s %s %s\n%s:%s , %s , %s , %s , %s , %s , %s , %s , %s , %s , %s, %s, %s, %s , %s \n\n",
                    $order->OrderID,
                    $order->OrderStatus,
                    $order->CheckoutStatus->Status,
                    ($order->Subtotal->currencyID . $order->Subtotal->value),
                    ($order->Total->currencyID . $order->Total->value),
                    ($order->AmountPaid->currencyID . $order->AmountPaid->value),
                    $order->BuyerUserID,
                    $order->ShippingAddress->Name,
                    $order->ShippingAddress->Street1,
                    $order->ShippingAddress->Street2,
                    $order->ShippingAddress->CityName,
                    $order->ShippingAddress->StateOrProvince,
                    $order->ShippingAddress->Country,
                    $order->ShippingAddress->CountryName,
                    $order->ShippingAddress->Phone,
                    $order->ShippingAddress->PostalCode,
                    $order->TransactionArray->Transaction[0]->Buyer->Email,
                    $order->TransactionArray->Transaction[0]->Item->ItemID,
                    $order->TransactionArray->Transaction[0]->Item->Title,
                    $order->TransactionArray->Transaction[0]->OrderLineItemID,
                    $order->CreatedTime->format('Y-m-d H:i:s'),
                    isset($order->PaidTime)? $order->PaidTime->format('Y-m-d H:i:s'):null
                );
                var_dump($order);
            }
        }


        //$data['salesParts'] = Model_SalesPart::find('all');
        //$this->template->title = "SalesParts";
        //$this->template->content = \View::forge('product/index', $data);

    }

    public function action_completesale()
    {

        /**
         * Create Configuration.
         */
        $config =  array(
            'sandbox' => array(
                'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                'appId' => 'TomokiNa-9797-4eda-af65-afed6013a8d8',
                'certId' => '9c26a657-0ce1-44de-b6e1-03b15300ff45',
                'userToken' => 'AgAAAA**AQAAAA**aAAAAA**hjB8VQ**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJiGqQ2dj6x9nY+seQ**whADAA**AAMAAA**547n2SGblWqVk1YOVjMNoxF6mAvcbUVxpyPuOLe6RwnWA4q5XrTHkc5/1MwnTe4dBx/jZmsqFRBdwuIn6aDnCO8kLxWOzB2YwB0GzMqZE+KveNvs/1vW3dPdpu+JHs2P46QVMDC7IjgYvzaioiBB5gjBTVZwurv0Hso2RE0VIcAko4mz3UfQEBFjbDFvr0mlam5UnLjfiOJQ7QVN7JP8R3Ia7a10JxS0E+u/2lNLZRDeOOlndwlFH89f0rLd+3WM8cNZedGWIayc2TugFcmWBtEYfi1EcLG0hqnzzZoHgLp+OMDWKYh4WSKwmI0Q4IkpxjaP7mHYbI02UU4PehFE9NBOatIm2bx/LNQ3aaUZ+lIcTCz0MF3l/W/Jm7r6txoHc2Q1stDrYCQHSdqG/JhuqKDdw9zwhC/lA/ljZGdB7vWQ8mHZAC8z8RHNIAGKqmUwFBoOGJE4eu4KmTX+C74BesTaAASmFwvdZv1IpocU1XB6qxOiHhnhIRSAP+JIXTioLxOWxKgbfY2FmWEdLBh9MC9cvKQ/T1JSJ4FySAxPkczP/KZV7xpnQkEVyYpwDDfMBojuG1FGMvDY7cbRLU6xfvwJzGBm1g+XSCoiPY9+uvTVPBz9b6qPJt17+ktxi0tPSZnatm+dtbm+LWlLb3B8/bp4YjCltDgE8oiIAIEuNNpWlHOqiOPLKWv7lXAIAGzwaVkQeEtZahpR1FLYlxF0l6rtVdVHupDUY+k/xVwZjBQzq0dg9vJv4X4eqb/tLjuS'
            ),
            'production' => array(
                'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                'appId' => 'TomokiNa-b1e9-4e0b-b610-02e89c6545a9',
                'certId' => '91f50789-7d06-43da-9c99-73096c0fa85b',
                'userToken' => 'AgAAAA**AQAAAA**aAAAAA**o6OmVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**6nezNrf7PISDaLKR0R8YhfpBVgpgWKtr3zL+0bcpR7vu79SUYZ4Tp0XnVE3/g/odXa3ji1FTVk0ECEkH11zfafkrg9A3yKLubXR+nX3po6IeG9B8UOBg+Omn7WdApp09aQtk0b9Dr1bj+QX9BRUOv/EswHqsdMJ1uhPCIttYIxqGWTcHRMRExMjTt1+1nbgP6bvfq3ZOpnE0UdgSBkhc6Lk0/jl5AV82ynpiprIPKkCGSDgSIILmqAdd5AQwK5lAzLB0kETTKjVXg/HkEzS22+01Agn0hDLQrIRmxEhznJa/QgiW0Rd2nUK4pm7xTB93qee5PzCc6cFy/pnyesDRbWSLt6YcM7k795A0UXafbP5G+atzvleE1ud7Gyk9tyKtndV8rByXUVJ77EH/ceUsU131Q1z0dqni1ZMfNy82ns4cmaxHiYyng/J8gj8hrqq4QFlk/cC3URShkttzZORw6uelySITGCy3MCZY/twgBKDK/hCIoRzkKfNBzVBq1r6UrpxwKEOBFgO8C3w34An/IAwqZVuY0Kfw3MVn/3Evh5CUWCE2yxDaAAWnzFQ6DZnayggfvlf1tiDFkzQbaPQtmnSXyomJdBPZnX9a7X5Xf5l8mbH2qfeAZ2ul5DkvTx4GDdKG9soZI9PG2PIFUF1BHAUWMabM+WTcNCbWewwyozJIGRZx1pcjQR0BtNdBt7LmGtbLx5xeRaAcOJ0bdDiGMCZleWHfoTic4KlP/HI8cPjhcmboHzOuNFfh98G/4XIY'
            ),
            'findingApiVersion' => '1.12.0',
            'tradingApiVersion' => '871',
            'shoppingApiVersion' => '871',
            'halfFindingApiVersion' => '1.2.0'
        );

        /**
         * Create the service object.
         */
        $service = new Services\TradingService(array(
            'apiVersion' => $config['tradingApiVersion'],
            'sandbox' => true,
            'siteId' => Constants\SiteIds::US
        ));
        /**
         * Create the request object.
         */
        $request = new Types\CompleteSaleRequestType();
        /**
         * An user token is required when using the Trading service.
         */
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $config['sandbox']['userToken'];
        //$request->RequesterCredentials->eBayAuthToken = $config['production']['userToken'];


        /**
         * Setting Request
         */

        //OrderID
        $request->OrderID = '110154724486-27388090001';

        //Shippment
        $shippmenttype = new Types\ShipmentType();
        $shippmenttype->ShipmentTrackingDetails->ShippingCarrierUsed = 'Japan Post';
        $shippmenttype->ShipmentTrackingDetails->ShipmentTrackingNumber = 'EL222222222JP';
        $request->Shipment = $shippmenttype;
        $request->Shipped = true;

        //Feedback
        $feedbackinfotype = new Types\FeedbackInfoType();
        $feedbackinfotype->CommentText = 'Excellent!!!!!!!!!!!!!!!!A+++';
        $feedbackinfotype->CommentType = Enums\CommentTypeCodeType::C_POSITIVE;
        $request->FeedbackInfo = $feedbackinfotype;


        $response = $service->completeSale($request);

        /**
         * Output the result of calling the service operation.
         */
        echo "==================\nResults for page \n==================\n";
        //var_dump($response);
        if (isset($response->Errors)) {
            foreach ($response->Errors as $error) {
                printf("%s: %s\n%s\n\n",
                    $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                    $error->ShortMessage,
                    $error->LongMessage
                );
            }
        }
        if ($response->Ack !== 'Failure') {
            printf("Complete Sale Excute!! \n");
        }


        //$data['salesParts'] = Model_SalesPart::find('all');
        //$this->template->title = "SalesParts";
        //$this->template->content = \View::forge('product/index', $data);

    }


    public function action_japanpost()
    {
        $output = `ls -al`;
        echo "<pre>$output</pre>";


    }

    public function action_view($id = null)
	{
        if (\Input::method() == 'POST')
        {
            $config =  array(
                'sandbox' => array(
                    'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                    'appId' => 'TomokiNa-9797-4eda-af65-afed6013a8d8',
                    'certId' => '9c26a657-0ce1-44de-b6e1-03b15300ff45',
                    'userToken' => 'AgAAAA**AQAAAA**aAAAAA**Vdc5VA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJiGqQ2dj6x9nY+seQ**whADAA**AAMAAA**547n2SGblWqVk1YOVjMNoxF6mAvcbUVxpyPuOLe6RwnWA4q5XrTHkc5/1MwnTe4dBx/jZmsqFRBdwuIn6aDnCO8kLxWOzB2YwB0GzMqZE+KveNvs/1vW3dPdpu+JHs2P46QVMDC7IjgYvzaioiBB5gjBTVZwurv0Hso2RE0VIcAko4mz3UfQEBFjbDFvr0mlam5UnLjfiOJQ7QVN7JP8R3Ia7a10JxS0E+u/2lNLZRDeOOlndwlFH89f0rLd+3WM8cNZedGWIayc2TugFcmWBtEYfi1EcLG0hqnzzZoHgLp+OMDWKYh4WSKwmI0Q4IkpxjaP7mHYbI02UU4PehFE9NBOatIm2bx/LNQ3aaUZ+lIcTCz0MF3l/W/Jm7r6txoHc2Q1stDrYCQHSdqG/JhuqKDdw9zwhC/lA/ljZGdB7vWQ8mHZAC8z8RHNIAGKqmUwFBoOGJE4eu4KmTX+C74BesTaAASmFwvdZv1IpocU1XB6qxOiHhnhIRSAP+JIXTioLxOWxKgbfY2FmWEdLBh9MC9cvKQ/T1JSJ4FySAxPkczP/KZV7xpnQkEVyYpwDDfMBojuG1FGMvDY7cbRLU6xfvwJzGBm1g+XSCoiPY9+uvTVPBz9b6qPJt17+ktxi0tPSZnatm+dtbm+LWlLb3B8/bp4YjCltDgE8oiIAIEuNNpWlHOqiOPLKWv7lXAIAGzwaVkQeEtZahpR1FLYlxF0l6rtVdVHupDUY+k/xVwZjBQzq0dg9vJv4X4eqb/tLjuS'
                ),
                'production' => array(
                    'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
                    'appId' => 'TomokiNa-b1e9-4e0b-b610-02e89c6545a9',
                    'certId' => '91f50789-7d06-43da-9c99-73096c0fa85b',
                   // 'userToken' => 'AgAAAA**AQAAAA**aAAAAA**o6OmVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**6nezNrf7PISDaLKR0R8YhfpBVgpgWKtr3zL+0bcpR7vu79SUYZ4Tp0XnVE3/g/odXa3ji1FTVk0ECEkH11zfafkrg9A3yKLubXR+nX3po6IeG9B8UOBg+Omn7WdApp09aQtk0b9Dr1bj+QX9BRUOv/EswHqsdMJ1uhPCIttYIxqGWTcHRMRExMjTt1+1nbgP6bvfq3ZOpnE0UdgSBkhc6Lk0/jl5AV82ynpiprIPKkCGSDgSIILmqAdd5AQwK5lAzLB0kETTKjVXg/HkEzS22+01Agn0hDLQrIRmxEhznJa/QgiW0Rd2nUK4pm7xTB93qee5PzCc6cFy/pnyesDRbWSLt6YcM7k795A0UXafbP5G+atzvleE1ud7Gyk9tyKtndV8rByXUVJ77EH/ceUsU131Q1z0dqni1ZMfNy82ns4cmaxHiYyng/J8gj8hrqq4QFlk/cC3URShkttzZORw6uelySITGCy3MCZY/twgBKDK/hCIoRzkKfNBzVBq1r6UrpxwKEOBFgO8C3w34An/IAwqZVuY0Kfw3MVn/3Evh5CUWCE2yxDaAAWnzFQ6DZnayggfvlf1tiDFkzQbaPQtmnSXyomJdBPZnX9a7X5Xf5l8mbH2qfeAZ2ul5DkvTx4GDdKG9soZI9PG2PIFUF1BHAUWMabM+WTcNCbWewwyozJIGRZx1pcjQR0BtNdBt7LmGtbLx5xeRaAcOJ0bdDiGMCZleWHfoTic4KlP/HI8cPjhcmboHzOuNFfh98G/4XIY'
                    'userToken' => 'AgAAAA**AQAAAA**aAAAAA**7LNvVw**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**qg/Q/BLL0JXIvylCDSldARkXWfsqllPiEpaiKIuAcB968TcZvuJ5HQDxYEbkKbLhWU2TXvAfH5SzGkONaOTK9g2q2YhXossGcozEW5FHDDFHT2wn46t00F2WPU1u5fAlKcLj+Yt0QjpEPExKEkuNda40Huevg3YTDMd3qzx4U2bxt/GYnTlegnxeAaDF6297sJtPr7GknXvS2Qd/dVjoIC0Vj/RgQw5Yv3wWL/Ky6wOXP6lYA6buZqVTaMLf2twImNJQce/4owsgg8Ph/OOE6ixkBc7mOtPfUTBoe8BiVjd9hdCeMOXdWTpe6UPP6cErvqM3MH/pCc75TuoSyB6bOdOeDxpPjSejSPefd4j4wtKsVYusfpTB4NlNMFpfeFcr/qwc1OzCZZaoNH5EdbUzVDM4BR4D3uzhbqMqIarooKz1V3WKh4iJYEovKrlDig/0BTFm0ZDSuDzlvWGPF8bikFgggemCpLd8V7OcfuthQ4SzXkqdt3yMzzRVdyg2vMmVCJzU3BAg8iPBRu47lIMkJyaexONvIa91uyIpEwS4v/AY3G7v5KKtagHmwAO3XvMhS4aDoiTFnqnCBWFFcEiQxSIHgnPyaOvqHV+RX8s2vLYCgcOmkJ9TU5zpb2LGCABo0tN3+xKv4j7DpdcDiQ2hkRG9/RfG7U3hBU1Iyso6cACCJvKCdI0fzKc6vpWsyKmpiTHSGYLsWSSvVsBIbjokfR1fHGsy9WI9WFahwSird79oRL8RXLijS4zFSzTAMhLC'
        ),
                'findingApiVersion' => '1.12.0',
                'tradingApiVersion' => '871',
                'shoppingApiVersion' => '871'
            );

            /**
             * 出品サイト（US）
             */
            $siteId = Constants\SiteIds::US;

            /**
             * 使用するAPIのバージョン
             */
            $service = new Services\TradingService(array(
                'apiVersion' => $config['tradingApiVersion'],
                //'sandbox' => true,
                'siteId' => $siteId
            ));

            /**
             * Create the request object.
             */
            $request = new Types\AddFixedPriceItemRequestType();

            /**
             *　ユーザトークンを使用する場合は、ここを設定する。
             */
            $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
            $request->RequesterCredentials->eBayAuthToken = $config['production']['userToken'];

            /**
             * 価格の設定
             */
            $item = new Types\ItemType();
            //固定価格（オークション形式：C_AUCTION、固定価格：C_FIXED_PRICE_ITEM）
            $item->ListingType = \Input::post('selling_type');
            //数量
            $item->Quantity = 1;
            //出品期間 3日間：C_DAYS_3　5日間：C_DAYS_5 7日間：C_DAYS_7 ,ずっと：C_GTC
            $item->ListingDuration = \Input::post('listing_duration');
            //開始価格
            $item->StartPrice = new Types\AmountType(array('value' => (double)\Input::post('start_price')));
            //BestOfferの設定
            $item->BestOfferDetails = new Types\BestOfferDetailsType();
            if(\Input::post('best_offer')){
                $item->BestOfferDetails->BestOfferEnabled = true;
            }else{
                $item->BestOfferDetails->BestOfferEnabled = false;
            }
            //BestOfferの自動承認（BestOfferAutoAcceptPrice）と最低価格（MinimumBestOfferPrice）の設定
            if(\Input::post('best_offer')){
                $item->ListingDetails = new Types\ListingDetailsType();
                if(\Input::post('best_offer_auto_accept') > 0){
                    $item->ListingDetails->BestOfferAutoAcceptPrice = new Types\AmountType(array('value' => (double)\Input::post('best_offer_auto_accept')));

                }if(\Input::post('best_offer_minimum') > 0){
                   $item->ListingDetails->MinimumBestOfferPrice = new Types\AmountType(array('value' => (double)\Input::post('best_offer_minimum')));
                }
            }

            /**
             * 商品情報
             */
            $item->Title = \Input::post('title');
            $item->Description =htmlspecialchars(\Input::post('description'));
            $item->SKU = \Input::post('sku');
            $item->Country = 'JP';
            $item->Location = 'Shinagawa-ku,Tokyo-to';
            $item->PostalCode = '1420064';
            $item->Currency = 'USD';
            $item->HitCounter = Enums\HitCounterCodeType::C_HIDDEN_STYLE;

            /**
             * 写真設定
             */
            $item->PictureDetails = new Types\PictureDetailsType();
            $item->PictureDetails->GalleryType = Enums\GalleryTypeCodeType::C_GALLERY;
            $picture_array = array();
            $picture_array = explode("\n", \Input::post('picture_url'));
            $item->PictureDetails->PictureURL = $picture_array;
            /**
             * カテゴリID（フィルムカメラ：15230,レンズ：3323）
             */
            $item->PrimaryCategory = new Types\CategoryType();
            $item->PrimaryCategory->CategoryID = \Input::post('category_id');

            /**
             * Item Specifics
             */
            //Bundled Items
            $item->ItemSpecifics = new Types\NameValueListArrayType();
            $specific = new Types\NameValueListType();
            $specific->Name = 'Bundled Items';
            $bundled_items = explode("\n", \Input::post('including'));
            foreach($bundled_items as $bundled_item){
                  $specific->Value[] = $bundled_item;
            }
            $item->ItemSpecifics->NameValueList[] = $specific;

            //MPN
            $specific = new Types\NameValueListType();
            $specific->Name = 'MPN';
            $specific->Value[] = \Input::post('serialno');
            $item->ItemSpecifics->NameValueList[] = $specific;


            $itemspecific_array = Model_Itemspecific::find('all',array(
                'where' => array(
                    array('specific_id', \Input::post('specific_id')),
                ),
            ));

            foreach($itemspecific_array as $itemspecific){
                $specific = new Types\NameValueListType();
                $specific->Name = $itemspecific->name;
                $specific->Value[] = $itemspecific->value;
                $item->ItemSpecifics->NameValueList[] = $specific;
            }

            /**
             * コンディションID：New:1000、New other (see details):1500,
             *                Manufacturer refurbished:2000,
             *                Seller refurbished:2500,
             *                Used:3000,
             *                For parts or not working:7000
             */
            $item->ConditionID = 3000;
            $item->ConditionDescription=\Input::post('condition_description');

            /**
             * ストア
             */
            $item->Storefront = new Types\StorefrontType();
            $item->Storefront->StoreCategoryName = \Input::post('store_category_name');

            /*
             * セラープロファイルに変更のため削除
             */
//            //支払い方法
//            $item->PaymentMethods = array('PayPal');
//            $item->PayPalEmailAddress = 'eb.tom.signum@gmail.com ';
//            //支払い後、発送までの期間(ハンドリングタイム)
//            $item->DispatchTimeMax = 3;
//            /**
//             * 送料設定
//             */
//            $item->ShippingDetails = new Types\ShippingDetailsType();
//            $item->ShippingDetails->ShippingType = Enums\ShippingTypeCodeType::C_FLAT;
//
//
//            $shipping_array = Model_Shipping::find(\Input::post('shipping_id'));
//
//            /**
//             * Create our first domestic shipping option.
//             * Standard Shipping from outside US (5 to 10 business days):StandardShippingFromOutsideUS
//             * Economy Shipping from outside US (11 to 23 business days):EconomyShippingFromOutsideUS
//             */
//            $shippingService = new Types\ShippingServiceOptionsType();
//            $shippingService->ShippingServicePriority = (int)$shipping_array->domestic_priority_1;
//            $shippingService->ShippingService = $shipping_array->domestic_service_1;
//            $shippingService->ShippingServiceCost = new Types\AmountType(array('value' => (double)$shipping_array->domestic_cost_1));
//            $item->ShippingDetails->ShippingServiceOptions[] = $shippingService;
//
//            /**
//             * International shipping option.
//             * Standard Int'l Shipping:StandardInternational
//             * Economy Int'l Shipping:OtherInternational
//             */
//            if($shipping_array->international_service_1 != "NA"){
//                $shippingService = new Types\InternationalShippingServiceOptionsType();
//                $shippingService->ShippingServicePriority = (int)$shipping_array->international_priority_1;
//                $shippingService->ShippingService = $shipping_array->international_service_1;
//                $shippingService->ShippingServiceCost = new Types\AmountType(array('value' => (double)$shipping_array->international_cost_1));
//                $shippingService->ShipToLocation = explode(",", $shipping_array->international_location_1);
//                $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
//            }
//            if($shipping_array->international_service_2 != "NA"){
//                $shippingService = new Types\InternationalShippingServiceOptionsType();
//                $shippingService->ShippingServicePriority = (int)$shipping_array->international_priority_2;
//                $shippingService->ShippingService = $shipping_array->international_service_2;
//                $shippingService->ShippingServiceCost = new Types\AmountType(array('value' => (double)$shipping_array->international_cost_2));
//                $shippingService->ShipToLocation = explode(",", $shipping_array->international_location_2);
//                $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
//            }
//            if($shipping_array->international_service_3 != "NA"){
//                $shippingService = new Types\InternationalShippingServiceOptionsType();
//                $shippingService->ShippingServicePriority = (int)$shipping_array->international_priority_3;
//                $shippingService->ShippingService = $shipping_array->international_service_3;
//                $shippingService->ShippingServiceCost = new Types\AmountType(array('value' => (double)$shipping_array->international_cost_3));
//                $shippingService->ShipToLocation = explode(",", $shipping_array->international_location_3);
//                $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
//            }
//            if($shipping_array->international_service_4 != "NA"){
//                $shippingService = new Types\InternationalShippingServiceOptionsType();
//                $shippingService->ShippingServicePriority = (int)$shipping_array->international_priority_4;
//                $shippingService->ShippingService = $shipping_array->international_service_4;
//                $shippingService->ShippingServiceCost = new Types\AmountType(array('value' => (double)$shipping_array->international_cost_4));
//                $shippingService->ShipToLocation = explode(",", $shipping_array->international_location_4);
//                $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
//            }
//            if($shipping_array->international_service_5 != "NA"){
//                $shippingService = new Types\InternationalShippingServiceOptionsType();
//                $shippingService->ShippingServicePriority = (int)$shipping_array->international_priority_5;
//                $shippingService->ShippingService = $shipping_array->international_service_5;
//                $shippingService->ShippingServiceCost = new Types\AmountType(array('value' => (double)$shipping_array->international_cost_5));
//                $shippingService->ShipToLocation = explode(",", $shipping_array->international_location_5);;
//                $item->ShippingDetails->InternationalShippingServiceOption[] = $shippingService;
//            }
//
//
//            $exclude_locations = explode(",", $shipping_array->exclude_location);
//            foreach($exclude_locations as $exclude_location){
//                $item->ShippingDetails->ExcludeShipToLocation[] = $exclude_location;
//            }
//
//            /**
//             * リターンポリシー
//             */
//            $item->ReturnPolicy = new Types\ReturnPolicyType();
//            $item->ReturnPolicy->ReturnsAcceptedOption = 'ReturnsAccepted';
//            $item->ReturnPolicy->RefundOption = 'MoneyBack';
//            $item->ReturnPolicy->ReturnsWithinOption = 'Days_14';
//            $item->ReturnPolicy->ShippingCostPaidByOption = 'Buyer';


            /**
             * セラープロファイル
             */
            $item->SellerProfiles = new Types\SellerProfilesType();
            $item->SellerProfiles->SellerPaymentProfile = new Types\SellerPaymentProfileType();
            $item->SellerProfiles->SellerPaymentProfile->PaymentProfileID = 48286917024;
            $item->SellerProfiles->SellerPaymentProfile->PaymentProfileName = 'PayPal';

            $item->SellerProfiles->SellerReturnProfile = new Types\SellerReturnProfileType();
            $item->SellerProfiles->SellerReturnProfile->ReturnProfileID = 48286916024;
            $item->SellerProfiles->SellerReturnProfile->ReturnProfileName = 'Returns Accepted,Buyer,14 Days,Money Back';

            $item->SellerProfiles->SellerShippingProfile = new Types\SellerShippingProfileType();
            $shipping_array = Model_Shipping::find(\Input::post('shipping_id'));

            $item->SellerProfiles->SellerShippingProfile->ShippingProfileID = (int)$shipping_array->profile_id;
            $item->SellerProfiles->SellerShippingProfile->ShippingProfileName = $shipping_array->shipping_name;


            /**
             * Finish the request object.
             */
            $request->Item = $item;
            $response = $service->addFixedPriceItem($request);

            /**
             * Output the result of calling the service operation.
             *
             * For more information about working with the service response object, see:
             * http://devbay.net/sdk/guides/getting-started/#response-object
             */
            if (isset($response->Errors)) {
                $errorarray = array();
                foreach ($response->Errors as $error) {
                    $errorarray[] = ($error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning').": ".$error->ShortMessage."\n".$error->LongMessage;
                }
                \Session::set_flash('error',$errorarray);
                //\Response::redirect('ebay/salespart');
            }

            if ($response->Ack !== 'Failure') {

                if ( ! $salespart = Model_Salespart::find($id))
                {
                    \Session::set_flash('error', 'Could not find salespart #'.$id);
                    \Response::redirect('ebay/salespart');
                }
                $salespart->eBay_item_number = $response->ItemID;
                $salespart->start_date = date( "Y-m-d H:i:s");
                //$salespart->end_date = date('Y-m-d H:i:s', strtotime('+1 day'));;
                $salespart and $salespart->save();
                \Session::set_flash('success', 'The item was listed to the eBay with the Item number #'.$response->ItemID);
                Model_Inventory::changestatus(\Input::post('inventory_id'),'出品中',$id,$response->ItemID);
                \Response::redirect('ebay/inventory');
            }else{
                \Response::redirect('ebay/salespart/view/'.$id);
            }


        }else{
            $data['salespart'] = Model_SalesPart::find($id);
            $data['itemspecific'] = Model_Itemspecific::find('all',array(
                'where' => array(
                    array('specific_id', $data['salespart']->specific_id),
                ),
            ));
            $data['shipping'] = Model_Shipping::find($data['salespart']->shipping_id);

            $this->template->title = "SalesPart";
            $this->template->content = \View::forge('salespart/view', $data);
            $this->template->content->set_safe('salespart', $data['salespart']);
        }

    }




}