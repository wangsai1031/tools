<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2019/1/12 0012
 * Time: 12:33
 */

namespace api\controllers;


use common\models\Email;
use yii\rest\Controller;

class EmailController extends Controller
{
    public function actionSend()
    {
        $form = new Email();
        $form->load(\Yii::$app->getRequest()->post());

        $emails = explode(',', $form->send_to);
        array_push($emails, \Yii::$app->params['adminEmail']);

        $emails = array_unique($emails);

        $mail = \Yii::$app->mailer->compose()
            ->setFrom(['ws65535x@126.com' => '系统通知'])
            ->setTo($emails)
            ->setSubject($form->subject)
            ->setHtmlBody($form->content)
            ->send();

        $form->save();

        return $mail;
    }
}