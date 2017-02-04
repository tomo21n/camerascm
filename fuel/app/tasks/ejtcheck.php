<?php


namespace Fuel\Tasks;


class Ejtcheck
{

	public static function run($speech = null)
	{
		if ( ! isset($speech))
		{
			$speech = 'KILL ALL HUMANS!';
		}
		return "";
	}

	public static function ejtpcscheck()
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


                if($ejtinvent = \Model_Ejtinvent::find($item_id)){
                    if($ejtinvent->status === "NewActive"){
                        $ejtinvent->status = 'OldActive';
                    }elseif($ejtinvent->status == 'Sold'){
                        $ejtinvent->status = 'ReActive';
                    }elseif($ejtinvent->status == 'ReActive'){
                        $ejtinvent->status = 'OldActive';
                    }
                    $ejtinvent->save();

                }else{
                    $Ejtinvent = \Model_Ejtinvent::forge(array(
                        'id' =>$item_id,
                        'product_name' => $item->product_name,
                        'link' => $item->link,
                        'price' => $price,
                        'status' => "NewActive",
                    ));

                    if ($Ejtinvent and $Ejtinvent->save())
                    {
                        echo 'Item:'.$item_id.' Saved'.PHP_EOL;
                    }

                }



            }
            $where_array[] = array('status','<>','Sold');
            $condition = array('where'=> $where_array);
            $array_db_active = \Model_Ejtinvent::find('all',$condition);
            foreach($array_db_active as $item){
                if(!in_array($item->id,$array_now_active)){
                    if($sold_item = \Model_Ejtinvent::find($item->id)){
                        $sold_item->status = 'Sold';
                        $sold_item->save();
                    }
                };
            }


        }
        echo date( "Y年m月d日 H時i分s秒" ).PHP_EOL ;
	}

}