<?php

namespace yzh\phhpmvc\Form;

use yzh\phhpmvc\Model;

/**
 * Class InputField
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\form
 */
class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWOED = 'password';
    public const TYPE_NUMBER = 'number';

    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
        
    }


    public function passwordField() {
        $this->type = self::TYPE_PASSWOED;
        return $this;
    }
    
    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" value="%s" class="form-control%s">',
                $this->type,
                $this->attribute,
                $this->model->{$this->attribute},
                $this->model->hasError($this->attribute) ? ' is-invalid' : '',
                
        );
    }

}
