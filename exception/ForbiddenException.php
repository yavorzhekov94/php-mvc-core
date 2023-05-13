<?php

namespace yzh\phhpmvc\exception;

/**
 * Class ForbiddenException
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\exception
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}
