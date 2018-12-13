<?php

namespace app\common\controller;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    //调试功能 0=关闭 1 = 错误和消息 2 = 消息
    public $debug = 0;

    //邮箱标题
    public $title = "";

    //邮箱内容
    public $content = "";

    //发件人昵称
    public $sender_name = "";

    //收件人邮箱
    public $receipt_email = "";

    //收件人名称
    public $receipt_name = "";

    //回复邮箱 邮箱 留空则为发件人EMAIL
    public $reply_email = "";

    //回复邮箱 名称 留空则为发件人名称
    public $reply_name = "";

    //附件路径
    public $attachment = "";

    //指定附件名称
    public $attachment_name = "";


    public function email() {

        try{
            $mail = new PHPMailer();           //实例化PHPMailer对象

            $mail->CharSet = 'UTF-8';           //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
            $mail->IsSMTP();                    //设定使用SMTP服务
            $mail->SMTPDebug = $this->debug;
            $mail->SMTPAuth = true;             //启用 SMTP 验证功能
            $mail->SMTPSecure = 'ssl';          //使用安全协议

            //配置SMTP服务器信息
            $mail->Host = "***.com";            //SMTP 服务器
            $mail->Port = 465;                       //SMTP服务器的端口号
            $mail->Username = "15***@163.com"; //SMTP服务器用户名
            $mail->Password = "***";         // SMTP服务器密码

            //设置发件人邮箱信息
            $mail->SetFrom('***@163.com', $this->sender_name);

            //配置收件人邮箱信息
            $mail->AddAddress($this->receipt_email, $this->receipt_name);

            //配置回复邮箱信息
            $mail->AddReplyTo($this->reply_email, $this->reply_name);

            //邮件标题
            $mail->Subject = $this->title;

            //邮件内容
            $mail->MsgHTML($this->content);

            //附件
            if ($this->attachment != "") {
                $mail -> AddAttachment($this->attachment,$this->attachment_name);
            }
            $mail->Send();

            return true;
        } catch (phpmailerException $e) {

            //抛出错误
            echo $e->errorMessage();
        }
    }
}

/*$email = new Email();
        $email->title = "来自未来的邮件";
        $email->sender_name = "杰宝";
        $email->receipt_email = "***@sina.cn";
        $email->receipt_name = "杰宝杰宝two";
        $email->reply_email = "***@qq.com";
        $email->reply_name = "**杰";
        $email->attachment = "static/img/login.jpg";
        $email->attachment_name = "ceshi.jpg";
        $email->content = "<h1>你好**杰</h1><p>我是未来的你</p>";
        $res = $email->email();
        dump($res);*/
