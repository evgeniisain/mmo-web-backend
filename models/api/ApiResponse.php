<?php

namespace app\models\api;

/**
 * Структура стандартного ответа от сервера.
 */
class ApiResponse {
	/** Коды ответов. */
	const CODE_SUCCESSFUL = 0; // Успешный
	const CODE_CATCHED    = 1; // Обработанная ошибка
	const CODE_UNCATCHED  = 2; // Необработанная ошибка
	/** ------------- */

	/** @var int Код. */
	public $code = 0;

	/** @var string Сообщение об ошибке. */
	public $message = '';

	/** @var object Содержимое. */
	public $body = [];
}
