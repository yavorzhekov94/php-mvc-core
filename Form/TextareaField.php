<?php

namespace yzh\phhpmvc\Form;


/**
 * Class TextareaField
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\form
 */
class TextareaField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
                
        $this->attribute,
        $this->model->{$this->attribute},
        $this->model->hasError($this->attribute) ? ' is-invalid' : '',
    );
    }
}
