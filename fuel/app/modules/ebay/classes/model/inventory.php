<?php
namespace Ebay;
use Orm\Model;

class Model_Inventory extends Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'inventory_id',
		'product_id',
		'supply_id',
		'ejt_id',
		'salespart_id',
		'order_id',
		'product_name',
		'status',
		'ejt_check',
		'picture_url',
		'ejt_picture_url',
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
		$val->add_field('inventory_id', 'Inventory Id', 'required|max_length[20]');
		$val->add_field('product_id', 'Product Id', 'max_length[20]');
		$val->add_field('supply_id', 'Supply Id', 'max_length[50]');
		$val->add_field('product_name', 'Product Name', 'required|max_length[1000]');
		$val->add_field('status', 'Status', 'max_length[100]');
		$val->add_field('grade', 'Grade', 'max_length[1000]');
		return $val;
	}

    public static function changestatus($inventory_id,$status,$salespart_id,$eBay_item_number=null){

        $inventory = Model_Inventory::find('first',array(
                'where' => array(
                    array('inventory_id', $inventory_id)
                ),
            )
        );
        if($inventory){
            $inventory->status = $status;
            $inventory->salespart_id = $salespart_id;
            $inventory->eBay_item_number = $eBay_item_number;
            if($status == '出品中'){
                if($inventory->sale_start_date == '0000-00-00' || is_null($inventory->sale_start_date)){
                    $inventory->sale_start_date = date( "Y-m-d H:i:s");
                }
            }
        }

        if($inventory and $inventory->save()){
            return true;
        }
    }

}
