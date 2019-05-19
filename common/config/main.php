<?php
return [
    'language' => 'zh-CN',
    'timeZone' => 'Asia/Shanghai',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'charset' => 'utf8',
            'enableQueryCache' => true,
            'enableSchemaCache' => true,
            'dsn' => 'mysql:host=<host>;dbname=<dbname>',
            'username' => '<username>',
            'password' => '<password>',
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
                // smtp.126.com
                'host' => '<host>',
                // ['smtp.126.com', 25]
                'constructArgs' => '<constructArgs>',
                'username' => '<username>',
                'password' => '<password>',
            ],
            'messageConfig'=>[
                'charset' => 'UTF-8',
                // ['<email>' => '系统通知']
                'from' => '<from>'
            ],
        ],
    ],
];
