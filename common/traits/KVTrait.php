<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2018/5/20 0020
 * Time: 14:57
 */

namespace common\traits;

use Yii;
use yii\helpers\ArrayHelper;

trait KVTrait
{
    /**
     * @brief 获取kv数组
     * @param $key
     * @param $value
     * @param $closure =>
     *  function ($query) {
     *      $query->where([
     *          'package_uuid' => array_keys($form->packages),
     *      ]);
     *  }
     *
     * @return  array|mixed kv.array
     */
    /**
     * @param $key
     * @param $value
     * @param $closure
     * @param bool $useCache
     * @param int $duration
     * @param null $dependency
     * @return array|mixed
     */
    public static function kv($key, $value, $closure = false, $useCache = false, $duration = null, $dependency = null)
    {/*{{{*/
        if ($useCache) {
            # 确保是该函数完全同样的使用
            $params = func_get_args();
            $params[] = __CLASS__ . __METHOD__;
            $cacheKey = $params;

            $cache = Yii::$app->cache;
            if (($cacheValue = $cache->get($cacheKey)) !== false) {
                return $cacheValue;
            }
        }

        $query = static::find()->select([$key, $value]);

        if ($closure instanceof \Closure) {
            $closure($query);
        }

        $raw = $query->asArray()->all();

        $val = empty($raw) ? [] : ArrayHelper::map($raw, $key, $value);

        if ($useCache) {
            $cache->set($cacheKey, $val, $duration, $dependency);
        }

        return $val;
    }/*}}}*/
}