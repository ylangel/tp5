<?php
namespace app\index\controller;

use app\index\controller\Common;
use app\common\controller\Email;

class Index extends Common
{
    public function index()
    {
        $email = new Email();
        $email->title = "来自未来的邮件";
        $email->sender_name = "杰宝";
        $email->receipt_email = "15935001979@sina.cn";
        $email->receipt_name = "杰宝杰宝two";
        $email->reply_email = "847819559@qq.com";
        $email->reply_name = "赵杰";
        $email->attachment = "static/img/login.jpg";
        $email->attachment_name = "ceshi.jpg";
        $email->content = "<h1>你好赵杰</h1><p>我是未来的你</p>";
        $res = $email->email();
        dump($res);
    }
}
