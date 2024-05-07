<?php
	class home_bll {
		private $dao;
		private $db;
		static $_instance;
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

		function __construct() {
			$this -> dao = home_dao::getInstance();
			$this -> db = db::getInstance();
		}

//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

		public static function getInstance() {
			if (!(self::$_instance instanceof self)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function get_CarouselImages_BLL() {
			return $this -> dao -> selectCarouselImages($this -> db);
		}
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function get_CategoryCharger_BLL() {
			return $this -> dao -> SelectCategory($this -> db);
		}
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
		public function get_CityCharger_BLL() {
			return $this -> dao -> SelectCity($this -> db);
		}
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function get_OperationCharger_BLL() {
            return $this -> dao -> SelectOperation($this -> db);
        }
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function get_MostVisited_BLL() {
            return $this -> dao -> MostVisited($this -> db);
        }
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//
        public function get_showLastSelectedHouseInfo_BLL($lastSelectedHouses) {
            //return "Hello";
            //return $lastSelectedHouses;
            return $this -> dao -> SelectLastHouse($this -> db, $lastSelectedHouses);
        }
//,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+,+//

	}
//----//
?>