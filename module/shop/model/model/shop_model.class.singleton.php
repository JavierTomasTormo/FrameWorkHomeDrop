<?php
    class shop_model {
        private $bll;
        static $_instance;

        function __construct() {
            $this -> bll = shop_bll::getInstance();
        }

        public static function getInstance() {
            if (!(self::$_instance instanceof self)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_LoadJump($args) {
            // return ($args);
            return $this -> bll -> get_LoadJump_BLL($args);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_ajaxForSearch($args) {
            return $args;
            return $this -> bll -> get_ajaxForSearch_BLL($args);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_clicks($id) {
            // return $id;
            return $this -> bll -> get_clicks_BLL($id);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//        
        public function get_loadDetails($id) {
            // return $id;
            return $this -> bll -> get_loadDetails_BLL($id);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_MasCasasRelacionadas($args) {
            // return $args;
            return $this -> bll -> get_MasCasasRelacionadas_BLL($args);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_ViviendasRelacionadas($args) {
            // return $args;
            return $this -> bll -> get_ViviendasRelacionadas_BLL($args);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        // public function get_count_filters($args) {
        //     return $this -> bll -> get_count_filters_BLL($args);
        // }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        // public function get_cars($args) {
        //     return $this -> bll -> get_cars_BLL($args);
        // }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        // public function get_load_likes($args) {
        //     return $this -> bll -> get_load_likes_BLL($args);
        // }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        // public function get_control_likes($args) {
        //     return $this -> bll -> get_control_likes_BLL($args);
        // }
    }
?>
