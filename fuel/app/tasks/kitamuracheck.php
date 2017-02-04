<?php


namespace Fuel\Tasks;


class Kitamuracheck
{

	public static function run($speech = null)
	{
		if ( ! isset($speech))
		{
			$speech = 'KILL ALL HUMANS!';
		}

		$eye = \Cli::color("*", 'red');

		return \Cli::color("
					\"{$speech}\"
			          _____     /
			         /_____\\", 'blue')."\n"
.\Cli::color("			    ____[\\", 'blue').$eye.\Cli::color('---', 'blue').$eye.\Cli::color('/]____', 'blue')."\n"
.\Cli::color("			   /\\ #\\ \\_____/ /# /\\
			  /  \\# \\_.---._/ #/  \\
			 /   /|\\  |   |  /|\\   \\
			/___/ | | |   | | | \\___\\
			|  |  | | |---| | |  |  |
			|__|  \\_| |_#_| |_/  |__|
			//\\\\  <\\ _//^\\\\_ />  //\\\\
			\\||/  |\\//// \\\\\\\\/|  \\||/
			      |   |   |   |
			      |---|   |---|
			      |---|   |---|
			      |   |   |   |
			      |___|   |___|
			      /   \\   /   \\
			     |_____| |_____|
			     |HHHHH| |HHHHH|", 'blue');
	}

	public static function kitamurafilmcameracheck()
	{
        \Module::load('ebay');

        $outputjson = (\Ebay\Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/kitamuracheck.js'));
        //var_dump($outputjson);

        if($outputjson['return'] == 0){
            $output = json_decode($outputjson['output']);
            //var_dump($output);

            foreach($output as $item){
                $item_id = null;
                $price = null;
                $item_id = str_replace("http://www.net-chuko.com/buy/detail.do?ac=","",$item->link);
                $price = str_replace("(税込)","",$item->price);
                $price = str_replace("￥","",$price);
                $price = str_replace(",","",$price);
                $condition = explode(' ',$item->condition);
                $condition = str_replace("状態:","",$condition);

                if(!\Model_Kitamurainvent::find($item_id)){
                    $kitamurainvent = \Model_Kitamurainvent::forge(array(
                        'id' =>$item_id,
                        'maker' => $item->maker,
                        'product_name' => $item->product_name,
                        'link' => $item->link,
                        'condition' => $condition[0],
                        'price' => $price,
                    ));

                    if ($kitamurainvent and $kitamurainvent->save())
                    {
                        echo 'Item:'.$item_id.' Saved'.PHP_EOL;
                    }

                }

            }

        }
        echo date( "Y年m月d日 H時i分s秒" ).PHP_EOL ;
	}

    public static function kitamurasoldcheck()
    {
        \Module::load('ebay');

        $where_array[] = array('SOLD_CHECK','is',null);

        $condition = array('where'=> $where_array);
        $data = \Model_Kitamurainvent::find('all',$condition);
        foreach($data as $item){

            $outputjson = (\Ebay\Controller_Order::execute('/usr/local/src/casperjs/bin/casperjs /var/www/html/dev_camerascm/public/assets/js/kitamurasoldcheck.js '.$item->link));
            echo ($outputjson['output']);

            if($outputjson['return'] == 0){
                if($outputjson['output'] === '該当する商品データがありません | カメラのキタムラ ネット中古'){

                    if ($Kitamurainvent = \Model_Kitamurainvent::find($item->id)){

                        $Kitamurainvent->sold_check = date('Y-m-d H:i:s');

                        if ($Kitamurainvent and $Kitamurainvent->save())
                        {
                            echo 'Sold';
                        }
                    }

                }else{

                    if ($Kitamurainvent = \Model_Kitamurainvent::find($item->id)){

                        $Kitamurainvent->sold_check = 'Not Sold';

                        if ($Kitamurainvent and $Kitamurainvent->save())
                        {
                            echo 'Not Sold';
                        }
                    }

                }
            }
        }
    }
}

