<?php

namespace app\modules\auth\controllers;

use app\controllers\ApiController;
use app\modules\auth\components\PasswordEncoderInterface;
use app\modules\auth\models\RegisterForm;
use app\modules\auth\models\User;
use app\modules\auth\models\UserCreditinals;
use app\modules\auth\models\UserData;
use bizley\jwt\Jwt;
use Yii;
use yii\filters\Cors;
use yii\filters\VerbFilter;
use yii\log\Logger;
use yii\validators\StringValidator;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * Контроллер API авторизации.
 */
class ApiV1Controller extends ApiController {

    /** @var Jwt Компонент работы с JWT. */
    protected $jwt;

    protected $passwordEncoder;

    public function behaviors() {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'check-auth'     => ['POST'],
                    'register'       => ['POST'],
                    'check-username' => ['POST'],
                ],
            ],
        ]);
    }

    public function __construct(
        $id,
        $module,
        PasswordEncoderInterface $passwordEncoder,
        $config = []
    ) {
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

	    throw new BadRequestHttpException();
    }

    public function actionRegister() {
	    $form = new RegisterForm();

	    if ($form->load(Yii::$app->request->post(), '') && $form->validate()) {
            $newUser           = new User();
            $newUser->login    = $form->username;
            $newUser->password = $this->passwordEncoder->encode($form->password);
            if ($newUser->save()) {
                return $newUser->id;
            }

            throw new BadRequestHttpException();
        }

        throw new BadRequestHttpException();
    }

    public function actionCheckUsername() {
	    $username = Yii::$app->request->post('username');

        if ((new StringValidator())->validate($username)) {
            $user = User::findOne([User::ATTR_LOGIN => $username]);

            return (null !== $user);
        }

        throw new BadRequestHttpException();
    }
}
