<?php

namespace app\modules\auth\models;

use yii\base\Model;
use yii\validators\StringValidator;

/**
 * Модель формы авторизации.
 */
class LoginForm extends Model {

    /** @var string Имя пользователя */
    public $username;
    const ATTR_USERNAME = 'username';

    /** @var string Пароль. */
    public $password;
    const ATTR_PASSWORD = 'password';

    /**
     * @inheritDoc
     */
    public function rules() {
        return [
            [static::ATTR_USERNAME => StringValidator::class, 'length' => User::USERNAME_LENGTH],
            [static::ATTR_PASSWORD => StringValidator::class, 'length' => User::PASSWORD_LENGTH],
        ];
    }
}