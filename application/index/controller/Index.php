<?php
namespace app\index\controller;

use app\index\controller\Common;

class Index extends Common
{
    public function index()
    {

        return $this->fetch("/index/index",$this->com_data);
    }
}
