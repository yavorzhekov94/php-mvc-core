<?php

namespace yzh\phhpmvc;

/**
 * Class Response
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc
 */
class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: '.$url);
    }
}
