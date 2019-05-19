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

* Request format
```json
{
	"subject":"天王盖地虎",
	"content":"宝塔镇河妖",
	"created_by":"ws65535",
	"send_to":"ws65535@qq.com"
}
```

* Response Params

| 字段    | 类型   |  描述     |备注|
|-------------|--------|----------|----------|
| id |  int |  ID     |    |
| subject | string |  邮件标题     |
| content |  string |  邮件内容| |
| email   | string  | 收件邮箱，多个邮箱以英文逗号（`,`）分隔 |
| created_by| string| 邮件来源，主要用于区分邮件由哪个项目或功能发送
|status|int|状态| 0：待发送，1：已发送，2：发送失败
|send_at| int|发送时间
|created_at|int|请求时间
|ip|int|请求IP

* Response format
```json
{
    "status": 200,
    "success": true,
    "data": {
        "subject": "天王盖地虎",
        "content": "宝塔镇河妖",
        "created_by": "ws65535",
        "send_to": "ws65535@qq.com",
        "status": 1,
        "send_at": 1558342771,
        "created_at": 1558342771,
        "ip": "192.168.33.1",
        "id": 2689
    }
}
```