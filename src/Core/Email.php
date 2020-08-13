<?php

namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Email
{
    private $d;
    private $data = array();
    private $company = array();
    private $optcompany = '';

    function __construct($d)
    {
        $this->d = $d;
        $this->infoEmail();
    }

    public function infoEmail()
    {
        global $config_base;

        $logo = array();
        $social = array();
        $socialString = '';
        $this->company = $this->d->rawQueryOne("SELECT options, tenvi FROM table_setting");
        $this->optcompany = json_decode($this->company['options'], true);
        $logo = $this->d->rawQueryOne("SELECT photo FROM table_photo WHERE type = ? AND act = ?", array('logo', 'photo_static'));
        $social = $this->d->rawQuery("SELECT photo, link FROM table_photo WHERE type = ? AND hienthi=1 ORDER BY stt,id DESC", array('mangxahoi'));
        foreach ($social as $value) $socialString .= '<a href="' . $value['link'] . '" target="_blank"><img src="' . $config_base . UPLOAD_PHOTO_L . $value['photo'] . '" style="max-height:30px;margin:0 0 0 5px" /></a>';
        $this->data['email'] = ($this->optcompany['mailertype'] == 1) ? $this->optcompany['email_host'] : $this->optcompany['email_gmail'];
        $this->data['color'] = '#94130F';
        $this->data['home'] = $config_base;
        $this->data['logo'] = '<img src="' . $config_base . UPLOAD_PHOTO_L . $logo['photo'] . '" style="max-height:70px;" >';
        $this->data['social'] = $socialString;
        $this->data['datesend'] = time();
        $this->data['company'] = $this->company['tenvi'];
        $this->data['company:address'] = $this->optcompany['diachi'];
        $this->data['company:email'] = $this->optcompany['email'];
        $this->data['company:hotline'] = $this->optcompany['hotline'];
        $this->data['company:website'] = $this->optcompany['website'];
        $this->data['company:worktime'] = '(8-21h cả T7,CN)';
    }

    public function setEmail($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getEmail($key)
    {
        return $this->data[$key];
    }

    public function sendEmail($owner, $arrayEmail = null, $subject = "", $message = "", $file = '')
    {
        global $config_base;

        $mail = new PHPMailer(true);

        if ($this->optcompany['mailertype'] == 1) {
            $config_host = $this->optcompany['ip_host'];
            $config_port = $this->optcompany['port_host'];
            $config_secure = $this->optcompany['secure_host'];
            $config_email = $this->optcompany['email_host'];
            $config_password = $this->optcompany['password_host'];

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = false;
            $mail->SMTPSecure = $config_secure;
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->Host = $config_host;
            $mail->Port = $config_port;
            $mail->Username = $config_email;
            $mail->Password = $config_password;
            $mail->SetFrom($this->optcompany['email'], $this->company['tenvi']);
        } else if ($this->optcompany['mailertype'] == 2) {
            $config_host = $this->optcompany['host_gmail'];
            $config_port = $this->optcompany['port_gmail'];
            $config_secure = $this->optcompany['secure_gmail'];
            $config_email = $this->optcompany['email_gmail'];
            $config_password = $this->optcompany['password_gmail'];

            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPDebug = false;
            $mail->SMTPSecure = $config_secure;
            $mail->Host = $config_host;
            $mail->Port = $config_port;
            $mail->Username = $config_email;
            $mail->Password = $config_password;
            $mail->SetFrom($config_email, $this->company['tenvi']);
            $mail->From = $config_email;
            $mail->FromName = $this->company['tenvi'];
        }

        if ($owner == 'admin') {
            $mail->AddAddress($this->optcompany['email'], $this->company['tenvi']);
        } else if ($owner == 'customer') {
            if ($arrayEmail) {
                foreach ($arrayEmail as $vEmail) {
                    $mail->AddAddress($vEmail['email'], $vEmail['name']);
                }
            }
        }
        $mail->AddReplyTo($this->optcompany['email'], $this->company['tenvi']);
        $mail->CharSet = "utf-8";
        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        if ($file && isset($_FILES[$file]) && !$_FILES[$file]['error']) {
            $mail->AddAttachment($_FILES[$file]["tmp_name"], $_FILES[$file]["name"]);
        }

        if ($mail->Send()) return true;
        else return false;
    }
}
