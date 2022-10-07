<?php

namespace app\modules\no_interface_app\controllers;

use yii\web\Controller;

/**
 * Default controller for the `no-interface-app` module
 */
class MainController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
