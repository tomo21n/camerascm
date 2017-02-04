<?php
/**
 * Utility Class
 */

class MyUtil {
    /*
     *  通貨レート取得ユーティリティ
     *
     * @params $countory  string 国（JP or US）
     * @return string レート
     */
    public static function get_rate($country)
    {
        $currency = null;

        switch($country){
            case 'JP':
                return 1;
                break;
            case 'US':
                $currency = 'USD';
                break;
            default:
                return 1;
                break;
        }
        $data = file_get_contents('http://api.aoikujira.com/kawase/json/'.$currency);
        $json = json_decode($data, true);
        $yen = $json['JPY'];

        return round($yen * 0.01,3);
    }

    public static function get_nickname($user_id){
        $result = DB::select('value')->from('users_metadata')->where('parent_id',$user_id)->and_where('key','nickname')->execute()->current();

        if($result['value']){
            return $result['value'];
        }
    }

    public static function lb_channel(){
        return array('JPAmazon'=>'JP Amazon'
                    ,'USAmazon'=> 'US Amazon'
                    ,'ebay'=>'ebay'
                    ,'YahooAuction'=>'Yahoo Auction');
    }

    public static function lb_condition(){
        return array('New'=>'新品'
        ,'Used'=> '中古');
    }

    public static function lb_status(){
        return array('Created'=>'作成'
        ,'Complete'=> '完了'
        ,'Stop' => '中断');
    }

    public static function get_myuserid(){
        $user_info = Auth::get_user_id();

        return $user_info[1];
    }

    public static function cron_lock($cron_name){
        if($cron_name){
            $query = DB::insert('cron_lock');
            $query->set(array(
                'cron' => $cron_name,
                'created_at' => date("Y-m-d H:i:s") ,
                'updated_at' => date("Y-m-d H:i:s") ,
            ));

            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
    public static function cron_unlock($cron_name){
        if($cron_name){
            $query = DB::delete('cron_lock')->where('cron','=',$cron_name);
            if($query->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
    public static function cron_check($cron_name){
        $query = DB::select('cron')->from('cron_lock')->where('cron','=',$cron_name)->execute();
        if(count($query)>0){
            return false;
        }else{
            return true;
        }
    }

    public static function getArrayToJSArray($element) {
        $js = "";
        if (is_array($element)) {
            $js .= "[";
            $count = 0;
            foreach($element as $key => $value) {
                $js .= MyUtil::getArrayToJSArray($value);
                $count++;
                if ($count != count($element)) {
                    $js .= ",";
                }
            }
            $js .= "]";
        } else {
            if (is_numeric($element)) {
                $js .= $element;
            } else if (is_string($element)) {
                $js .= "'" . $element . "'";
            }
        }
        return $js;
    }

}