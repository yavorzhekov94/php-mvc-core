<?php

namespace yzh\phhpmvc\Form;

use yzh\phhpmvc\Model;

/**
 * Class Form
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\form
 */
class Form
{
    public static function begin($action, $method)
    {
       echo sprintf('<form action="%s" method="%s">', $action, $method);
       return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }
}
