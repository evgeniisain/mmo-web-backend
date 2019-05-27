<?php

namespace app\modules\auth\components;

/**
 * Кодирование пароля в SHA1
 */
class Sha1PasswordEncoder implements PasswordEncoderInterface {

    /**
     * @inheritDoc
     */
    public function encode(string $password, string $salt = ''): string {
        return hash('sha1', $password . $salt);
    }
}