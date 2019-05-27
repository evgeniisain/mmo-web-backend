<?php

namespace app\controllers;

use app\models\api\ApiResponse;
use Yii;
use yii\base\InvalidRouteException;
use yii\rest\Controller;

/**
 * Базовый класс контроллера API.
 */
abstract class ApiController extends Controller {

	public function init() {
        parent::init();

        Yii::$app->user->enableSession = false;
    }

    /**
	 * @inheritDoc
	 */
	public function beforeAction($action) {
	    Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

		return parent::beforeAction($action);
	}
}
