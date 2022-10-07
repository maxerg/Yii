<?php

namespace app\modules\pochta\controllers;
use yii\web\Controller;
use Yii;
use app\models\bitrix\Bitrix;
require '/var/www/u1481331/data/www/studio-10.ru/template-uchet/vendor/autoload.php';
use \app\vendor\LapayGroup\RussianPost\CategoryList;
use \app\vendor\LapayGroup\RussianPost\Config;
use \app\vendor\LapayGroup\RussianPost\Providers\OtpravkaApi;
use \app\vendor\LapayGroup\RussianPost\Entity\Order;
require '/var/www/u1481331/data/www/studio-10.ru/template-uchet/vendor/symfony/yaml/Yaml.php';
use \app\vendor\LapayGroup\RussianPost\Providers\Tracking;
use app\modules\pochta\models\Client as BitrixApp;
use \app\models\logger\DebuLogger;


use \app\vendor\symfony\yaml\Yaml;
/**
 * Default controller for the `pochta` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {

        return $this->render('index');
    }
    public function actionSuc(){
        return $this->render('success');

    }
    public function actionErr(){
        return $this->render('err');

    }
    public function actionStatus(){
        return $this->render('err');

    }
    public function actionCron(){


        $webhook = Bitrix::BX24init();
        $ha = $webhook->request("crm.deal.list", ['filter' => ['!UF_CRM_1662969319636' => ''], 'select'=> ['ID']]);
        $amountDeal = $webhook->getLastResponse()["total"];
        $batch = [];
        for ($i = 0; $i < $amountDeal / 50; $i++) {
            $batch[] = $webhook->buildCommand('crm.deal.list', ['start'=> $i*50, 'filter' => ['!UF_CRM_1662969319636' => ''], 'select'=> ['UF_CRM_1662969319636','STAGE_ID']]);
        }
        $ar = array_chunk($batch, 50);
        foreach ($ar as $key => $value){
            $b = $webhook->batchRequest($value);
        }

        foreach ($b as $key => $value){
            foreach ($value as $key2 => $value2){

                $time_now = time();
                $time_from_deal = json_decode($value2['UF_CRM_1662969319636'], true)['last_modify'];
                $track = json_decode($value2['UF_CRM_1662969319636'], true)['track_id'];
                $stat = json_decode($value2['UF_CRM_1662969319636'], true)['status'];
                $diffrent_time = $time_now - $time_from_deal;
                $day = 60*60*24;

                if ($diffrent_time >= $day && ($stat != 'Received by sender' && $stat != 'Received by the addressee')){
                    //обновляем и спрашиваем у почты

                    $Tracking = new Tracking('single',Yaml::parse(file_get_contents('/var/www/u1481331/data/www/studio-10.ru/template-uchet/vendor/symfony/yaml/path_to_config.yaml')));
                    $result = $Tracking->getOperationsByRpo($track);
                    $vozvrat = 0;
                    $zasilka = 0;
                    $new_status = '';
                    foreach ($result as $key => $value3){

                        echo "<pre>";
                        $array = json_decode(json_encode($value3), true);
                        $status = $array['OperationParameters']['OperType']['Name'];
                        $status2 = $array['OperationParameters']['OperAttr']['Name'];


                        if ($status == 'Прием'){
                            $new_status = 'Reception';
                        }
                        if ($status2 == 'Засылка'){
                            $zasilka = 1;
                        }
                        if ($status == 'Возврат' || $status == 'Неудачная попытка вручения'){
                            $vozvrat = 1;
                        }
                        if ($vozvrat == 1  && $zasilka == 1){
                            $new_status = 'Arrived at the place of delivery to the sender';
                        }
                        if ( $status == 'Вручение'){
                            $new_status = 'Received by sender';
                        }
                        if ($status2 =='Вручение адресату'){
                            $new_status = 'Received by the addressee';
                        }

                    }
                    $id_deal = $value2['ID'];
                    $stage_id = $value2['STAGE_ID'];
                    $stage_id2 = substr($stage_id, 0,2);
                    echo $stage_id2;
                    $logger = \app\models\logger\DebugLogger::instance("actionCron");
                    $logger->save($id_deal, $id_deal, "ID сделки");
                    if ($new_status == 'Reception'){
                        if($stage_id2 == 'C3'){
                            //$webhook->request("crm.deal.update", ["fields" => ['STAGE_ID' => 'C3:UC_LS4YRG'], "ID" =>$id_deal]);
                        }else{
                            $webhook->request("crm.deal.update", ["fields" => ['STAGE_ID' => 'UC_5JN4FS'], "ID" =>$id_deal]);
                        }
                    }
                    if ($new_status == 'Received by the addressee') {
                        if ($stage_id2 == 'C3') {
                            //$webhook->request("crm.deal.update", ["fields" => ['STAGE_ID' => 'C3:UC_GSNIMG'], "ID" => $id_deal]);
                        } else {
                            $webhook->request("crm.deal.update", ["fields" => ['STAGE_ID' => 'UC_5ACDHA'], "ID" => $id_deal]);
                        }
                    }
                    if ($new_status == 'Arrived at the place of delivery to the sender'){
                        if($stage_id2 == 'C3'){
                            //$webhook->request("crm.deal.update", ["fields" => ['STAGE_ID' => 'C3:UC_VJOM7B'], "ID" =>$id_deal]);
                        }else{
                            $webhook->request("crm.deal.update", ["fields" => ['STAGE_ID' => 'UC_6YQE4H'], "ID" =>$id_deal]);
                        }
                    }
                    $new_meska = [
                        'track_id' => $track,
                        'status' => $new_status,
                        'last_modify' => time(),
                    ];
                    $new = [
                        'UF_CRM_1662969319636' => json_encode($new_meska)
                    ];
                    $webhook->request("crm.deal.update", ["fields" => $new, "ID" =>$id_deal]);

                }
            }

        }





    }
    public function actionWebhookPosilka(){
        $data_request = Yii::$app->request->post();
        $logger = \app\models\logger\DebugLogger::instance("actionWebhookPosilka2");
        $logger->save($data_request, $data_request, "ID сделки");
        $id_deal = substr($data_request['document_id'][2], 5);
        //$id_deal = 131327;
        $webhook = Bitrix::BX24init();
        $deal_get = $webhook->request("crm.deal.get", ["ID" => $id_deal]);
        $id_contact = $deal_get['CONTACT_ID'];
        echo "<pre>";
        //print_r($deal_get);
        //die;
        $contact_get = $webhook->request("crm.contact.get", ["ID" => $id_contact]);

        $phone_number = $contact_get['PHONE'][0]['VALUE'];
        $fio = $contact_get['LAST_NAME'] . ' ' . $contact_get['NAME'] . ' ' .  $contact_get['SECOND_NAME'];
        $fio_i = $contact_get['NAME'];
        $fio_f = $contact_get['LAST_NAME'];
        $weight = $deal_get['UF_CRM_1661178146745'];
        $price = $deal_get['UF_CRM_1662542537178'];
        $adres = $deal_get['UF_CRM_1616069013'];
        $otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('/var/www/u1481331/data/www/studio-10.ru/template-uchet/vendor/symfony/yaml/path_to_config.yaml')));
        $ind = $otpravkaApi->searchPostOfficeByAddress($adres);
        $ind = $ind['postoffices'][0];
        $phoneList = new \app\vendor\LapayGroup\RussianPost\PhoneList();
        $phoneList->add($phone_number);
        $addressList = new \app\vendor\LapayGroup\RussianPost\AddressList();
        $addr = $addressList->add($adres);
        $resultgg = $otpravkaApi->clearAddress($addressList); //infa s adresom
        $type = 'POSTAL_PARCEL';
        $orders = [];
        $order = new Order();
        $order->setIndexTo($ind);
        $order->setPostOfficeCode('141020');
        $order->setGivenName($fio_i);
        $order->setHouseTo($resultgg[0]['house']);
        $order->setMass($weight);
        $order->setPlaceTo($resultgg[0]['place']);

        $order->setRecipientName($fio);
        $order->setRegionTo($resultgg[0]['region']);
        $order->setStreetTo($resultgg[0]['street']);
        $order->setRoomTo($resultgg[0]['room']);
        $order->setSurname($fio_f);
        $order->setTelAddress($phone_number);
        $order->setSmsNoticeRecipient(1);
        $order->setMailType($type);
        $order->setMailCategory('WITH_DECLARED_VALUE');
        $order->setInsrValue($price*100);

        $orders[] = $order->asArr();
        print_r($orders );

        $result = $otpravkaApi->createOrders($orders);

        if ($result['result-ids'][0] > 0){
            $track = $result['result-ids'][0];
            $webhook = Bitrix::BX24init();
            $result_track = $otpravkaApi->findOrderById($track)['barcode'];

            $new_meska = [
                'track_id' => $result_track,
                'status' => '',
                'last_modify' => time(),
            ];
            $new = [
                'UF_CRM_1662969319636' => json_encode($new_meska)
            ];
            $a =  $webhook->request("crm.deal.update", ["fields" => $new, "ID" =>$_POST['iddeal']]);
            echo "Успех";
        }else{
            print_r($result);
        }

    }
    public function actionWebhookKurier(){
        $data_request = Yii::$app->request->post();
        $logger = \app\models\logger\DebugLogger::instance("actionWebhookKurier");
        $logger->save($data_request, $data_request, "ID сделки");

        $id_deal = substr($data_request['document_id'][2], 5);
        //$id_deal = 131327;
        $webhook = Bitrix::BX24init();
        $deal_get = $webhook->request("crm.deal.get", ["ID" => $id_deal]);
        $id_contact = $deal_get['CONTACT_ID'];
        echo "<pre>";
        //print_r($deal_get);
        //die;
        $contact_get = $webhook->request("crm.contact.get", ["ID" => $id_contact]);

        $phone_number = $contact_get['PHONE'][0]['VALUE'];
        $fio = $contact_get['LAST_NAME'] . ' ' . $contact_get['NAME'] . ' ' .  $contact_get['SECOND_NAME'];
        $fio_i = $contact_get['NAME'];
        $fio_f = $contact_get['LAST_NAME'];
        $weight = $deal_get['UF_CRM_1661178146745'];
        $price = $deal_get['UF_CRM_1662542537178'];
        $adres = $deal_get['UF_CRM_1616069013'];
        $otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('/var/www/u1481331/data/www/studio-10.ru/template-uchet/vendor/symfony/yaml/path_to_config.yaml')));
        $ind = $otpravkaApi->searchPostOfficeByAddress($adres);
        $ind = $ind['postoffices'][0];
        $phoneList = new \app\vendor\LapayGroup\RussianPost\PhoneList();
        $phoneList->add($phone_number);
        $addressList = new \app\vendor\LapayGroup\RussianPost\AddressList();
        $addr = $addressList->add($adres);
        $resultgg = $otpravkaApi->clearAddress($addressList); //infa s adresom
        $type = 'ONLINE_COURIER';

//$type = 'POSTAL_PARCEL';
        $orders = [];
        $order = new Order();
        $order->setIndexTo($ind);
        $order->setPostOfficeCode('141020');
        $order->setGivenName($fio_i);
        $order->setHouseTo($resultgg[0]['house']);
        $order->setMass($weight);
        $order->setPlaceTo($resultgg[0]['place']);

        $order->setRecipientName($fio);
        $order->setRegionTo($resultgg[0]['region']);
        $order->setStreetTo($resultgg[0]['street']);
        $order->setRoomTo($resultgg[0]['room']);
        $order->setSurname($fio_f);
        $order->setTelAddress($phone_number);
        $order->setSmsNoticeRecipient(1);
        $order->setMailType($type);
        $order->setMailCategory('WITH_DECLARED_VALUE');
        $order->setInsrValue($price*100);

        $orders[] = $order->asArr();
        $logger->save($orders, $data_request, "orders");

        $result = $otpravkaApi->createOrders($orders);

        if ($result['result-ids'][0] > 0){
            $track = $result['result-ids'][0];
            $webhook = Bitrix::BX24init();
            $result_track = $otpravkaApi->findOrderById($track)['barcode'];

            $new_meska = [
                'track_id' => $result_track,
                'status' => '',
                'last_modify' => time(),
            ];
            $new = [
                'UF_CRM_1662969319636' => json_encode($new_meska)
            ];
            $a =  $webhook->request("crm.deal.update", ["fields" => $new, "ID" =>$_POST['iddeal']]);
            echo "Успех";
        }else{
            print_r($result);
            $logger->save($result, $data_request, "else");

        }

    }

    public function actionSendForm()
    {


        if ($_POST['type'] == 'Курьер онлайн'){
            $type = 'ONLINE_COURIER';
        }
        if ($_POST['type'] == 'Посылка'){
            $type = 'POSTAL_PARCEL';
        }
        if ($_POST['type'] == 'Мелкий пакет'){
            $type = 'SMALL_PACKET';
        }
        if ($_POST['type'] == 'Посылка 1 класса'){
            $type = 'PARCEL_CLASS_1';
        }
        if ($_POST['type'] == 'Посылка международная'){
            $type = 'ECOM';
        }
         $otpravkaApi = new OtpravkaApi(Yaml::parse(file_get_contents('/var/www/u1481331/data/www/studio-10.ru/template-uchet/vendor/symfony/yaml/path_to_config.yaml')));
         $ind = $otpravkaApi->searchPostOfficeByAddress($_POST['adres']);
         $ind = $ind['postoffices'][0];
         $phoneList = new \app\vendor\LapayGroup\RussianPost\PhoneList();
         $phoneList->add($_POST['number']);
       // $result_phone = $otpravkaApi->clearPhone($phoneList);
        //$phone = $result_phone['phone-country-code'] . $result_phone['phone-city-code'] . $result_phone['phone-number'];
        $addressList = new \app\vendor\LapayGroup\RussianPost\AddressList();
        $addr = $addressList->add($_POST['adres']);
        $resultgg = $otpravkaApi->clearAddress($addressList); //infa s adresom
//echo print_r($result);
//die();  echo $_POST['iddeal'];
//die;

         $orders = [];
         $order = new Order();
         $order->setIndexTo($ind);
         $order->setPostOfficeCode($_POST['otdel']);
         $order->setGivenName($_POST['fio_i']);
         $order->setHouseTo($resultgg[0]['house']);
         $order->setMass($_POST['ves']);
         $order->setPlaceTo($resultgg[0]['place']);
         $order->setRecipientName($_POST['fio_f'] .' '.$_POST['fio_i'] .' '.$_POST['fio_o']);
         $order->setRegionTo($resultgg[0]['region']);
         $order->setStreetTo($resultgg[0]['street']);
         $order->setRoomTo($resultgg[0]['room']);
        $order->setSurname($_POST['fio_f']);
        $order->setTelAddress($_POST['number']);
        $order->setSmsNoticeRecipient($_POST['sms']);
        $order->setMailType($type);
        $order->setMailCategory('WITH_DECLARED_VALUE');
        $order->setInsrValue($_POST['price']*100);
         $orders[] = $order->asArr();
        $result = $otpravkaApi->createOrders($orders);
        if ($result['result-ids'][0] > 0){
            $track = $result['result-ids'][0];
            $webhook = Bitrix::BX24init();
            $result_track = $otpravkaApi->findOrderById($track)['barcode'];

            $new_meska = [
                'track_id' => $result_track,
                'status' => '',
                'last_modify' => time(),
            ];
            $new = [
                'UF_CRM_1662969319636' => json_encode($new_meska)
            ];
           $a =  $webhook->request("crm.deal.update", ["fields" => $new, "ID" =>$_POST['iddeal']]);
            echo "Успех";
        }else{
            print_r($result);
        }

        die;
    }
    public function actionAdd()
    {


        $data_request = Yii::$app->request->post();
        $id_deal = json_decode($data_request['PLACEMENT_OPTIONS'] , true)['ID'];
       // $id_deal = 101141;
        $webhook = Bitrix::BX24init();
        $deal_get = $webhook->request("crm.deal.get", ["ID" => $id_deal]);
        $id_contact = $deal_get['CONTACT_ID'];
        $contact_get = $webhook->request("crm.contact.get", ["ID" => $id_contact]);

        $phone_number = $contact_get['PHONE'][0]['VALUE'];
        $fio = $contact_get['LAST_NAME'] . ' ' . $contact_get['NAME'] . ' ' .  $contact_get['SECOND_NAME'];
        $weight = $deal_get['UF_CRM_1661178146745'];
        $price = $deal_get['UF_CRM_1662542537178'];
        $adres = $deal_get['UF_CRM_1616069013'];
        return $this->render('form_pochta',
            [
                'phone_number' => $phone_number,
                'fio' => $fio,
                'weight' => $weight,
                'adres' => $adres,
                'price' => $price,
                'iddeal' => $id_deal
            ]
        );
    }
}
