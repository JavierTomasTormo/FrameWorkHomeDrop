<?php
	class search_bll {
		private $dao;
		private $db;
		static $_instance;

		function __construct() {
			$this -> dao = search_dao::getInstance();
			$this->db = db::getInstance();
		}

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function get_LoadCitySearch_BLL() {
			return $this -> dao -> SearchCity($this->db);
		}

		public function get_SearchOperationNull_BLL() {
			return $this -> dao -> SearchOperationNull($this->db);
		}

        public function get_SearchOperation_BLL($args) {
			return $this -> dao -> SearchOperation($this->db, $args);
		}

		public function get_AutocompleteSearch_BLL($sdata) {
            // return $args;

			$select = "";

			if (!empty($sdata['Operation'])) {
				$operacion2 = $sdata['Operation'];
				$select .= " AND oh.ID_Operation = '$operacion2'";
		
			} if (!empty($sdata['Ciudad'])) {
				$ciudad = $sdata['Ciudad'];
				$select .= " AND ch.ID_City = '$ciudad'";
		
			} if (!empty($sdata['complete'])) {
				$complete = $sdata['complete'];
				$select .= " AND th.Type LIKE '$complete%'";
			}
		
			
			$select .= " GROUP BY th.Type ";
			return $this -> dao -> AutocompleteSearch($this->db, $select);
		}

		
	}
?>