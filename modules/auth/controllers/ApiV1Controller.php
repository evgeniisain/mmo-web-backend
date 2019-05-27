<?php

namespace app\modules\auth\controllers;

use app\controllers\ApiController;
use app\helpers\ModelHelper;
use app\models\api\ApiResponse;
use app\modules\auth\components\PasswordEncoderInterface;
use app\modules\auth\models\LoginForm;
use app\modules\auth\models\User;
use app\modules\auth\models\UserCreditinals;
use app\modules\auth\models\UserData;
use bizley\jwt\Jwt;
use http\Exception\UnexpectedValueException;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * Контроллер API авторизации.
 */
class ApiV1Controller extends ApiController {

    /** @var Jwt Компонент работы с JWT. */
    protected $jwt;

    protected $passwordEncoder;

    public function __construct(
        $id,
        $module,
        Jwt $jwt,
        PasswordEncoderInterface $passwordEncoder,
        $config = []
    ) {
        $this->jwt             = $jwt;
        $this->passwordEncoder = $passwordEncoder;

        parent::__construct($id, $module, $config);
    }

    /**
     * Проверка данных авторизации пользователя.
     */
	public function actionCheckAuth() {
	    $creditinals = new UserCreditinals();

	    $data = json_decode(Yii::$app->request->getRawBody(), true);

	    if ($creditinals->load($data, '') && $creditinals->validate()) {
	        /** @var User $user */
	        $user = User::find()
                ->where([
                    User::ATTR_PASSWORD => $this->passwordEncoder->encode($creditinals->password),
                    User::ATTR_LOGIN    => $creditinals->login,
                ])
                ->one()
            ;

	        if (null === $user) {
	            throw new NotFoundHttpException();
            }

            $userData        = new UserData();
            $userData->id    = $user->id;
            $userData->login = $user->login;

	        return $userData;
        }

	    throw new UnexpectedValueException();
    }
}
