<?php
/**
 * Created by PhpStorm.
 * User: WangSai
 * Date: 2018/7/18 0018
 * Time: 15:51
 */

namespace common\traits;


/**
 * Trait ModelErrorTrait
 * @package common\traits
 *
 */
trait ModelErrorTrait
{
    /**
     * @return mixed
     */
    public function strFirstError()
    {
        $errors = $this->getFirstErrors();

        while (is_array($errors)) {
            $errors = reset($errors);
        }

        return $errors;
    }
}