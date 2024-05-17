<?php
    class mail {
        public static function send_email($email) {
            switch ($email['type']) {
                case 'contact';
                    $email['toEmail'] = 'javiertomas2003@gmail.com';
                    $email['fromEmail'] = 'secondchanceonti@gmail.com';
                    $email['inputEmail'] = 'secondchanceonti@gmail.com';
                    $email['inputMatter'] = 'Email verification';
                    $email['inputMessage'] = "<h2>Email verification.</h2><a href='http://localhost/Ejercicios/Framework_PHP_OO_MVC/index.php?module=contact&op=view'>Click here for verify your email.</a>";
                    break;
                case 'validate';
                    $email['fromEmail'] = 'secondchanceonti@gmail.com';
                    $email['inputEmail'] = 'secondchanceonti@gmail.com';
                    $email['inputMatter'] = 'Email verification';
                    $email['inputMessage'] = "<h2>Email verification.</h2><a href='http://localhost/Ejercicios/Framework_PHP_OO_MVC/module/login/verify/$email[token]'>Click here for verify your email.</a>";
                    break;
                case 'recover';
                    $email['fromEmail'] = 'secondchanceonti@gmail.com';
                    $email['inputEmail'] = 'secondchanceonti@gmail.com';
                    $email['inputMatter'] = 'Recover password';
                    $email['inputMessage'] = "<a href='http://localhost/Ejercicios/Framework_PHP_OO_MVC/module/login/recover/$email[token]'>Click here for recover your password.</a>";
                    break;
            }
            return self::send_mailgun($email);
        }

        public static function send_mailgun($values){
            $mailgun = parse_ini_file(UTILS . "JWT.ini");

            $api_key = $mailgun['RESEND_API_KEY'];

            $config = array();
            $config['api_key'] = $api_key; 

            $message = array();
            $message['from'] = $values['fromEmail'];
            // $message['to'] = $values['toEmail'];
            $message['to'] = $mailgun['RESEND_EMAIL_TO'];
            $message['h:Reply-To'] = $values['inputEmail'];
            $message['subject'] = $values['inputMatter'];
            $message['html'] = $values['inputMessage'];


            $result = Resend::client($api_key);

            try {
                $result->emails->send([
                    'from' => $message['from'],
                    'to' => $message['to'],
                    'subject' => $message['subject'],
                    'html' => $message['html']
                ]);//'<p>Verify new Account <strong> email</strong>!</p><br/><h1 style="font-family: "Plus Jakarta Sans", sans-serif; color: #ddba6b;">HomeDrop</h1>'

            } catch (\Exception $e) {
                exit('Error: ' . $e->getMessage());
            }
            
            // Show the response of the sent email to be saved in a log...
            return $result;

            // return $result;
        }
    }