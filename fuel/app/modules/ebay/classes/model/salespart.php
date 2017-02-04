<?php
namespace Ebay;
class Model_Salespart extends \Orm\Model
{
	protected static $_properties = array(
        'id',
        'user_id',
        'inventory_id',
        'product_id',
        'product_name',
        'eBay_item_number',
        'selling_type',
        'listing_duration',
        'start_price',
        'best_offer',
        'best_offer_auto_accept',
        'best_offer_minimum',
        'title',
        'description',
        'serialno',
        'sku',
        'category_id',
        'condition_description',
        'store_category_name',
        'specific_id',
        'shipping_id',
        'start_date',
        'end_date',
        'picture_url',
        'including',
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
        $val->add_field('title', 'title', 'required');


		return $val;
	}

}
