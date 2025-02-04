<?php
namespace App\Repositories\Notification;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Singleton;

class SMSService extends Singleton implements NotificationInterface
{
    private $apiUrl;
    private $apiKey;
    private $senderId;

    // Khởi tạo thông số cấu hình cho SMS API (ví dụ: Twilio, Nexmo, v.v.)
    protected function __construct()
    {
        $this->apiUrl   = 'https://api.smsprovider.com/send';  // URL của dịch vụ SMS
        $this->apiKey   = 'your-api-key';                      // API key của dịch vụ SMS
        $this->senderId = 'YourSenderID';                      // Sender ID
    }

    public function sendNotice($recipient, $message)
    {
        // Logic gửi SMS sử dụng API SMS
        $data = [
            'to'      => $recipient,
            'message' => $message,
            'apiKey'  => $this->apiKey,
            'sender'  => $this->senderId
        ];

        // Gửi yêu cầu HTTP tới dịch vụ SMS (giả sử dùng cURL)
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            echo "SMS sent to $recipient: $message\n";
        } else {
            echo "Failed to send SMS to $recipient.\n";
        }
    }
}

