<?php

namespace app\modules\auth\components;

/**
 * Интерфейс проверки пароля.
 */
interface PasswordEncoderInterface {
    /**
     * Закодировать.
     *
     * @param string $password Пароль.
     * @param string $salt     "Соль".
     *
     * @return string
     */
    public function encode(string $password, string $salt = ''): string;
}