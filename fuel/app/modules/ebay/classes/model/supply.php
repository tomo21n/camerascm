<?php
namespace Ebay;
class Model_Supply extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'auction_id',
		'supply_date',
		'supply_channel',
		'supplier_id',
		'auction_title',
		'supply_price',
		'supply_tax',
        'supply_cost',
        'supply_payment_bank',
        'supply_shipping',
        'supply_shipping_payment_bank',
		'product_id',
		'product_name',
		'condition',
		'sale_price',
		'comment',
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
		$val->add_field('supply_channel', 'Supply Channel', 'required|max_length[50]');
		$val->add_field('supply_price', 'Supply Price', 'required');
		$val->add_field('condition', 'Condition', 'max_length[2000]');
		$val->add_field('comment', 'Comment', 'max_length[2000]');

		return $val;
	}

}
