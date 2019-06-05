<?php

namespace app\modules\auth\models;

use yii\base\Model;
use yii\validators\EmailValidator;
use yii\validators\StringValidator;

class RegisterForm extends Model {

    const MIN_LENGTH = 6;
    const MAX_LENGTH = 24;

    public $username;
    const ATTR_USERNAME = 'username';

    public $password;
    const ATTR_PASSWORD = 'password';

    public $confirmPassword;
    const ATTR_CONFIRM_PASSWORD = 'confirmPassword';

    public $email;
    const ATTR_EMAIL = 'email';

    /**
     * @inheritDoc
     */
    public function rules() {
        return [
            [static::ATTR_USERNAME, StringValidator::class, 'min' => static::MIN_LENGTH, 'max' => static::MAX_LENGTH],
            [static::ATTR_PASSWORD, StringValidator::class, 'min' => static::MIN_LENGTH, 'max' => static::MAX_LENGTH],
            [static::ATTR_CONFIRM_PASSWORD, StringValidator::class, 'min' => static::MIN_LENGTH, 'max' => static::MAX_LENGTH],
            [static::ATTR_EMAIL, EmailValidator::class],
        ];
    }

    /**
     * @inheritDoc
     */
    public function beforeValidate() {
        if ($this->password !== $this->confirmPassword) {
            return false;
        }

        return parent::beforeValidate();
    }
}