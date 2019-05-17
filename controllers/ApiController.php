<?php

namespace app\controllers;

use app\models\api\ApiResponse;
use Yii;
use yii\rest\Controller;

/**
 * Базовый класс контроллера API.
 */
abstract class ApiController extends Controller {

	/** @var ApiResponse Ответ. */
	protected $response;

	/**
	 * @inheritDoc
	 */
	public function beforeAction($action) {
		Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;

		$this->response = new ApiResponse();

		if (false === parent::beforeAction($action)) {
			$this->setResponse([], ApiResponse::CODE_CATCHED, 'Нет доступа.');

			return false;
		}
	}

	/**
	 * @inheritDoc
	 */
	public function afterAction($action, $result) {
		parent::afterAction($action, $result);

		return $this->response;
	}

	/**
	 * Изменить содержимое ответа.
	 *
	 * @param object|array $body    Содержимое.
	 * @param int          $code    Код ответа.
	 * @param string       $message Сообщение об ошибке.
	 */
	protected function setResponse($body, int $code = 0, string $message = '') {
		$this->response->body    = $body;
		$this->response->code    = $code;
		$this->response->message = $message;
	}
}
