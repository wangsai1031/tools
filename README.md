# 基于Yii2开发的工具API

### 邮件功能

#### POST /email/send

通过API访问发送邮件

* Request Params

| 字段        | 必须 | 类型   | 最大长度 | 描述     |
|-------------|------|--------|----------|----------|
| subject | √ |  string | 255      | 邮件标题     |
| content |  √ | string | 65535 | 邮件内容|
| email       | √    | string | 65535      | 收件邮箱，多个邮箱以英文逗号（`,`）分隔     |
| created_by | × | string|255| 邮件来源，主要用于区分邮件由哪个项目或功能发送