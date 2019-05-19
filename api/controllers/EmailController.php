<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2019/1/12 0012
 * Time: 12:33
 */

namespace api\controllers;


use api\models\Email;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;

class EmailController extends Controller
{
    public function actionSend()
    {
        $form = new Email();

        if (! ($form->load(\Yii::$app->getRequest()->post(), '') && $form->send())) {
            throw new BadRequestHttpException($form->strFirstError());
        }

        return $form;
    }
}
