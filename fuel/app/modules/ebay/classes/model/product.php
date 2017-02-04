<?php
namespace Ebay;
use Orm\Model;

class Model_Product extends Model
{
    protected static $_properties = array(
        'product_id',         //商品ID
        'user_id',            //ユーザID
        'product_name',       //商品名
        'category',           //カテゴリ
        'maker',              //メーカー
        'model',              //モデル
        'option_1',           //オプション１
        'option_2',           //オプション２
        'option_3',           //オプション３
        'option_4',           //オプション４
        'option_5',           //オプション５
        'tag_en',             //タグ　英語
        'tag_jp',             //タグ　日本語
        'in_upper_price',     //入口上限価格
        'in_mean_price',      //入口平均価格
        'in_lower_price',     //入口下限価格
        'in_channel',         //入口チャネル
        'out_upper_price',    //出口上限価格
        'out_mean_price',     //出口平均価格
        'out_lower_price',    //出口下限価格
        'out_search_count',   //出口売れ足数
        'out_channel',        //出口チャネル
        'comment',            //備考
        'created_at',         //作成日時
        'updated_at',         //更新日時
	);

    protected static $_primary_key = array('product_id');

    protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => true,
		),
	);

	public static function validate($factory)
	{
		$val = \Validation::forge($factory);
		$val->add_field('product_name', 'Product Name', 'required|max_length[1000]');

		return $val;
	}

}
