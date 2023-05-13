<?php

namespace yzh\phhpmvc;

use yzh\phhpmvc\middlewares\BaseMiddleware;

/**
 * Class Controller
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc
 */
class Controller
{
    
    /**
     * @var \yzh\phhpmvc\middlewares\BaseMiddleware
     */
    protected array $middlewares = [];

    public string $layout = 'main';

    public string $action = '';

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = []) 
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;

    }

    public function getMiddlewares(): array
    {
        
        return $this->middlewares;
    }
}
