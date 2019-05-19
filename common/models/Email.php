<?php

namespace common\models;

use common\traits\EnumTrait;
use common\traits\ModelErrorTrait;
use Yii;
use yii\behaviors\AttributeBehavior;

/**
 * This is the model class for table "email".
 *
 * @property int $id
 * @property string $subject
 * @property string $content
 * @property string $send_to
 * @property string $ip
 * @property int $status
 * @property int $created_at
 * @property int $send_at
 * @property string $created_by
 */
class Email extends \yii\db\ActiveRecord
{
    use EnumTrait;
    use ModelErrorTrait;

    const STATUS_WAITING = 0,
        STATUS_SUCCESS = 1,
        STATUS_FAILED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email';
    }

    public function behaviors()
    {/*{{{*/
        return [
            'created_at' => [
                'class' => \yii\behaviors\TimestampBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                ]
            ],
            'ip' => [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'ip',
                ],
                'value' => function ($event) {
                    return \Yii::$app->getRequest()->getUserIP();
                }
            ]
        ];
    }/*}}}*/
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subject', 'content', 'send_to', 'created_by'], 'required'],
            [['content', 'send_to'], 'string'],
            [['status'], 'integer'],
            [['subject', 'created_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => '标题',
            'content' => '内容',
            'send_to' => '收件人',
            'status' => '状态',
            'created_at' => '创建时间',
            'created_by' => 'Created By',
        ];
    }

    public static function getEnumData()
    {/*{{{*/
        return [
            'status' => [
                self::STATUS_WAITING    => '等待发送',
                self::STATUS_SUCCESS    => '发送成功',
                self::STATUS_FAILED    => '放松失败',
            ],
        ];
    }/*}}}*/

    public function send()
    {
        $emails = explode(',', $this->send_to);
        array_push($emails, \Yii::$app->params['adminEmail']);

        $emails = array_unique($emails);
        $mail = \Yii::$app->mailer->compose()
            ->setTo($emails)
            ->setSubject($this->subject)
            ->setHtmlBody($this->content);

        if ($mail->send() === true) {
            $this->status = static::STATUS_SUCCESS;
            $this->send_at = time();
        } else {
            $this->status = static::STATUS_FAILED;
        }

        return $this->save();
    }
}
