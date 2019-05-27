<?php

namespace app\helpers;

use yii\base\Model;

/**
 * Хелпер для работы с Yii моделями.
 */
class ModelHelper {
    /**
     * Получить первую доступную ошибку из модели.
     *
     * @param Model $model Модель.
     *
     * @return string
     */
    public static function firstError(Model $model): string {
        if ($model->hasErrors()) {
            return $model->getErrors()[0][0];
        }

        return '';
    }
}