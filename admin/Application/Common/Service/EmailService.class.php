<?php
namespace Common\Service;
use Think\Model;

/**
 * Class EmailService
 * @package Common\Service
 * 发送邮件
 */
class EmailService extends Model{

    /**
     * 发送邮件
     * @param $to  接受者邮箱
     * @param $name 接受者名称
     * @param string $subject  邮件标题
     * @param string $body  邮件内容 支持html
     * @param null $attachment 附件
     * @return bool|string
     */
    public function sendEmail($to,$name,$subject = '',$body = '',$attachment = null){
       //$config = C('THINK_EMAIL');
        $config = D('Config')->findConfig();
        vendor('PHPMailer.class#phpmailer');      //从PHPMailer目录导class.phpmailer.php类文件
        $mail             = new \Vendor\PHPMailer\PHPMailer(true); //PHPMailer对象
        $mail->CharSet    = 'UTF-8';              //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();                          // 设定使用SMTP服务
        $mail->SMTPAuth   = true;                // 启用 SMTP 验证功能
        $mail->SMTPDebug  = 0;                    // 关闭SMTP调试功能
        //$mail->SMTPSecure = 'ssl';              // 使用安全协议
        $mail->Host       = $config['SMTP_HOST']; // SMTP 服务器
        $mail->Port       = $config['SMTP_PORT']; // SMTP服务器的端口号
        $mail->Username   = $config['SMTP_USER']; // SMTP服务器用户名
        $mail->Password   = $config['SMTP_PASS']; // SMTP服务器密码
        $replyEmail       = $config['REPLY_EMAIL'] ? $config['REPLY_EMAIL'] : $config['FROM_EMAIL'];//回复地址
        $replyName        = $config['REPLY_NAME'] ? $config['REPLY_NAME'] : $config['FROM_NAME'];//回复名称
        $mail->AddReplyTo($replyEmail,$replyName);
        $mail->From       = $config['FROM_EMAIL'];
        $mail->FromName   = $config['FROM_NAME'];
        $mail->AddAddress($to,$name);
        $mail->Subject    = $subject;//邮件标题
        $mail->AltBody    = "";
        $mail->WordWrap   = 80;
        // 添加附件
        if(is_array($attachment)){
            foreach ($attachment as $file){
                is_file($file) && $mail->AddAttachment($file);
            }
        }
        $mail->MsgHTML($body);//邮件主体
        $mail->IsHTML(true);
        return $mail->Send() ? true : $mail->ErrorInfo;
    }
}