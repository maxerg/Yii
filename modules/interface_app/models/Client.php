<?php

namespace app\modules\interface_app\models;

use app\models\bitrix\app\Client as RestClient;

class Client extends RestClient
{
    protected static $config_path = '/interface_app/config/config.php';
}