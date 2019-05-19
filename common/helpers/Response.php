<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2019/5/20 0020
 * Time: 16:40
 */

namespace common\helpers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;

class Response
{
    /**
     * 格式化返回数据
     * @param $event
     * @return bool
     */
    public static function format($event)
    {/*{{{*/

        $response = $event->sender;

        /* html, xml ... */

        if ($response->format != \yii\web\Response::FORMAT_JSON) {
            return true;
        }

        /* json */

        $responseData = [
            'status'  => $response->statusCode,
            'success' => $response->isSuccessful,
        ];

        if ($response->isSuccessful) {
            $responseData['data'] = $response->data;
            $statusCode = 200;
        } elseif ($response->isClientError) {
            $responseData['code']    = $response->data['code'];
            $responseData['name'] = $response->data['name'];
            try {
                $responseData['errors'] = Json::decode($response->data['message']);
            } catch (InvalidArgumentException $e) {
                $responseData['errors'] = $response->data['message'];
            }
            $statusCode = 200;
        } elseif ($response->isServerError) {
            /* server-error must log */
            $statusCode = $response->statusCode;
            $responseData['name'] = 'server error.';
            $responseData['debug'] = $response->data;
        } else {
            $statusCode = $response->statusCode;
        }

        $response->data       = $responseData;
        $response->statusCode = $statusCode;

    }/*}}}*/

    /**
     * 规范化ajax返回数据，方便js进行处理
     *
     * code建议：
     * 0： 失败
     * 1： 成功
     *
     * @param $code
     * @param $msg
     * @return array
     */
    public static function ajaxFormat($code, $msg)
    {
        return [
            'code' => $code,
            'message' => $msg,
        ];
    }
}