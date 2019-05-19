<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2018/2/24 0024
 * Time: 19:10
 */

namespace common\traits;

use yii\db\ActiveQuery;
use yii\db\BaseActiveRecord;

/**
 * Class StaticRelationQueryTrait
 * @package common\traits
 *
 * 建立表模型关系时使用延迟静态绑定
 */
trait StaticRelationQueryTrait
{
    use StaticNamespaceTrait;

    /**
     * @param $class
     * @param $link
     * @param bool $static
     * @return mixed | ActiveQuery
     * @see BaseActiveRecord::hasOne()
     */
    public function hasOne($class, $link, $static = true)
    {
        $class = $this->getRelationClassName($class, $static);
        return $this->createRelationQuery($class, $link, false);
    }

    /**
     * @param $class
     * @param $link
     * @param bool $static
     * @return mixed | ActiveQuery
     * @see BaseActiveRecord::hasMany()
     */
    public function hasMany($class, $link, $static = true)
    {
        $class = $this->getRelationClassName($class, $static);
        return $this->createRelationQuery($class, $link, true);
    }

    /**
     * 获取延迟静态绑定的类名
     * @param $class
     * @param bool $static
     * @return string
     */
    public function getRelationClassName($class, $static = true)
    {
        if (! $static) return $class;

        $reflection = new \ReflectionClass($class);
        $shortName = $reflection->getShortName();
        return static::staticClassName($shortName);
    }
}