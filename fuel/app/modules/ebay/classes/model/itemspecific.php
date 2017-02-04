<?php
namespace Ebay;
class Model_Itemspecific extends \Orm\Model
{
	protected static $_properties = array(
        'id',
        'user_id',
        'specific_id',
        'product_id',
        'product_name',
        'name',
        'value',
		'created_at',
		'updated_at',
	);

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
        $val->add_field('specific_id', 'Specific Id', 'required');


		return $val;
	}

    public static function allupdate($array_product,$array_specific_pair){

        foreach($array_specific_pair as $specific_pair_key => $specific_pair_value){

            if(!empty($specific_pair_key)){

                $itemspecific = null;
                $itemspecific = Model_Itemspecific::find('first',array(
                        'where' => array(
                            array('specific_id', $array_product['specific_id']),
                            array('name',$specific_pair_key)
                        ),
                    )
                );
                if($itemspecific){
                    $itemspecific->value = $specific_pair_value;

                }else{
                        $user_info = \Auth::get_user_id();

                        $itemspecific = Model_Itemspecific::forge(array(
                            'user_id' => $user_info[1],
                            'specific_id' => $array_product['specific_id'],
                            'product_id' => $array_product['product_id'],
                            'product_name' => $array_product['product_name'],
                            'name' => $specific_pair_key,
                            'value' => $specific_pair_value,
                        ));
                }
                if (!$itemspecific or !$itemspecific->save()){
                    return false;
                }
            }
        }

        return true;

    }

}
