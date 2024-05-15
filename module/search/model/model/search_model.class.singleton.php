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

        public function get_LoadCitySearch() {
            // return "Hola holita vecinito model";
            return $this -> bll -> get_LoadCitySearch_BLL();
        }

        public function get_SearchOperationNull() {
            return $this -> bll -> get_SearchOperationNull_BLL();
        }

        public function get_SearchOperation($args) {
            return $this -> bll -> get_SearchOperation_BLL($args);
        }



        public function get_AutocompleteSearch($args) {
            return $this -> bll -> get_AutocompleteSearch_BLL($args);
        }



    }