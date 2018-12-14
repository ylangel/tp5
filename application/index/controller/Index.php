<?php
namespace app\index\controller;

use app\index\controller\Common;

class Index extends Common
{
    public function index()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/index",$this->com_data);
    }

    public function basic_table()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/basic-table",$this->com_data);
    }

    public function basic_elements()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/basic_elements",$this->com_data);
    }

    public function blank_page()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/blank-page",$this->com_data);
    }

    public function buttons()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/buttons",$this->com_data);
    }

    public function chartjs()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/chartjs",$this->com_data);
    }

    public function error_404()
    {
        return $this->fetch("/index/error-404",$this->com_data);
    }

    public function error_500()
    {
        return $this->fetch("/index/error-500",$this->com_data);
    }

    public function mdi()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/mdi",$this->com_data);
    }

    public function register()
    {
        return $this->fetch("/index/register",$this->com_data);
    }

    public function typography()
    {
        $this->view->engine->layout('Layout/header');
        return $this->fetch("/index/typography",$this->com_data);
    }
}
