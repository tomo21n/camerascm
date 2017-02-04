<?php
namespace Yahoo;
class Model_Auctionbit extends \Orm\Model
{
    protected static $_table_name = 'auctionbit';

    protected static $_properties = array(
		'id',
		'user_id',
		'auction_id',
		'auction_url',
		'auction_title',
		'current_price',
		'buyout_price',
		'start_date',
		'end_date',
		'bitreservation',
		'budget_price',
		'sale_price',
		'product_id',
		'product_name',
		'condition',
		'comment',
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
        $val->add_field('user_id', 'User Id', 'max_length[20]');
        $val->add_field('auction_id', 'Auction Id', 'required|max_length[20]');

        return $val;
    }
}
