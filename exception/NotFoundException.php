<?php

namespace app\core\exception;
/**
 * Class NotFoundException
 * 
 * @author Yavor Zhekov
 * @package app\core\exception
 */
class NotFoundException extends \Exception
{
   protected $message = 'Page not found';
   protected $code = '404';

}