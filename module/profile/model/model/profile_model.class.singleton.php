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
        // public function get_removefromprofile($ID_HomeDrop) {
        //     return $this -> bll -> get_removefromprofile_BLL($ID_HomeDrop);
        // }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        // public function processOrder() {
        //     return $this->bll->processOrder_BLL();
        // }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
//         public function get_showLastSelectedHouseInfo() {
//             //return "hola";
//            //return $_GET['data'];

//             if (isset($_GET['data'])) {
//                 $lastSelectedHouses = json_decode($_GET['data'], true);

//                 //return $lastSelectedHouses;
        
//                 return $this -> bll -> get_showLastSelectedHouseInfo_BLL($lastSelectedHouses);

//             } else {
    
//                 return(['error' => 'No se proporcionó el parámetro lastSelectedHouses']);
//             }
            
//         }
// // //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://

    }
/*------*/    
?>