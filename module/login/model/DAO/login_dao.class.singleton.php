<?php
    class login_dao {
        static $_instance;

        private function __construct() {
        }

        public static function getInstance() {
            if(!(self::$_instance instanceof self)){
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function insert_user($db, $id, $username_reg, $hashed_pass, $email_reg, $avatar, $token_email, $tiempo_generacion) {

            $sql = "INSERT INTO Users (Username, Password, Email, UserType, Avatar, token_email, tiempo_generacion, activate)
            VALUES ('$username_reg', '$hashed_pass', '$email_reg', 'client', '$avatar', '$token_email', '$tiempo_generacion', false)";
            // return $sql;
                $stmt = $db->ejecutar($sql);
            return "Usuario Insertado Correctamente"; 
            
        }
       
        public function select_user($db, $username, $email){

			$sql = "SELECT `ID_User`, `Username`, `Password`, `Email`, `UserType`, `Avatar`, `token_email`,`tiempo_generacion`,`activate` FROM `users` WHERE username='$username' OR Email='$email'";

            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }

        public function obtener_tiempo_generacion($db, $token_email) {
            $sql = "SELECT tiempo_generacion FROM Users WHERE token_email = '$token_email'";
            $stmt = $db->ejecutar($sql);
            $resultado = $db->listar($stmt);

            // return $resultado[0]['tiempo_generacion'];
        
            if (!empty($resultado)) {
                return $resultado[0]['tiempo_generacion'];
            } else {
                return false;
            }
        }


        public function select_verify_email($db, $token_email) {
            $sql = "SELECT token_email, tiempo_generacion FROM Users WHERE token_email = '$token_email'";
            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
        }


        public function update_verify_email($db, $token_email){

            $sql = "UPDATE Users SET activate = 1, token_email= '' WHERE token_email = '$token_email'";

            $stmt = $db->ejecutar($sql);
            return "update";
        }

        public function actualizarTokenEmail($db, $ID_User, $token_email, $tiempo_generacion) {
            $sql = "UPDATE Users SET token_email = '$token_email', tiempo_generacion = '$tiempo_generacion' WHERE ID_User = '$ID_User'";
            $stmt = $db->ejecutar($sql);
            // return $sql;
            return;
        }


        public function UserdelNuevoToken($db, $OLDtoken_email) {
            $sql = "SELECT * FROM Users WHERE token_email = '$OLDtoken_email'";
            $stmt = $db->ejecutar($sql);
            // return $sql;
            return $db->listar($stmt);
            // return;
        }

        public function SeleccionarDatosUsuario($db, $username) {
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $stmt = $db->ejecutar($sql);
            return $db->listar($stmt);
            // return;
        }


        // public function select_social_login($db, $id){

		// 	$sql = "SELECT * FROM users WHERE id='$id'";
        //     $stmt = $db->ejecutar($sql);

        //     return $db->listar($stmt);
        // }

        // public function insert_social_login($db, $id, $username, $email, $avatar){

        //     $sql ="INSERT INTO users (id, username, password, email, user_type, avatar, token_email, activate)     
        //         VALUES ('$id', '$username', '', '$email', 'client', '$avatar', '', 1)";

        //     return $stmt = $db->ejecutar($sql);
        // }



        // public function select_recover_password($db, $email){
		// 	$sql = "SELECT `email` FROM `users` WHERE email = '$email' AND password NOT LIKE ('')";
        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

        


        // public function update_recover_password($db, $email, $token_email){
		// 	$sql = "UPDATE `users` SET `token_email`= '$token_email' WHERE `email` = '$email'";
        //     $stmt = $db->ejecutar($sql);
        //     return "ok";
        // }

        // public function update_new_passwoord($db, $token_email, $password){
        //     $sql = "UPDATE `users` SET `password`= '$password', `token_email`= '' WHERE `token_email` = '$token_email'";
        //     $stmt = $db->ejecutar($sql);
        //     return "ok";
        // }




        // public function select_data_user($db, $username){

		// 	$sql = "SELECT id, username, password, email, user_type, avatar, token_email, activate FROM users WHERE username = '$username'";
            
        //     $stmt = $db->ejecutar($sql);
        //     return $db->listar($stmt);
        // }

    }

?>