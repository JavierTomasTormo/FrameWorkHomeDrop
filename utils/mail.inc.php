<?php
    class mail {
        public static function send_email($email) {
            // return "Has entrado en el Send Email";
            // return $email['type'];

            switch ($email['type']) {
                case 'validate';
                    $email['fromEmail'] = 'onboarding@resend.dev';
                    $email['inputEmail'] = 'javiertomas2003@gmail.com';
                    $email['inputMatter'] = 'Email verification';

                    $email['inputMessage'] = '
                    <div style="background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif; color: #333;">
                        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            <div style="background-color: #333333; padding: 20px; text-align: center;">
                                <h2 style="color: #ddba6b; margin: 0; font-size: 24px;">Email Verification</h2>
                            </div>
                            <div style="padding: 20px; text-align: center;">
                                <p style="font-size: 16px; color: #666666; line-height: 1.5; margin-bottom: 30px;">
                                    Thank you for signing up! Please verify your email address by clicking the button below.
                                </p>
                                <a href="http://localhost/FrameWorkHomeDrop/module/login/verify/'.$email['token'].'" 
                                   style="background-color: #ddba6b; color: #ffffff; padding: 15px 25px; text-decoration: none; font-size: 16px; border-radius: 5px; display: inline-block;">
                                    Verify Email
                                </a>
                            </div>
                            <div style="background-color: #333333; padding: 20px; text-align: center;">
                                <h1 style="font-family: \'Plus Jakarta Sans\', sans-serif; color: #ddba6b; margin: 0; font-size: 32px;">HomeDrop</h1>
                            </div>
                        </div>
                    </div>';
                    
                        // return($email);  <p>Verify new Account <strong> email</strong>!</p><br/><h1 style="font-family: "Plus Jakarta Sans", sans-serif; color: #ddba6b;">HomeDrop</h1>

                break;
                case 'recover';
                    $email['fromEmail'] = 'onboarding@resend.dev';
                    $email['inputEmail'] = 'javiertomas2003@gmail.com';
                    $email['inputMatter'] = 'Recover password';
                    $email['inputMessage'] = '
                    <div style="background-color: #f4f4f4; padding: 20px; font-family: Arial, sans-serif; color: #333;">
                        <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                            <div style="background-color: #333333; padding: 20px; text-align: center;">
                                <h2 style="color: #ddba6b; margin: 0; font-size: 24px;">Password Recovery</h2>
                            </div>
                            <div style="padding: 20px; text-align: center;">
                                <p style="font-size: 16px; color: #666666; line-height: 1.5; margin-bottom: 30px;">
                                    We received a request to reset your password. Click the button below to reset it.
                                </p>
                                <a href="http://localhost/FrameWorkHomeDrop/module/login/recover/'.$email['token'].'" 
                                   style="background-color: #ddba6b; color: #ffffff; padding: 15px 25px; text-decoration: none; font-size: 16px; border-radius: 5px; display: inline-block;">
                                    Reset Password
                                </a>
                            </div>
                            <div style="padding: 20px; text-align: center;">
                                <p style="font-size: 14px; color: #999999; line-height: 1.5; margin-top: 30px;">
                                    If you did not request a password reset, please ignore this email or contact support if you have questions.
                                </p>
                            </div>
                            <div style="background-color: #333333; padding: 20px; text-align: center;">
                                <h1 style="font-family: \'Plus Jakarta Sans\', sans-serif; color: #ddba6b; margin: 0; font-size: 32px;">HomeDrop</h1>
                            </div>
                        </div>
                    </div>';
                break;
            }

            return self::send_resend($email);
        }

        public static function send_resend($values){

            // return "Has entrado en el Send Mailgun";
            require __DIR__. '/vendor/autoload.php';

            $mailgun = parse_ini_file(UTILS . "JWT.ini");

            // return $mailgun;

            $api_key = $mailgun['RESEND_API_KEY'];

            // return $values;
            // return ($api_key);

            // $result = Resend::client($api_key);
            $result = Resend::client('re_fbxk6T2X_3JrYeFR1659yRUxqTqpmSDTK');

            // return $result;

            try {

                $result->emails->send([
                    'from' => $values['fromEmail'],
                    'to' => $values['inputEmail'],
                    'subject' => $values['inputMatter'],
                    'html' => $values['inputMessage']
                ]);//'<p>Verify new Account <strong> email</strong>!</p><br/><h1 style="font-family: "Plus Jakarta Sans", sans-serif; color: #ddba6b;">HomeDrop</h1>'
                
                // return "Email sent successfully";
            } catch (\Exception $e) {
                return "Email failed to send. Error: ". $e->getMessage();
                exit('Error: ' . $e->getMessage());
            }
            
            return $result;

            // return $result;
        }
    }