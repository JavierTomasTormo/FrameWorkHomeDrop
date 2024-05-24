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

			// return $args;

			if (!empty($this -> dao -> select_user($this->db, $args[0], $args[0]))) {
				$user = $this -> dao -> select_user($this->db, $args[0], $args[0]);
				// return $user[0]['Username'];

				if (password_verify($args[1], $user[0]['Password']) && $user[0]['activate'] == 1) {

					// return 'Buenas tardes';
					$jwt = middleware::encode($user[0]['Username']);
					// return $jwt;

					$_SESSION['username'] = $user[0]['Username'];

					$_SESSION['tiempo'] = time();

					// return $_SESSION['username'];
					
                    session_regenerate_id();

					$response = array(
						'token' => $jwt,
						'user' => $user,
					);

					return $response;

				} else if (password_verify($args[1], $user[0]['password']) && $user[0]['activate'] == 0) {
					$this->get_newToken_BLL($user[0]['token_email']);
				} else {
					return 'error_auth';
				}
            } else {
				return 'error_user';
			}
		}

		public function get_DataUser_BLL($token) {
			$jwt = middleware::decode_username($token);
			$user = $this -> dao -> SeleccionarDatosUsuario($this->db, $jwt);
			return $user;
		}
		

		// public function get_social_login_BLL($args) {
		// 	if (!empty($this -> dao -> select_user($this->db, $args[1], $args[2]))) {
		// 		$user = $this -> dao -> select_user($this->db, $args[1], $args[2]);
		// 		$jwt = jwt_process::encode($user[0]['username']);
		// 		return json_encode($jwt);
        //     } else {
		// 		$this -> dao -> insert_social_login($this->db, $args[0], $args[1], $args[2], $args[3]);
		// 		$user = $this -> dao -> select_user($this->db, $args[1], $args[2]);
		// 		$jwt = jwt_process::encode($user[0]['username']);
		// 		return json_encode($jwt);
		// 	}
		// }

		// public function get_verify_email_BLL($args) {
		// 	if($this -> dao -> select_verify_email($this->db, $args)){
		// 		$this -> dao -> update_verify_email($this->db, $args);
		// 		return 'verify';
		// 	} else {
		// 		return 'fail';
		// 	}
		// }

		// public function get_recover_email_BBL($args) {
		// 	$user = $this -> dao -> select_recover_password($this->db, $args);
		// 	$token = common::generate_Token_secure(20);

		// 	if (!empty($user)) {
		// 		$this -> dao -> update_recover_password($this->db, $args, $token);
        //         $message = ['type' => 'recover', 
        //                     'token' => $token, 
        //                     'toEmail' => $args];
        //         $email = json_decode(mail::send_email($message), true);
		// 		if (!empty($email)) {
		// 			return;  
		// 		}   
        //     }else{
        //         return 'error';
        //     }
		// }


		// public function get_verify_token_BLL($args) {
		// 	if($this -> dao -> select_verify_email($this->db, $args)){
		// 		return 'verify';
		// 	}
		// 	return 'fail';
		// }

		// public function get_new_password_BLL($args) {
		// 	$hashed_pass = password_hash($args[1], PASSWORD_DEFAULT, ['cost' => 12]);
		// 	if($this -> dao -> update_new_passwoord($this->db, $args[0], $hashed_pass)){
		// 		return 'done';
		// 	}
		// 	return 'fail';
		// }

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