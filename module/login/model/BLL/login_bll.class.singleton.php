<?php
	class login_bll {
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

		public function get_register_BLL($args) {

			// return $args;

			$hashed_pass = password_hash($args[1], PASSWORD_DEFAULT);
			$hashavatar = md5(strtolower(trim($args[2]))); 
			$avatar = "https://i.pravatar.cc/500?u=$hashavatar";
			$token_email = common::generate_Token_secure(20);
			$id = common::generate_Token_secure(6);
			$tiempo_generacion = time();
			// return [$hashed_pass,$hashavatar,$avatar,$token_email,$id];

			if (!empty($this -> dao -> select_user($this->db, $args[0], $args[2]))) {
				return 'error';
            } else {
				// return [$id, $args[0], $hashed_pass, $args[2], $avatar, $token_email, $tiempo_generacion];

				$this -> dao -> insert_user($this->db, $id, $args[0], $hashed_pass, $args[2], $avatar, $token_email, $tiempo_generacion);

				// return 'ok';
				$message = [ 'type' => 'validate', 
								'token' => $token_email, 
								'toEmail' =>  $args[0]
							];
				// return ($message);
				$email = mail::send_email($message);

				// return ($email);
				//19:40 20/02/2024 Cambiado, probar con el email de prueba!

				if (!empty($email)) {
					return "Inserción y creacion de usuario ejecutado sin complicaciones";  
				} else {
					return "Error al enviar el email de verificacion ($email)";
				}
			}
		}

		public function get_verify_email_BLL($token_email) {
			// return("BLL   ".$token_email);
			$tiempo_actual = time();
			$tiempo_generacion = $this->dao->obtener_tiempo_generacion($this->db, $token_email);
			
			// return ("Tiempo Generacion   ".$tiempo_generacion."   Tiempo actual   ".$tiempo_actual);
		
			if ($tiempo_generacion !== false) {
				$diferencia_tiempo = $tiempo_actual - $tiempo_generacion;

				// return $diferencia_tiempo;


				if ($diferencia_tiempo > 900) { // 5 minutos = 300 segundos //poner a 900 para que se actualice el token cada 5 minutos
					return 'token_caducado';
				} else {
					// return ['El token no esta caducado', $diferencia_tiempo];
					if ($this->dao->select_verify_email($this->db, $token_email)) {
						$this->dao->update_verify_email($this->db, $token_email);
						return 'verify';
					} else {
						return 'token_caducado';
					}
				}
			} else {
				return 'token_caducado';
			}
		}
		
		public function get_newToken_BLL($OLDtoken_email) {
			// return "WhatsssUP";
			// return $email;
			$token_email = common::generate_Token_secure(20);
			$tiempo_generacion = time();

			// return $token_email;

			$args = $this->dao->UserdelNuevoToken($this->db, $OLDtoken_email);

			// return $args[0]['ID_User'];
			
			// Actualiza el token y el tiempo de generación en la base de datos
			$this->dao->actualizarTokenEmail($this->db, $args[0]['ID_User'], $token_email, $tiempo_generacion);
		

			// Envía el nuevo token por correo electrónico
			$message = [
				'type' => 'validate',
				'token' => $token_email,
				'toEmail' => 'javiertomas2003@gmail.com'
			];
			mail::send_email($message);
		
			return;
		
		}

		public function get_login_BLL($args) {

			// return "error_passwd";

			if (!empty($this -> dao -> select_user($this->db, $args[0], $args[0]))) {
				$user = $this -> dao -> select_user($this->db, $args[0], $args[0]);


				// return [$user, $args];

				// return $user[0]['Username'];

				if (password_verify($args[1], $user[0]['Password']) && $user[0]['activate'] == 1) {
					// Si la contraseña es correcta y la cuenta está activada
				
					$jwt = middleware::encode($user[0]['Username']);
					$_SESSION['username'] = $user[0]['Username'];
					$_SESSION['tiempo'] = time();
					session_regenerate_id();
				
					$responsearr = array(
						'token' => $jwt,
						'user' => $user,
					);
				
					return $responsearr;
				
				} else if (!password_verify($args[1], $user[0]['Password']) && $user[0]['activate'] == 1) {
					// Si la contraseña es incorrecta
					// return $user;

					return "error_passwd";

				} else if (password_verify($args[1], $user[0]['Password']) && $user[0]['activate'] == 0) {
					// Si la contraseña es correcta pero la cuenta no está activada
					$this->get_newToken_BLL($user[0]['token_email']);
				
				} else {
					// Cualquier otro caso de error de autenticación
					return "error_auth";
				}
				
            // } else {
			// 	return "error_user";
			}
		}

		public function get_DataUser_BLL($token) {
			$jwt = middleware::decode_username($token);
			return $this -> dao -> SeleccionarDatosUsuario($this->db, $jwt);
			// return $user;
		}

		public function get_LikedHouses_BLL($Username) {
			// return $Username;
			$user = $this -> dao -> LikedHouses($this->db, $Username);

			if ($user) {
				return $user;
			} else {
				return 'El Usuario no tiene Likes';
			}
			// return $user;
		}

		public function get_LogOut_BLL() {
			unset($_SESSION['Username']);
			unset($_SESSION['tiempo']);
			session_destroy();
	
			return('Done');
		}

		public function get_ControlUser_BLL($token) {


			// return $token;

			$token_dec = middleware::decode_username($token);
			// return $token_dec;
			// return $_SESSION['username'];

			// return [$token_dec ,$_SESSION['username']];


			if (isset($_SESSION['username']) && ($_SESSION['username']) == $token_dec) {
				return "Correct_User";

			} else {
				return "Wrong_User";
				
			}
			// return $user;
		}

		public function get_Actividad_BLL() {
			// return $_SESSION;

			if (!isset($_SESSION["tiempo"])) {
				return ("Inactivo");
				
			} else {
				if ((time() - $_SESSION["tiempo"]) >= 1800) { //1800s=30min
					return ("Inactivo");
					
				} else {
					return ("Activo");
				
				}
			}
		}

		public function get_RefreshToken_BLL($token) {
			// return $_SESSION;
			$OldToken = middleware::decode_username($token);

			// return $OldToken;
	
			$NewToken = middleware::encode($OldToken);
			return ($NewToken);
		}
		
		public function get_RefreshCookie_BLL() {
			session_regenerate_id();
			return "Done";
			
		}
		
		public function get_recover_email_BBL($args) {
			// return $args;
			$tiempo_actual = time();
			$user = $this -> dao -> select_recover_password($this->db, $args, $tiempo_actual);
			
			// return $user;
			$token = middleware::encode($user);
			$recover_token = $token;

			if (!empty($user)) {

                $message = [
								'type' => 'recover', 
								'token' => $token, 
								'toEmail' => $args
							];
				// return $recover_token;	
                $email = mail::send_email($message);
				// return $email;

				if (!$email) {
					return;  
				}

				return $recover_token;
            } else {
                return 'error';
            }
		}

		public function get_JWT_Caduco_BBL($email_actual) {
			$tiempo_actual = time();
			$tiempo_generacion = $this->dao->obtener_tiempo_generacion($this->db, $email_actual);


			if ($tiempo_generacion !== false) {
				$diferencia_tiempo = $tiempo_actual - $tiempo_generacion;

				// return $diferencia_tiempo;


				if ($diferencia_tiempo > 3000) { // 5 minutos = 300 segundos //poner a 900 para que se actualice el token cada 9 +- minutos
					return 'token_caducado';
				} else {
					// return ['El token no esta caducado', $diferencia_tiempo];
					return 'verify';
				}
			} else {
				return 'token_caducado';
			}
		}


		public function get_new_password_BLL($data) {
			// return $data;

			$hashed_pass = password_hash($data['password'], PASSWORD_DEFAULT, ['cost' => 12]);

			// return $this -> dao -> update_new_passwoord($this->db, $data['email_actual'], $hashed_pass);

			if($this -> dao -> update_new_passwoord($this->db, $data['email_actual'], $hashed_pass)){
				return 'done';
			}
			return 'fail';
		}

		public function handle_login_attempt_BLL($user) {
			// Obtener el número actual de intentos para el usuario
			$attempts = $this->dao->get_attempts($this->db, $user);
		
			// return $attempts;

			if ($attempts !== false) {
				$newAttempts = $attempts + 1;
		
				// Si se han alcanzado 3 intentos, desactivar la cuenta y mostrar el campo OTP
				if ($newAttempts >= 4) {
					if ($this->dao->update_attempts_and_deactivate($this->db, $user, $newAttempts)) {
						return ['OTP_REQUIRED', $attempts];
					} else {
						return 'Error al actualizar los intentos y desactivar la cuenta';
					}
				} else {
					// Actualizar el número de intentos
					if ($this->dao->update_attempts($this->db, $user, $newAttempts)) {
						return ['ATTEMPT_UPDATED', $attempts];
					} else {
						return 'Error al actualizar los intentos';
					}
				}
			} else {
				return 'Usuario no encontrado';
			}
		}
		
		public function generateOTP() {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$otp = '';
			for ($i = 0; $i < 5; $i++) {
				$otp .= $characters[rand(0, strlen($characters) - 1)];
			}
			return $otp;
		}
		
		public function getStoredOTP() {
			// Obtener el OTP almacenado (desde una variable de sesión o la base de datos)
			$storedOtp = $_SESSION['otp'];
			return $storedOtp;
		}

		public function getUpdateOTP_BLL($Username) {
			if ($this->dao->UpdateUserOTP($this->db, $Username)) {
				return "Success";
			} else {
				return 'Failure';
			}
		}

		public function get_social_login_BLL($args) {

			// return $args;
			// return 'github intenta iniciar sesion';

			if (!empty($this -> dao -> select_user($this->db, $args['username'], $args['email']))) {

				$user = $this -> dao -> select_user($this->db, $args['username'], $args['email']);

				// return $user[0]['SL_github'] .''. $user[0]['SL_google'];
				// return $user[0]['SL_github'];
				if (!isset($user[0]['SL_google']) || !isset($user[0]['SL_github'])) {
					// return 'Esta vacio0';
					$UsernameSL = $user[0]['Username'] .'_'. $args['provider'];
					// return $UsernameSL;
					if ($args['provider'] == 'google') {
						$update = $this -> dao -> InsertUserSocialExists($this->db, $user[0]['Username'], $UsernameSL, 'SL_google');

					} else {
						$update = $this -> dao -> InsertUserSocialExists($this->db, $user[0]['Username'], $UsernameSL, 'SL_github');

					}
					// return $update; 
				}
				
				// return 'EH?';
				$jwt = middleware::encode($user[0]['Username']);
				return $jwt;

            } else {
				return 'Funcion no disponible';
				// $this -> dao -> insert_social_login($this->db, $args[0], $args[1], $args[2], $args[3]);
				// $user = $this -> dao -> select_user($this->db, $args[1], $args[2]);
				// $jwt = middleware::encode($user[0]['username']);
				// return json_encode($jwt);
			}
		}
		
/*get_LogOut_BLL get_Actividad_BLL  getUpdateOTP_BLL  get_RefreshCookie_BLL   get_ControlUser_BLL*/

		// public function get_data_user_BLL($args) {
		// 	$token = explode('"', $args);
		// 	$decode = middleware::decode_username($token[1]);
		// 	return $this -> dao -> select_data_user($this->db, $decode);
		// }

		// public function get_activity_BLL() {
        //     if (!isset($_SESSION["tiempo"])) {  
		// 		return "inactivo";
		// 	} else {  
		// 		if((time() - $_SESSION["tiempo"]) >= 1800) {  
		// 				return "inactivo";
		// 		}else{
		// 			return (time() - $_SESSION["tiempo"]);
		// 		}
		// 	}
		// }

		// public function get_controluser_BLL($args) {
		// 	$token = explode('"', $args);
		// 	$void_email = "";
		// 	$decode = middleware::decode_username($token[1]);
		// 	$user = $this -> dao -> select_user($this->db, $decode, $void_email);

		// 	if (!isset ($_SESSION['username']) != $user){
		// 		if(isset ($_SESSION['username']) != $user) {
		// 			return 'not_match';
		// 		}
		// 		return 'match';
		// 	}
		// }

		// public function get_refresh_token_BLL($args) {
		// 	$token = explode('"', $args);
		// 	$void_email = "";
		// 	$decode = middleware::decode_username($token[1]);
		// 	$user = $this -> dao -> select_user($this->db, $decode, $void_email);

		// 	$new_token = jwt_process::encode($user[0]['username']);

        //     return $new_token;
		// }

		// public function get_token_expires_BLL($args) {
		// 	$token = explode('"', $args);
		// 	$decode = middleware::decode_exp($token[1]);
			
        //     if(time() >= $decode) {  
		// 		return "inactivo"; 
		// 	} else{
		// 		return "activo";
		// 	}
		// }
	}