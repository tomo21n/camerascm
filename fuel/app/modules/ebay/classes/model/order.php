<?php
namespace Ebay;
use Orm\Model;

class Model_Order extends Model
{
    protected static $_properties = array(
        'user_id',
        'order_id',
        'transaction_id',
        'inventory_id',
        'sale_title',
        'status',
        'order_status',
        'order_checkout_status',
        'supply_price',
        'sale_price',
        'sale_shipping',
        'ebay_transaction_fee',
        'paypal_transaction_fee',
        'shipping_type',
        'shipping_cost',
        'shipping_expense',
        'other_fee',
        'return_price',
        'exchange_rate',
        'profit',
        'sale_date',
        'payment_date',
        'shipping_date',
        'delivered_date',
        'feedback_date',
        'tracking_number',
        'tracking_status',
        'emslabel',
        'buyer_id',
        'buyer_feedback_count',
        'buyer_email',
        'buyer_name',
        'buyer_address1',
        'buyer_address2',
        'buyer_address3',
        'buyer_pref',
        'buyer_postal',
        'buyer_country',
        'buyer_country_code',
        'buyer_tel',
        'item_pkg_category',
        'comment',
        'created_at',
        'updated_at'
	);

    protected static $_primary_key = array('order_id');

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
