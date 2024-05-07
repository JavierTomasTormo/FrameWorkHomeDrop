<?php
    class home_model {

        private $bll;
        static $_instance;
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://        
        function __construct() {
            $this -> bll = home_bll::getInstance();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_CarouselImages() {
            return $this -> bll -> get_CarouselImages_BLL();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_CategoryCharger() {
            return $this -> bll -> get_CategoryCharger_BLL();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_CityCharger() {
            // return 'hola car type';
            return $this -> bll -> get_CityCharger_BLL();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_OperationCharger() {
            // return 'hola car type';
            return $this -> bll -> get_OperationCharger_BLL();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_MostVisited() {
            return $this -> bll -> get_MostVisited_BLL();
        }
//:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://
        public function get_showLastSelectedHouseInfo() {
            //return "hola";
           //return $_GET['data'];

            if (isset($_GET['data'])) {
                $lastSelectedHouses = json_decode($_GET['data'], true);

                //return $lastSelectedHouses;
        
                return $this -> bll -> get_showLastSelectedHouseInfo_BLL($lastSelectedHouses);

            } else {
    
                return(['error' => 'No se proporcionó el parámetro lastSelectedHouses']);
            }
            
        }
// //:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+:+://

    }
/*------*/    
?>