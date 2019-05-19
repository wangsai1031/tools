<?php

namespace common\traits;
use yii\db\ActiveRecord;

/**
 * Instance trait file.
 *
 * only for ActiveRecord
 *
 * @Author haoliang
 * @Date 30.11.2015 15:50
 */

/**
 * Class InstanceTrait
 * @package common\traits
 */
trait InstanceTrait
{
    /**
     * find a instance with conditions from db,
     * if not found, get a new instance
     *
     * @param $where condition to find a model
     * @param $preLoadAsNew load $where to instance as a new model
     *
     * @return ActiveRecord
     */
    public static function getInstance(array $where, $preLoadAsNew = false)
    {/*{{{*/

        $instance = static::findOne($where) ?: new static;

        if ($instance->isNewRecord && $preLoadAsNew)
            $instance->setAttributes($where, false);

        return $instance;
    }/*}}}*/

    public function setAttributesAndSave(array $attributes, $isValidate = true)
    {
        $this->setAttributes($attributes, false);
        return $this->save($isValidate);
    }
}
