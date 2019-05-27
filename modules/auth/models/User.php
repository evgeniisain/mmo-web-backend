<?php

namespace app\modules\auth\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property int    $id       Идентификатор.
 * @property string $login    Никнейм.
 * @property string $password Пароль.
 */
class User extends ActiveRecord implements IdentityInterface {

    const ATTR_ID       = 'id';
    const ATTR_LOGIN    = 'login';
    const ATTR_PASSWORD = 'password';

    /** Максимальная длмнна пароля. */
    const PASSWORD_LENGTH = 32;

    /** Максимальная длинна имени пользователя. */
    const USERNAME_LENGTH = 32;

    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritDoc
     */
    public static function findIdentity($id) {
        return static::findOne([static::ATTR_ID => $id]);
    }

    /**
     * Поиск пользователя по имени пользователя.
     *
     * @param string $username Имя пользователя.
     *
     * @return static
     */
    public static function findByUsername(string $username): self {
        return static::findOne([static::ATTR_LOGIN => $username]);
    }

    /**
     * @inheritDoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        // todo поиск юзера по токену. Юзаем кэш.
    }

    /**
     * @inheritDoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey() {

    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey) {

    }
}