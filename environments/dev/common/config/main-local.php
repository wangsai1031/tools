<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=tools',
            'username' => '<username>',
            'password' => '<password>',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
//            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' =>false,//这句一定有，false发送邮件，true只是生成邮件在runtime文件夹下，不发邮件
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'constructArgs' => ['smtp.126.com', 25],
                'host' => 'smtp.126.com',
                'username' => '<email>',
                'password' => '<password>',
            ],
            'messageConfig'=>[
                'charset' => 'UTF-8',
                'from' => ['<email>' => '系统通知']
            ],
        ],
    ],
];
