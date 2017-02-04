<?php
namespace Ebay;
use Orm\Model;

class Model_Ejtinvent extends Model
{
	protected static $_properties = array(
        'id',
        'product_name',
        'link',
        'price',
        'status',
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
		return $val;
	}

}
