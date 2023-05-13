<?php

namespace yzh\phhpmvc;

use yzh\phhpmvc\exception\NotFoundException;

/**
 * Class Router
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc
 */
class Router
{
    /**
     * @var Request
     */
    public Request $request;
    
    /**
     * @var Response
     */
    public Response $response;

    /**
     * @var array
     */
    protected array $routes = [];

    
    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param mixed $path
     * @param mixed $callback
     * 
     * @return [type]
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * @return [type]
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
    
        if ($callback === false) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return Application::$app->view->RenderView($callback);
        }

        if (is_array($callback)) {
            /** @var \yzh\phhpmvc\Controller $controller */
            $controller = new $callback[0];
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;
            
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
            
        }

        return call_user_func($callback, $this->request, $this->response);
    }
}
