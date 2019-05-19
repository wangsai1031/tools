<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2018/2/22 0022
 * Time: 19:53
 */

namespace common\traits;


trait StaticNamespaceTrait
{
    /**
     * @param string $shortName 不包含命名空间的类名
     * @return string
     *
     * 提供一个类名，该方法会在当前目录下寻找该类是否存在
     * 若不存在，则继续去上一级目录寻找
     *
     */
    public static function staticClassName($shortName)
    {
        $class = new \ReflectionClass(static::class);

        $namespace = $class->getNamespaceName();

        $staticClassName = sprintf('%s\%s', $namespace, $shortName);

        if (! class_exists($staticClassName)) {

            $className = $class->getParentClass()->getName();

            return $className::staticClassName($shortName);
        }

        return $staticClassName;
    }
}