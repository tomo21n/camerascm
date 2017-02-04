<?php
namespace Ebay;
class Model_Promotion extends \Orm\Model
{
	protected static $_properties = array(
        'id',
        'user_id',
        'promotion_id',
        'promotional_sale_name',
        'discount_type',
        'discount_value',
        'promotional_sale_type',
        'promotional_sale_starttime',
        'promotional_sale_endtime',
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
        $val->add_field('promotional_sale_name', 'promotional_sale_name', 'required');
        $val->add_field('discount_value', 'discount_value', 'required');
        $val->add_field('promotional_sale_starttime', 'promotional_sale_starttime', 'required');
        $val->add_field('promotional_sale_endtime', 'promotional_sale_endtime', 'required');
		return $val;
	}

}
