<?php
namespace Ebay;
class Model_Shipping extends \Orm\Model
{
	protected static $_properties = array(
        'id',
        'user_id',
        'profile_id',
        'shipping_name',
        'domestic_priority_1',
        'domestic_service_1',
        'domestic_cost_1',
        'international_priority_1',
        'international_service_1',
        'international_cost_1',
        'international_location_1',
        'international_priority_2',
        'international_service_2',
        'international_cost_2',
        'international_location_2',
        'international_priority_3',
        'international_service_3',
        'international_cost_3',
        'international_location_3',
        'international_priority_4',
        'international_service_4',
        'international_cost_4',
        'international_location_4',
        'international_priority_5',
        'international_service_5',
        'international_cost_5',
        'international_location_5',
        'exclude_location',
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
        $val->add_field('shipping_name', 'Shipping Name', 'required');


		return $val;
	}

}
