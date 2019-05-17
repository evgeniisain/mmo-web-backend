<?php

namespace app\controllers;

use app\models\api\ApiResponse;
use yii\rest\Controller;

/**
 * Базовый класс контроллера API.
 */
abstract class ApiController extends Controller {

	protected $response;

	/**
	 * @inheritDoc
	 */
	public function beforeAction($action) {
		$this->response = new ApiResponse();

		if (false === parent::beforeAction($action)) {
			$this->response->code = ApiResponse::CODE_CATCHED;
			$this->response->message = 'Нет доступа.';

			return false;
		}
	}

	/**
	 * Изменить содержимое ответа.
	 *
	 * @param object|array $body    Содержимое.
	 * @param int          $code    Код ответа.
	 * @param string       $message Сообщение об ошибке.
	 */
	protected function setResponse($body, int $code = 0, string $message = '') {

	}
}
