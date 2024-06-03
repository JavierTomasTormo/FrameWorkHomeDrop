<?php
    class controller_search {

        private $dao;
		private $db;
		static $_instance;

		function __construct() {
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
        
        function LoadCitySearch() {
            // echo json_encode("Hola Holita ");
            echo json_encode(common::load_model('search_model', 'get_LoadCitySearch'));
        }

        function LoadOperationSearch() {
            // echo json_encode("Hola Holita ");
            if(empty($_POST['Ciudad'])){
                echo json_encode(common::load_model('search_model', 'get_SearchOperationNull'));
            }else{
                echo json_encode(common::load_model('search_model', 'get_SearchOperation', $_POST['Ciudad']));
            }
        }
        
        function AutocompleteSearch() {

            // echo json_encode($_POST['sdata']);
                echo json_encode(common::load_model('search_model', 'get_AutocompleteSearch', $_POST['sdata']));
            
        }
    }
?>