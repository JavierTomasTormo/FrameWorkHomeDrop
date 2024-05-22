<?php
    class controller_login {

        private $dao;
		private $db;
		static $_instance;

		function __construct() {
			$this -> dao = login_dao::getInstance();
			$this -> db = db::getInstance();
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
    
        // function login() {
        //     echo json_encode(common::load_model('login_model', 'get_login', [$_POST['username'], $_POST['password']]));
        // }

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

            $verify = json_encode(common::load_model('login_model', 'get_verify_email', $_POST['token_email']));

            if ($verify == 'token_caducado') {
                echo json_encode('error');
            } else {
                echo json_encode($verify);
            }
        }

        // function verify_email() {
        //     $verify = json_encode(common::load_model('login_model', 'get_verify_email', $_POST['token_email']));
        //     echo json_encode($verify);
        // }

        // function send_recover_email() {
        //     echo json_encode(common::load_model('login_model', 'get_recover_email', $_POST['email_forg']));
        // }

        // function verify_token() {
        //     echo json_encode(common::load_model('login_model', 'get_verify_token', $_POST['token_email']));
        // }

        // function new_password() {
        //     echo json_encode(common::load_model('login_model', 'get_new_password', [$_POST['token_email'], $_POST['password']]));
        // }  
    
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