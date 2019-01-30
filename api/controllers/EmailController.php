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
        $ip = \Yii::$app->getRequest()->getUserIP();
        $form = new Email();
        $form->load(\Yii::$app->getRequest()->post(), '');

        $form->ip = $ip;
        $form->subject = $ip . '：' .$form->subject;
        $form->content = nl2br($form->content);

        $emails = explode(',', $form->send_to);
        array_push($emails, \Yii::$app->params['adminEmail']);

        $emails = array_unique($emails);
        $mail = \Yii::$app->mailer->compose()
            ->setTo($emails)
            ->setSubject($form->subject)
            ->setHtmlBody($form->content)
            ->send();

        $form->save();

        return $mail;
    }
}
