<?php

namespace yzh\phhpmvc\middlewares;

use yzh\phhpmvc\Application;
use yzh\phhpmvc\exception\ForbiddenException;

/**
 * Class AuthMiddleware
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\middlewares
 */
class AuthMiddleware extends BaseMiddleware
{

    /**
     * @var array
     */
    public array $actions = [];

    /**
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        
        if (Application::isGuest()) {

            if(empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }

}
