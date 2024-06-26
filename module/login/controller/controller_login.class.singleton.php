<?php
    class controller_login {

        private $dao;
		private $db;
		static $_instance;

		function __construct() {
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
        
        function view() {
            common::load_view('top_page_login.html', VIEW_PATH_LOGIN . 'login.html');
        }

        function recover_view() {
            common::load_view('top_page_login.html', VIEW_PATH_LOGIN . 'recover_pass.html');
        }
    
        function login() {
            // echo json_encode(['LogIn Del Controlador', [$_POST['username_log'], $_POST['passwd_log']]]);//passwd_log': formData['passwd_log'], 'username_log': formData['username_log']
            echo json_encode(common::load_model('login_model', 'get_login', [$_POST['username_log'], $_POST['passwd_log']]));
        }

        function register() {
            // echo json_encode($_POST['data']);          
            echo json_encode(common::load_model('login_model', 'get_register', [$_POST['data']['username_reg'], $_POST['data']['passwd2_reg'], $_POST['data']['email_reg']]));
        }

        // function social_login() {
        //     echo json_encode(common::load_model('login_model', 'get_social_login', [$_POST['id'], $_POST['username'], $_POST['email'], $_POST['avatar']]));
        // } 
    
        function verify_email() {
            // echo json_encode($_POST['token_email']);
            // echo json_encode('Entro en el verify_email');

            echo json_encode(common::load_model('login_model', 'get_verify_email', $_POST['token_email']));

        }

        function GenerarNuevoToken() {
            // echo json_encode($_POST['token_email']);          
            echo json_encode(common::load_model('login_model', 'get_GenerarNuevoToken', $_POST['token_email']));
        }

        function handleLoginAttempt() {
            echo json_encode(common::load_model('login_model', 'handle_login_attempt', $_POST['user']));
        }        

        function JWT_Caduco() {
            // echo json_encode($_POST['token_email']);          
            echo json_encode(common::load_model('login_model', 'get_JWT_Caduco', $_POST['email_actual']));
        }

        function DataUser() {
            // echo json_encode($_POST['token_email']);          
            echo json_encode(common::load_model('login_model', 'get_DataUser', $_POST['token']));
        }

        function LikedHouses() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_LikedHouses', $_POST['Username']));
        }

        function LogOut() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_LogOut'));
        }

        function ControlUser() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_ControlUser', $_POST['token']));
        }

        function Actividad() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_Actividad'));
        }

        function RefreshToken() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_RefreshToken', $_POST['token']));
        }

        function RefreshCookie() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'get_RefreshCookie'));
        }

        function send_recover_email() {
            // echo json_encode("yo si que llego a esto mi rey");
            echo json_encode(common::load_model('login_model', 'get_recover_email', $_POST['data']));
        }

        function new_password() {
            // echo json_encode("Hola desde el putíssimo contolador");
            // echo json_encode($_POST['data']);
            echo json_encode(common::load_model('login_model', 'get_new_password', $_POST['data']));
        }  


        function send_otp() {
            // echo json_encode($_POST['whatsappNumber']);
        
            $otp = common::load_model('login_model', 'generateOTP');
            $whatsappNumber = $_POST['whatsappNumber'];
            // $whatsappNumber = '573188255022';
        
            // echo json_encode([$otp. "    " . $whatsappNumber]);
        
            $_SESSION['otp'] = $otp;
        
            $result = Whatsapp::sendWhatsAppOTP($whatsappNumber, $otp);
            echo json_encode($result);
        }  
        
        function verify_otp() {
            $otp = $_POST['otp'];
            $storedOtp = common::load_model('login_model', 'getStoredOTP');
        
            if ($otp === $storedOtp) {
                echo json_encode(['success' => true, 'message' => 'OTP verificado correctamente']);
                // Continuar con el proceso de inicio de sesión
            } else {
                echo json_encode(['success' => false, 'message' => 'OTP incorrecto']);
            }
        }

        function UpdateOTP() {
            // echo json_encode($_POST['Username']);
            echo json_encode(common::load_model('login_model', 'getUpdateOTP', $_POST['Username']));
        
        }

        function social_login() {
            // echo json_encode($_POST['social_user']);
            echo json_encode(common::load_model('login_model', 'get_social_login', $_POST['social_user']));
        } 
        
    
        // function logout() {
        //     echo json_encode('Done');
        // } 

        // function data_user() {
        //     echo json_encode(common::load_model('login_model', 'get_data_user', $_POST['token']));
        // }

        // function activity() {
        //     echo json_encode(common::load_model('login_model', 'get_activity'));
        // }

        // function controluser() {
        //     echo json_encode(common::load_model('login_model', 'get_controluser', $_POST['token']));
        // }

        // function refresh_token() {
        //     echo json_encode(common::load_model('login_model', 'get_refresh_token', $_POST['token']));
        // } 
        
        // function token_expires() {
        //     echo json_encode(common::load_model('login_model', 'get_token_expires', $_POST['token']));
        // }

        // function refresh_cookie() {
        //     session_regenerate_id();
        // } 
    
    }
    
?>