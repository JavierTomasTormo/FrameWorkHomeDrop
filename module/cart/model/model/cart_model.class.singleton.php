<?php
    class cart_model {

        private $bll;
        static $_instance;
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://        
        function __construct() {
            $this -> bll = cart_bll::getInstance();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_ListCart() {
            return $this -> bll -> get_ListCart_BLL();
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function incrementarCantidad($ID_HomeDrop) {
            return $this->bll->incrementCartItemQuantity_BLL($ID_HomeDrop);
        }

// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://get_disminuircantidad
        public function get_disminuircantidad($ID_HomeDrop) {
            return $this->bll->get_disminuircantidad_BLL($ID_HomeDrop);
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_removefromcart($ID_HomeDrop) {
            return $this -> bll -> get_removefromcart_BLL($ID_HomeDrop);
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
//         public function get_MostVisited() {
//             return $this -> bll -> get_MostVisited_BLL();
//         }
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