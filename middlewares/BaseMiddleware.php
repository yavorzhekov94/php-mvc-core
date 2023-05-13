<?php

namespace yzh\phhpmvc\middlewares;
/**
 * Class BaseMiddleware
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();

}
