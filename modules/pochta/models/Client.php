<?php

namespace app\modules\pochta\models;

use app\models\bitrix\app\Client as RestClient;

class Client extends RestClient
{
    protected static $config_path = '/pochta/config/config.php';
}