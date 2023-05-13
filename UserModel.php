<?php

namespace yzh\phhpmvc;

use yzh\phhpmvc\db\DbModel;

/**
 * Class UserModel
 * 
 * @author Yavor Zhekov
 * @package yzh\phhpmvc
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}
