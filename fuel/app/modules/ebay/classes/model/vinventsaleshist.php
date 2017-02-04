<?php
namespace Ebay;
use Orm\Model;

class Model_Vinventsaleshist extends Model
{
    protected static $_table_name = 'v_inventsaleshist';
    protected static $_primary_key = array('id');


    protected static $_properties = array(
		'id',
		'user_id',
		'inventory_id',
		'product_id',
		'supply_id',
		'ejt_id',
		'salespart_id',
		'product_name',
		'status',
		'ejt_check',
		'picture_url',
		'grade',
		'maker',
		'serialno',
        'including_ja',
        'including_en',
        'appearance_ja_1',
        'appearance_en_1',
        'functional_ja_1',
        'functional_en_1',
        'optical_ja_1',
        'optical_en_1',
        'appearance_ja_2',
        'appearance_en_2',
        'functional_ja_2',
        'functional_en_2',
        'optical_ja_2',
        'optical_en_2',
        'condition_other_ja',
        'condition_other_en',
		'weight',
		'supply_price',
		'reference_sale_price',
		'supply_date',
		'comfirm_date',
		'sale_start_date',
		'sold_date',
		'eBay_item_number',
		'promotion_id',
		'created_at',
		'updated_at',
        'listing_status',
        'sale_price',
        'promotional_price',
        'listing_duration',
        'hit_count',
        'watch_count',
        'start_date',
        'end_date',
        'sal_created_at',
        'sal_updated_at',
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



}
