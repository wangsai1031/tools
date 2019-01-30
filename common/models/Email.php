<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property int $id
 * @property string $subject
 * @property string $content
 * @property string $send_to
 * @property int $status
 * @property int $created_at
 * @property string $created_by
 * @property string $ip
 */
class Email extends \yii\db\ActiveRecord
{
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
            'subject' => 'Subject',
            'content' => 'Content',
            'send_to' => 'Send To',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
