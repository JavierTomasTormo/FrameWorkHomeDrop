<?php
    class profile_model {

        private $bll;
        static $_instance;
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://        
        function __construct() {
            $this -> bll = profile_bll::getInstance();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_UserData() {
                return $this->bll->get_UserData_BLL();
        }
    
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function getOrderDetails($order_id) {
            return $this->bll->getOrderDetails($order_id);
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://get_disminuircantidad
        public function getOrderItems($order_id) {
            return $this->bll->getOrderItems($order_id);
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_user_orders($ID_User) {
            return $this -> bll -> get_user_orders_BLL($ID_User);
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        
        public function updateUserProfileImage($args) {
                // return($args);
                return $this->bll->updateUserProfileImage($args[0], $args[1]);
        }
      
      
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
public function get_LikedHouses($Username) {
        return $this -> bll -> get_LikedHouses_BLL($Username);
    }
// // //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://

    }
/*------*/    
?>