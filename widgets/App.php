<?php

namespace app\widgets;

use Yii;

class App
{

    static function AppIsRoot()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->roles == 'ROOT') {
                return true;
            }
        }
    }
}
