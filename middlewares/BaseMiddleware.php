<?php

namespace app\core\middlewares;
/**
 * Class BaseMiddleware
 * 
 * @author Yavor Zhekov
 * @package app\core\middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();

}
