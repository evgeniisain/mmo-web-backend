<?php

return [
    'definitions' => [
        \app\modules\auth\components\PasswordEncoderInterface::class => \app\modules\auth\components\Sha1PasswordEncoder::class,
    ],
];