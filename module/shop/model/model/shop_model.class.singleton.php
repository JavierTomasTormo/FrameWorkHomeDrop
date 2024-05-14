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
            // return $args;
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
        public function get_updateResultsCount($FiltersShopCount) {
            // return $FiltersShopCount;
            return $this -> bll -> get_updateResultsCount_BLL($FiltersShopCount);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_cargarFiltrosShop($data) {
            // return $data;
            return $this -> bll -> get_cargarFiltrosShop_BLL($data);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_LoadSearch($FiltersSearch) {
            return $this -> bll -> get_LoadSearch_BLL($FiltersSearch);
        }
//-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=//
        public function get_Pagination($args) {
            // return $args;
            return $this -> bll -> get_Pagination_BLL($args);
        }
    }
?>
