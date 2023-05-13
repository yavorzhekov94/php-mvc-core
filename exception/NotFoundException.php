<?php

namespace yzh\phhpmvc\exception;
/**
 * Class NotFoundException
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc\exception
 */
class NotFoundException extends \Exception
{
   protected $message = 'Page not found';
   protected $code = '404';

}
