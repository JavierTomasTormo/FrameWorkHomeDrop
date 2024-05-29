<?php

require 'vendor/autoload.php'; 

use Curl\Curl;

class Whatsapp {
    private $apiUrl;
    private $token;

    public function __construct($token, $apiUrl = "https://api.ultramsg.com/instance86849/") {
        $this->token = $token;
        $this->apiUrl = rtrim($apiUrl, '/') . '/';
    }

    public function sendMessage($to, $body) {
        
        $params = array(
            'token' => $this->token,
            'to' => $to,
            'body' => $body
        );

        // return $params;

        $curl = new Curl();
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, 0);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, 0);
        
        $response = $curl->post($this->apiUrl . 'messages/chat', $params);

        // return $response;

        if ($curl->error) {
            return [
                'success' => false,
                'message' => 'Error al enviar el OTP: ' . $curl->errorCode . ': ' . $curl->errorMessage
            ];
            // return 'cURL Error #: ' . $curl->errorCode . ': ' . $curl->errorMessage;
        } else {
            return [
                'success' => true,
                'message' => 'OTP enviado al WhatsApp del usuario'
            ];
            // return $response;
        }
    }

    public static function sendWhatsAppOTP($to, $otp) {
        $mailgun = parse_ini_file(UTILS . "JWT.ini");

        $token = $mailgun['ULTRAMSG_API_KEY'];;  
        $whatsapp = new self($token);
        $message = "Your OTP code is: $otp";
        return $whatsapp->sendMessage($to, $message);
    }
}

//         try {
//             // Enviar el mensaje OTP
//             $message = $client->messages->create(
//                 'whatsapp:' . $whatsappNumber, // Destinatario
//                 [
//                     'from' => self::$twilioNumber, // Remitente
//                     'body' => 'Tu código OTP es: ' . $otp // Contenido del mensaje
//                 ]
//             );

//             return [
//                 'success' => true,
//                 'message' => 'OTP enviado al WhatsApp del usuario'
//             ];
//         } catch (\Exception $e) {
//             return [
//                 'success' => false,
//                 'message' => 'Error al enviar el OTP: ' . $e->getMessage()
//             ];
//         }
//     }
// }
