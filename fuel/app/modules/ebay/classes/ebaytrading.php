<?php
namespace Ebay;
/**
 * Created by PhpStorm.
 * User: tomoki
 * Date: 15/10/03
 * Time: 14:21
 */

use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services;
use \DTS\eBaySDK\Trading\Types;
use \DTS\eBaySDK\Trading\Enums;

class Ebaytrading
{

    private $sandbox;

    /**
     * @param mixed $sandbox
     */
    public function setSandbox($sandbox)
    {
        $this->sandbox = $sandbox;
    }

    private  $config =  array(
        'sandbox' => array(
            'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
            'appId' => 'TomokiNa-9797-4eda-af65-afed6013a8d8',
            'certId' => '9c26a657-0ce1-44de-b6e1-03b15300ff45',
            'userToken' => 'AgAAAA**AQAAAA**aAAAAA**Vdc5VA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJiGqQ2dj6x9nY+seQ**whADAA**AAMAAA**547n2SGblWqVk1YOVjMNoxF6mAvcbUVxpyPuOLe6RwnWA4q5XrTHkc5/1MwnTe4dBx/jZmsqFRBdwuIn6aDnCO8kLxWOzB2YwB0GzMqZE+KveNvs/1vW3dPdpu+JHs2P46QVMDC7IjgYvzaioiBB5gjBTVZwurv0Hso2RE0VIcAko4mz3UfQEBFjbDFvr0mlam5UnLjfiOJQ7QVN7JP8R3Ia7a10JxS0E+u/2lNLZRDeOOlndwlFH89f0rLd+3WM8cNZedGWIayc2TugFcmWBtEYfi1EcLG0hqnzzZoHgLp+OMDWKYh4WSKwmI0Q4IkpxjaP7mHYbI02UU4PehFE9NBOatIm2bx/LNQ3aaUZ+lIcTCz0MF3l/W/Jm7r6txoHc2Q1stDrYCQHSdqG/JhuqKDdw9zwhC/lA/ljZGdB7vWQ8mHZAC8z8RHNIAGKqmUwFBoOGJE4eu4KmTX+C74BesTaAASmFwvdZv1IpocU1XB6qxOiHhnhIRSAP+JIXTioLxOWxKgbfY2FmWEdLBh9MC9cvKQ/T1JSJ4FySAxPkczP/KZV7xpnQkEVyYpwDDfMBojuG1FGMvDY7cbRLU6xfvwJzGBm1g+XSCoiPY9+uvTVPBz9b6qPJt17+ktxi0tPSZnatm+dtbm+LWlLb3B8/bp4YjCltDgE8oiIAIEuNNpWlHOqiOPLKWv7lXAIAGzwaVkQeEtZahpR1FLYlxF0l6rtVdVHupDUY+k/xVwZjBQzq0dg9vJv4X4eqb/tLjuS'
        ),
        'production' => array(
            'devId' => '86846d56-3a3d-4a90-a6b5-e238d9831d9b',
            'appId' => 'TomokiNa-b1e9-4e0b-b610-02e89c6545a9',
            'certId' => '91f50789-7d06-43da-9c99-73096c0fa85b',
           // 'userToken' => 'AgAAAA**AQAAAA**aAAAAA**o6OmVA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**6nezNrf7PISDaLKR0R8YhfpBVgpgWKtr3zL+0bcpR7vu79SUYZ4Tp0XnVE3/g/odXa3ji1FTVk0ECEkH11zfafkrg9A3yKLubXR+nX3po6IeG9B8UOBg+Omn7WdApp09aQtk0b9Dr1bj+QX9BRUOv/EswHqsdMJ1uhPCIttYIxqGWTcHRMRExMjTt1+1nbgP6bvfq3ZOpnE0UdgSBkhc6Lk0/jl5AV82ynpiprIPKkCGSDgSIILmqAdd5AQwK5lAzLB0kETTKjVXg/HkEzS22+01Agn0hDLQrIRmxEhznJa/QgiW0Rd2nUK4pm7xTB93qee5PzCc6cFy/pnyesDRbWSLt6YcM7k795A0UXafbP5G+atzvleE1ud7Gyk9tyKtndV8rByXUVJ77EH/ceUsU131Q1z0dqni1ZMfNy82ns4cmaxHiYyng/J8gj8hrqq4QFlk/cC3URShkttzZORw6uelySITGCy3MCZY/twgBKDK/hCIoRzkKfNBzVBq1r6UrpxwKEOBFgO8C3w34An/IAwqZVuY0Kfw3MVn/3Evh5CUWCE2yxDaAAWnzFQ6DZnayggfvlf1tiDFkzQbaPQtmnSXyomJdBPZnX9a7X5Xf5l8mbH2qfeAZ2ul5DkvTx4GDdKG9soZI9PG2PIFUF1BHAUWMabM+WTcNCbWewwyozJIGRZx1pcjQR0BtNdBt7LmGtbLx5xeRaAcOJ0bdDiGMCZleWHfoTic4KlP/HI8cPjhcmboHzOuNFfh98G/4XIY'
            'userToken' => 'AgAAAA**AQAAAA**aAAAAA**7LNvVw**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6AGloeiDpCDqQWdj6x9nY+seQ**K6QCAA**AAMAAA**qg/Q/BLL0JXIvylCDSldARkXWfsqllPiEpaiKIuAcB968TcZvuJ5HQDxYEbkKbLhWU2TXvAfH5SzGkONaOTK9g2q2YhXossGcozEW5FHDDFHT2wn46t00F2WPU1u5fAlKcLj+Yt0QjpEPExKEkuNda40Huevg3YTDMd3qzx4U2bxt/GYnTlegnxeAaDF6297sJtPr7GknXvS2Qd/dVjoIC0Vj/RgQw5Yv3wWL/Ky6wOXP6lYA6buZqVTaMLf2twImNJQce/4owsgg8Ph/OOE6ixkBc7mOtPfUTBoe8BiVjd9hdCeMOXdWTpe6UPP6cErvqM3MH/pCc75TuoSyB6bOdOeDxpPjSejSPefd4j4wtKsVYusfpTB4NlNMFpfeFcr/qwc1OzCZZaoNH5EdbUzVDM4BR4D3uzhbqMqIarooKz1V3WKh4iJYEovKrlDig/0BTFm0ZDSuDzlvWGPF8bikFgggemCpLd8V7OcfuthQ4SzXkqdt3yMzzRVdyg2vMmVCJzU3BAg8iPBRu47lIMkJyaexONvIa91uyIpEwS4v/AY3G7v5KKtagHmwAO3XvMhS4aDoiTFnqnCBWFFcEiQxSIHgnPyaOvqHV+RX8s2vLYCgcOmkJ9TU5zpb2LGCABo0tN3+xKv4j7DpdcDiQ2hkRG9/RfG7U3hBU1Iyso6cACCJvKCdI0fzKc6vpWsyKmpiTHSGYLsWSSvVsBIbjokfR1fHGsy9WI9WFahwSird79oRL8RXLijS4zFSzTAMhLC'
        ),
        'findingApiVersion' => '1.12.0',
        'tradingApiVersion' => '871',
        'shoppingApiVersion' => '871',
        'halfFindingApiVersion' => '1.2.0'
    );

    private function tradingserviceconfig(){
        if($this->sandbox){
            $conf =  array(
                'apiVersion' => $this->config['tradingApiVersion'],
                'sandbox' => true,
                'siteId' => Constants\SiteIds::US
            );
        }else{
            $conf =  array(
                'apiVersion' => $this->config['tradingApiVersion'],
                'siteId' => Constants\SiteIds::US
            );

        }

        return $conf;
    }
    private function getToken(){
        if($this->sandbox){
            return $this->config['sandbox']['userToken'];

        }else{
            return $this->config['production']['userToken'];
        }
    }

    /**
     *
     * プロモーションの編集
     *
     * @param String $Action
     * @param $PromotionalSaleName
     * @param $PromotionalSaleType
     * @param $DiscountType
     * @param $DiscountValue
     * @param $PromotionalSaleStartTime
     * @param $PromotionalSaleEndTime
     * @param null $PromotionalSaleID
     * @return Types\SetPromotionalSaleResponseType
     */
    public function Editpromotion($Action,
                                    $PromotionalSaleName,
                                    $PromotionalSaleType,
                                    $DiscountType,
                                    $DiscountValue,
                                    $PromotionalSaleStartTime,
                                    $PromotionalSaleEndTime,
                                    $PromotionalSaleID = null){


        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\SetPromotionalSaleRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->PromotionalSaleDetails =new Types\PromotionalSaleType();

        if($Action == 'ADD'){
            $request->Action = Enums\ModifyActionCodeType::C_ADD;
        }elseif($Action == 'DELETE'){
            $request->Action = Enums\ModifyActionCodeType::C_DELETE;
            $request->PromotionalSaleDetails->PromotionalSaleID = $PromotionalSaleID;
        }else{
            $request->Action = Enums\ModifyActionCodeType::C_UPDATE;
            $request->PromotionalSaleDetails->PromotionalSaleID = $PromotionalSaleID;
        }
        if($Action !== 'DELETE'){
            $request->PromotionalSaleDetails->PromotionalSaleName = $PromotionalSaleName;
            $request->PromotionalSaleDetails->PromotionalSaleType = $PromotionalSaleType;
            $request->PromotionalSaleDetails->DiscountType = $DiscountType;
            $request->PromotionalSaleDetails->DiscountValue = (double)$DiscountValue;
            $request->PromotionalSaleDetails->PromotionalSaleStartTime = $PromotionalSaleStartTime;
            $request->PromotionalSaleDetails->PromotionalSaleEndTime = $PromotionalSaleEndTime;
        }

        $response = $service->setPromotionalSale($request);

        return $response;

    }


    /**
     *
     * プロモーションのアイテムの追加、削除
     *
     * @param $Action
     * @param $PromotionalSaleID
     * @param $itemid
     * @return Types\SetPromotionalSaleListingsResponseType
     */
    public function EditPromotionItem($Action,
                                       $PromotionalSaleID,
                                       $itemid){

        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\SetPromotionalSaleListingsRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->PromotionalSaleItemIDArray =new Types\ItemIDArrayType();

        if($Action == 'ADD'){
            $request->Action = Enums\ModifyActionCodeType::C_ADD;
        }elseif($Action == 'DELETE'){
            $request->Action = Enums\ModifyActionCodeType::C_DELETE;
        }
        $request->PromotionalSaleID = $PromotionalSaleID;
        $request->PromotionalSaleItemIDArray->ItemID[] =$itemid;

        $response = $service->setPromotionalSaleListings($request);

        return $response;

    }


    /**
     *
     * 再出品（Relist）
     *
     * @param $itemID アイテムID
     * @param $start_price 価格
     * @param $SKU SKU
     * @return Types\RelistFixedPriceItemResponseType
     */
    public function RelistItem($itemID,
                                $start_price,
                                $listing_duration,
                               $SKU = null)
    {
        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\RelistFixedPriceItemRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->Item = new Types\ItemType();
        $request->Item->ItemID = $itemID;
        $request->Item->ListingDuration = $listing_duration;
        if(!is_null($SKU)){
            $request->Item->SKU = $SKU;
        }
        $request->Item->StartPrice = new Types\AmountType();
        $request->Item->StartPrice->value = (double)$start_price;

        $response = $service->relistFixedPriceItem($request);

        return $response;

    }


    /**
     *
     * セラーリストの取得
     *
     * @param $EndTimeFrom
     * @param $EndTimeTo
     * @param null $SKUarray
     * @return array
     */
    public function GetSellerList($EndTimeFrom,
                                   $EndTimeTo,
                                   $SKUarray= null)
    {
        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\GetSellerListRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->EndTimeFrom = new \DateTime($EndTimeFrom);
        $request->EndTimeTo = new \DateTime($EndTimeTo);
        $request->DetailLevel[] = Enums\DetailLevelCodeType::C_RETURN_ALL;
        $request->IncludeWatchCount = true;
        if(!is_null($SKUarray)){
            $request->SKUArray = new Types\SKUArrayType();
            foreach($SKUarray as $SKU){
                $request->SKUArray->SKU[] = $SKU;
            }
        }


        $pageNum = 1;
        $responsearray = array();
        do {
            $request->Pagination = new Types\PaginationType();
            $request->Pagination->PageNumber = $pageNum;

            $response = $service->getSellerList($request);
            $responsearray[] = $response;

            $pageNum += 1;
        } while(isset($response) && $pageNum <= $response->PaginationResult->TotalNumberOfPages);

        return $responsearray;

    }

    /**
     *
     * 追跡IDの追加と評価の追加
     *
     * @param $OrderID
     * @param $ShipmentTrackingNumber
     * @return Types\CompleteSaleResponseType
     */
    public function CompleteSale($OrderID,
                                  $ShipmentTrackingNumber){
        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\CompleteSaleRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->OrderID = $OrderID;

        //Shippment
        $shippmenttype = new Types\ShipmentType();
        $ShipmentTrackingDetails = new Types\ShipmentTrackingDetailsType();
        $ShipmentTrackingDetails->ShipmentTrackingNumber = $ShipmentTrackingNumber;
        $ShipmentTrackingDetails->ShippingCarrierUsed = 'Japan Post';
        $shippmenttype->ShipmentTrackingDetails[] = $ShipmentTrackingDetails;

        $request->Shipment = $shippmenttype;
        $request->Shipped = true;


        //Feedback
        $feedbackinfotype = new Types\FeedbackInfoType();
        $feedbackinfotype->CommentText = 'Thank you for an easy, pleasant transaction. Excellent buyer. A++++++.';
        $feedbackinfotype->CommentType = Enums\CommentTypeCodeType::C_POSITIVE;
        $request->FeedbackInfo = $feedbackinfotype;

        $response = $service->completeSale($request);

        return $response;

    }


    public function GetMyeBaySelling(){

        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\GetMyeBaySellingRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->ActiveList = new Types\ItemListCustomizationType();
        $request->ActiveList->Include = true;
        $request->UnsoldList = new Types\ItemListCustomizationType();
        $request->UnsoldList->Include = true;

        $response = $service->getMyeBaySelling($request);

        return $response;
    }


    /**
     *
     * ItemIDから情報を取得
     *
     * @param $itemid
     * @return Types\GetItemResponseType
     */
    public function GetItem($itemid){

        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\GetItemRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        $request->ItemID = $itemid;
        $request->IncludeWatchCount = true;

        $response = $service->getItem($request);

        return $response;
    }

    public function GetOrder($TimeFrom){

        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\GetOrdersRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();

        /**
         * Request
         */
        $request->ModTimeTo =new \DateTime();
        $today = new \DateTime();
        $request->ModTimeFrom = $today->sub(\DateInterval::createFromDateString($TimeFrom));
        $request->OrderRole = 'Seller';
        //$request->OrderStatus ='Completed';

        $response = $service->getOrders($request);

        return $response;
    }

    public function AddMemberMessageAAQToPartner(){
        $service = new Services\TradingService($this->tradingserviceconfig());
        $request = new Types\AddMemberMessageAAQToPartnerRequestType();
        $request->RequesterCredentials = new Types\CustomSecurityHeaderType();
        $request->RequesterCredentials->eBayAuthToken = $this->getToken();



    }

    public static function SetError($response){
        if (isset($response->Errors)) {
            foreach ($response->Errors as $error) {
                $erromsg = sprintf("%s: %s :: %s\n\n",
                    $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
                    $error->ShortMessage,
                    $error->LongMessage
                );
                \Session::set_flash('error', e($erromsg));
            }
        }
    }

}