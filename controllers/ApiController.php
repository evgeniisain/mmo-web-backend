<?php

namespace app\controllers;

use app\models\api\ApiResponse;
use Yii;
use yii\base\InvalidRouteException;
use yii\filters\Cors;
use yii\rest\Controller;

/**
 * Базовый класс контроллера API.
 */
abstract class ApiController extends Controller {

	public function init() {
        parent::init();

        Yii::$app->user->enableSession = false;
    }

    public function behaviors() {
	    return array_merge(parent::behaviors(), [
	        'corsFilter' => [
                'class' => Cors::class,
                'cors'  => [
                    // restrict access to domains:
                    'Origin'                        => ['*'],
                    'Access-Control-Request-Method' => [
                        'GET',
                        'POST',
                        'PUT',
                        'PATCH',
                        'DELETE',
                        'HEAD',
                        'OPTIONS',
                    ],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
                ],
            ],
        ]);
    }

    /**
	 * @inheritDoc
	 */
	public function beforeAction($action) {
	    Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

		return parent::beforeAction($action);
	}
}
