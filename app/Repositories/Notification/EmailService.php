<?php
namespace App\Repositories\Notification;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Singleton;

class EmailService extends Singleton implements NotificationInterface {
    private $smtpServer;
    private $port;
    private $username;
    private $password;

    // Khởi tạo thông số cấu hình (ví dụ: SMTP server, tài khoản, mật khẩu)
    protected function __construct()
    {
        $this->smtpServer = 'smtp.example.com';        // Thay thế bằng thông tin thực tế
        $this->port       = 587;                       // Cổng SMTP
        $this->username   = 'your-email@example.com';  // Tài khoản email
        $this->password   = 'your-email-password';     // Mật khẩu email
    }

    public function sendNotice($recipient, $message)
    {
        // Logic gửi email sử dụng PHP mail() hoặc thư viện như PHPMailer
        $subject = 'Notification';
        $headers = "From: {$this->username}\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        // Sử dụng mail() hoặc một thư viện như PHPMailer
        if (mail($recipient, $subject, $message, $headers)) {
            echo "Email sent to $recipient: $message\n";
        } else {
            echo "Failed to send email to $recipient.\n";
        }
    }
}

