<?php
    class search_model {
        private $bll;
        static $_instance;
        
        function __construct() {
            $this -> bll = search_bll::getInstance();
        }

        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function get_car_type() {
            return $this -> bll -> get_car_type_BLL();
        }

        public function get_car_brand() {
            return $this -> bll -> get_car_brand_BLL();
        }

        public function get_car_type_brand($args) {
            return $this -> bll -> get_car_type_brand_BLL($args);
        }

        public function get_auto_car_type($args) {
            return $this -> bll -> get_auto_car_type_BLL($args);
        }

        public function get_auto_car_brand($args) {
            return $this -> bll -> get_auto_car_brand_BLL($args);
        }

        public function get_auto_car_type_brand($args) {
            return $this -> bll -> get_auto_car_type_brand_BLL($args);
        }

        public function get_auto($args) {
            return $this -> bll -> get_auto_BLL($args);
        }

    }