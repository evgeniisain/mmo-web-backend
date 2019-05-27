<?php

namespace app\modules\auth;

use Yii;

/**
 * Модуль авторизации.
 */
class Auth extends \yii\base\Module {
    /**
     * @inheritDoc
     */
    public function init() {
        parent::init();

        Yii::configure($this, require __DIR__ . '/config/main.php');
    }
}
