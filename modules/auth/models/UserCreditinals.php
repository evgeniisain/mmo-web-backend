<?php

namespace app\modules\auth\models;

use yii\base\Model;
use yii\validators\StringValidator;

/**
 * Данные пользователя для авторизации.
 */
class UserCreditinals extends Model {
    public $login;
    const ATTR_LOGIN = 'login';

    public $password;
    const ATTR_PASSWORD = 'password';

    /**
     * @inheritDoc
     */
    public function rules() {
        return [
            [static::ATTR_LOGIN, StringValidator::class, 'max' => 64],
            [static::ATTR_PASSWORD, StringValidator::class, 'max' => 64],
        ];
    }
}