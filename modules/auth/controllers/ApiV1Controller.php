<?php

namespace app\modules\auth\controllers;

use app\controllers\ApiController;

/**
 * Контроллер API авторизации.
 */
class ApiV1Controller extends ApiController {

	/**
	 * Проверка авторизации.
	 */
	public function actionCheckAuth() {

	}

	/**
	 * Авторизация.
	 */
	public function actionLogin() {
		\Yii::$app->getUser()->login();
	}

	/**
	 * Отмена авторизации.
	 */
	public function actionLogout() {

	}
}
