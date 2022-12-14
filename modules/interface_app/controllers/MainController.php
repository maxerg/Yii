<?php

namespace app\modules\interface_app\controllers;

use app\models\logger\DebugLogger;
use Yii;
use yii\web\Controller;
use app\modules\interface_app\models\Client;

class MainController extends Controller
{
    public function runAction($id, $params = [])
    {
        $token = Yii::$app->params['modules']['interface_app']['token'] ?? null;
        $requestToken = Yii::$app->request->get('token');

        if(empty($requestToken) && $token !== $requestToken)
        {
            return $this->actionAccessDenied();
        }

        return parent::runAction($id, $params); // TODO: Change the autogenerated stub
    }

    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        echo "<pre>";

        $app = new Client();

        $test = $app->request("placement.bind", [
            "PLACEMENT" => "PAGE_BACKGROUND_WORKER",
            "HANDLER" => "https://studio-10.ru/template-uchet/web/interface-app/main/test2",
            'OPTIONS' => [
                'errorHandlerUrl' => 'http://portal.vlads.bx/vlads/logg.php?ty=1',
            ],
        ]);

        print_r($test);

        return $this->render('index');
    }

    public function actionTest()
    {
        $logger = DebugLogger::instance("test");
        $logger->save(Yii::$app->request->post(), Yii::$app->request, "Данные вызванного приложения");

        return 200;
    }

    public function actionTest2()
    {
        $logger = DebugLogger::instance("test2");
        $logger->save(Yii::$app->request->post(), Yii::$app->request, "Данные вызванного приложения");

        return 200;
    }

    public function actionInstall()
    {
        $auth = collect(Yii::$app->request->post());

        $logger = DebugLogger::instance("install");
        $logger->save($auth, $auth, "Данные приложения");

        if(Yii::$app->request->isPost)
        {
            if($auth->has("auth"))
            {
                $auth = $auth["auth"];
            }

            $app = new Client($auth);
            $app->updateConfig();

            $logger->save($app, $app, "Данные приложения");
        }

        return $this->render("install");
    }

    public function actionAccessDenied()
    {
        return $this->render('access_denied');
    }
}
